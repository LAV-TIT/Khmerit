<?php
namespace LISE;


class CsvImporter
{
  private $query;
  private $tables = array();
  private $fields = array();
  private $result;
  
  public function __construct(\LISE $mod, $fn,  $fields, $existing_fields)
  {
    $item_db_fields = array(
                              'url',
                              'category_id',
                              'title',
                              'alias',
                              'position',
                              'active',
                              'create_time',
                              'modified_time',
                              'start_time',
                              'end_time',
                              'key1',
                              'key2',
                              'key3',
                              'owner'
                            );
    
    $handled_fields = array();
    $insert_fields = array();
    foreach($existing_fields as $k => $v)
    {
      //if($v == 'item_id') continue;
      if($v)
      {
        $handled_fields[] = $v;
        $insert_fields[] =  $k;
      }
    }
  
    $handled_fields = array_unique($handled_fields);
    
    $db = \cms_utils::get_db();
    $config = \LISE\ConfigManager::GetConfigInstance($mod);
    $temp_table_name = \cms_db_prefix() . $mod->_GetModuleAlias() . '_tmpcsv_';
    $items_table = \cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item';
    $fielddef_table = \cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef';
    $fieldval_table = \cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fieldval';
    
    $expected_fields = array();
    
    foreach($fields as $one) $expected_fields[] = $one->alias;
    
    $query = 'SELECT fielddef_id,name,alias,type FROM ' . $fielddef_table;
  
    $fields_list = $db->GetAll($query);
    
    $needed_fields = array();
    foreach($fields_list as $one)
    {
      if( !in_array($one['alias'], $expected_fields) ) continue;
      $needed_fields[$one['alias']] = $one;
    }
    
    $fn = \str_replace('\\', '\\\\', $fn);
    
    foreach($handled_fields as $field)
    {
      $this->fields[] = $field . ' VARCHAR(2000)';
    }
    
    $create_fields = implode(',', $this->fields);
  
    $query = "CREATE TEMPORARY TABLE $temp_table_name ($create_fields);";
    
    $dbr = $db->Execute($query);
    
    $query = "
          LOAD DATA LOCAL INFILE '{$fn}'
          INTO TABLE $temp_table_name
          FIELDS TERMINATED BY ','
          OPTIONALLY ENCLOSED BY '\"'
          LINES TERMINATED BY '\r\n'
          IGNORE 1 LINES;
          ";
    
    $dbr = $db->Execute($query);
    
    $items_fields = array_intersect($insert_fields, $item_db_fields);
    $items_fields_names = implode( ',', $items_fields);
    $custom_fields = array_diff($handled_fields, $items_fields);
    $tmp = array_shift($custom_fields);
    //$custom_fields = implode( ',', array_diff($handled_fields, $item_db_fields));
    //$custom_fields_ids =  array_diff($needed_fields, $item_db_fields);
    $query = "SELECT * FROM $temp_table_name";
    $dbr = $db->GetAll($query);
    
    echo('<br/>:::::::::::::::::::::<br/>');
    debug_display($create_fields);
    debug_display($dbr);
    echo('<br/>' . __FILE__ . ' : (' . __CLASS__ . ' :: ' . __FUNCTION__ . ') : ' . __LINE__ . '<br/>');
    die('<br/>RIP!<br/>');
    
    $tmp = array_fill(0, count($items_fields), '?');
    $placeholders = implode(',', $tmp);
  
    $starttime = microtime();
  
    $ok = $db->BeginTrans();
    foreach($dbr as $one)
    {
      $params = array();
      $remove = array();
      foreach($items_fields as $afield)
      {
        $params[] = $one[$existing_fields[$afield]];
        $remove[] = $existing_fields[$afield];
      }
      $remove = array_unique($remove);
      
      $q = "INSERT INTO $items_table ($items_fields_names) values ($placeholders)";
      $dbr2 = $db->Execute($q, $params);
  
      $custom_fields = array_diff($custom_fields, $remove);
      
      $field_id = $db->Insert_ID();
      
      foreach($custom_fields as $custom_field)
      {
        $cf_id = $needed_fields[$custom_field]['fielddef_id'];
        $value = $one[$custom_field];
        $q = "INSERT INTO $fieldval_table (item_id,fielddef_id,value) values ($field_id,$cf_id,'$value')";
        $dbr2 = $db->Execute($q);
      }
    }
  
    $ok = $db->CommitTrans();
    //$ok = $db->CommitTrans($ok);
  
    $endtime = microtime();
    $time = microtime_diff($starttime, $endtime);
  
  
    //$query = "\"DROP TEMPORARY TABLE $temp_table_name;";
    //$dbr = $db->Execute($query);
    
    
//    echo('<br/>:::::::::::::::::::::<br/>');
//    debug_display($time);
//    debug_display($q);
//    debug_display($db->ErrorMsg());
//    echo('<br/>' . __FILE__ . ' : (' . __CLASS__ . ' :: ' . __FUNCTION__ . ') : ' . __LINE__ . '<br/>');
//    die('<br/>RIP!<br/>');
    /*
    $sub_q = '';
    
    foreach($custom_fields as $one)
    {
      $field_alias = $needed_fields[$one];
      
      $sub_q .= "INSERT INTO $fieldval_table (item_id, fielddef_id, value)
                  SELECT $items_table.item_id, '{$needed_fields[$one]['fielddef_id']}', {$needed_fields[$one]['alias']}
                  FROM $temp_table_name
      ";
    }
    
    
    $query = "
              INSERT IGNORE INTO $items_table ($items_fields)
              SELECT $items_fields FROM $temp_table_name
          ";
  
    $query .= $sub_q;
    
    $dbr = $db->Execute($query);
    
    echo('<br/>:::::::::::::::::::::<br/>');
    debug_display($query);
    debug_display($dbr);
    debug_display($db->ErrorMsg());
    echo('<br/>' . __FILE__ . ' : (' . __CLASS__ . ' :: ' . __FUNCTION__ . ') : ' . __LINE__ . '<br/>');
    die('<br/>RIP!<br/>');*/
  /*
    $starttime = microtime();
    $dbr = \cms_utils::get_db()->Execute($tmp);
  
    $endtime = microtime();
    $time = microtime_diff($starttime, $endtime);
  
    $tmp = "SELECT * FROM $temp_table_name";
  
    $this->result = \cms_utils::get_db()->GetAll($tmp);
    
  */
//    echo('<br/>:::::::::::::::::::::<br/>');
//    debug_display($dbr);
//    debug_display($time);
//    debug_display( \cms_utils::get_db()->ErrorMsg());
//    echo('<br/>' . __FILE__ . ' : (' . __CLASS__ . ' :: ' . __FUNCTION__ . ') : ' . __LINE__ . '<br/>');
//    die('<br/>RIP!<br/>');
    
  }
  
  public function GetResult()
  {
    return $this->result;
  }
  
}
?>