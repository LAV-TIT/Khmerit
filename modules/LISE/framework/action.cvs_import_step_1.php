<?php
if( !defined('CMS_VERSION') ) { exit; }
if( !$this->CheckPermission($this->_GetModuleAlias() . '_modify_item') ) { return; }

$old_met  = ini_set('max_execution_time', 0);
$handlers = ob_list_handlers();
for($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

$csv_file      = cms_join_path(TMP_CACHE_LOCATION, $this->GetName() . '_CSV_FILE.csv');
$separator     = $this->GetPreference('separator', ',');
$enclosure     = $this->GetPreference('enclosure', '"');
$import_values = unserialize($this->GetPreference('import_values'));

# remove non-matching columns
$import_values = array_filter($import_values);
$db = \cms_utils::get_db();

$h = [];
$rows = 0;

$set_count = function($val)
{
  echo '
<script>
  parent.set_end('. $val . ');
 </script>
';
  ob_flush();
  flush();
};

$display_progress = static function($progress)
{
  echo '
<script>
  parent.set_progress('. $progress . ')
 </script>
';
  ob_flush();
  flush();
};

$display_message = static function($message)
{
  echo '
<script>
    parent.document.getElementById("messages").innerHTML="'. $message . '";
</script>
';
  
  ob_flush();
  flush();
};

$start_estimating = static function()
{
  echo '
<script>
    parent.start_estimating();
</script>
';
  
  ob_flush();
  flush();
};


if( FALSE !== ($handle = fopen($csv_file, 'rb') ) )
{
  $display_message('Import started - stage one: counting records and import to temporary table');

  while(FALSE !== ($data = fgetcsv($handle, 10000, $separator, $enclosure)))
  {
    if(0 === $rows)
    {
      $h   = $data;
      $sql = 'DROP TABLE IF EXISTS temp_lise_csv_import_data';

      $db->execute($sql);

      if($db->ErrorNo() > 0)
      {
        $msg = '<p>Error ' . $db->ErrorNo() . ': ' . $db->ErrorMsg() . '</p>';
        $msg .= '<p>SQL: ' . $sql . '</p>';
        $display_message($msg);

//        $out['error'] = $db->ErrorNo();
//        $out['msg'] = $db->ErrorMsg();
//        $out['content']['sql'] = $sql;
//        break;
      }

      $sql = 'CREATE TABLE IF NOT EXISTS temp_lise_csv_import_data (';
      $sql .= 'lise_tmp_id INT NOT NULL AUTO_INCREMENT,';

      $cols = [];
      foreach($data as $col_name)
      {
        $cols[] = $col_name . '  TEXT(4000)';
      }

      $sql .= implode(', ', $cols);
      $sql .= ', PRIMARY KEY (lise_tmp_id) ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4';

    }
    else
    {
      $t = array_map('\htmlentities', $data);
      $sql = 'INSERT INTO temp_lise_csv_import_data (';
      $sql .= implode(', ', $h) . ') ';
      $sql .= 'VALUES ("';
      $sql .= implode('", "', $t) . '") ';

    }

    $db->execute($sql);

    if($db->ErrorNo() > 0)
    {
      $msg = '<p>Error ' . $db->ErrorNo() . ': ' . $db->ErrorMsg() . '</p>';
      $msg .= '<p>SQL: ' . $sql . '</p>';
      $display_message($msg);
//      $out['error'] = $db->ErrorNo();
//      $out['msg'] = $db->ErrorMsg();
//      $out['content']['sql'] = $sql;
//      break;
    }

    $set_count($rows++);
  }

  fclose($handle);
  
  $display_message('Import stage one completed. Started stage two!');
  
  $database_values = [];
  $_invalid_values = ['create_time', 'modified_time'];
  $database_values = \LISE\api::getInstance()::GetFieldsRequirements(TRUE);
  $fields = array_values($import_values);
  $row = 0;
  
//  $start = (int)$params['offset'];
//  $end = (int)($start + $params['step'] - 1);
  
  $sql = 'SELECT ';
  $sql .= implode(',', $fields);
  //$sql .= ' FROM temp_lise_csv_import_data WHERE lise_tmp_id BETWEEN ';
  $sql .= ' FROM temp_lise_csv_import_data';
  //$sql .= $start . ' AND ' . $end;
  
  $r = $db->GetArray($sql);
  
  if($db->ErrorNo() > 0)
  {
    $msg = '<p>Error ' . $db->ErrorNo() . ': ' . $db->ErrorMsg() . '</p>';
    $msg .= '<p>SQL: ' . $sql . '</p>';
    $display_message($msg);
//    $out['error'] = $db->ErrorNo();
//    $out['msg'] = $db->ErrorMsg();
//    break;
  }
  
  $start_estimating();
  
  foreach($r as $one)
  {
    $row++;
    // Import data to database
    $obj = $this->InitiateItem();
    
    foreach($import_values as $alias => $field_name)
    {
      if('item_id' === $alias && !is_numeric($one[$field_name]) ) { continue; }
      
      $obj->SetPropertyValue( $alias, html_entity_decode($one[$field_name]) );
      
      # Try loading item if we actually got ID.
      if('item_id' === $alias)
      {
        LISEItemOperations::Load($this, $obj);
      }
    }
    
    $this->SaveItem($obj);
    
    $display_progress($row);
    
    unset($obj);
  }
  
}
else
{
  $display_message('Error: could not open temporary copy of CSV import file! Please try again!');
}

ini_set('max_execution_time', $old_met);

?>