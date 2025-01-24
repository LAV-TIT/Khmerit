<?php
#-------------------------------------------------------------------------
# LISE - List It Special Edition
# Version 1.2
# A fork of ListI2
# maintained by Fernando Morgado AKA Jo Morg
# since 2015
#-------------------------------------------------------------------------
#
# Original Author: Ben Malen, <ben@conceptfactory.com.au>
# Co-Maintainer: Simon Radford, <simon@conceptfactory.com.au>
# Web: www.conceptfactory.com.au
#
#-------------------------------------------------------------------------
#
# Maintainer since 2011 up to 2014: Jonathan Schmid, <hi@jonathanschmid.de>
# Web: www.jonathanschmid.de
#
#-------------------------------------------------------------------------
#
# Some wackos started destroying stuff since 2012 and stopped at 2014:
#
# Tapio Löytty, <tapsa@orange-media.fi>
# Web: www.orange-media.fi
#
# Goran Ilic, <uniqu3e@gmail.com>
# Web: www.ich-mach-das.at
#
#-------------------------------------------------------------------------
#
# LISE is a CMS Made Simple module that enables the web developer to create
# multiple lists throughout a site. It can be duplicated and given friendly
# names for easier client maintenance.
#
#-------------------------------------------------------------------------
# BEGIN_LICENSE
#-------------------------------------------------------------------------
# This file is part of LISE
# LISE program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# LISE program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
# END_LICENSE
#-------------------------------------------------------------------------
if( !defined('CMS_VERSION') ) exit;
if( !$this->CheckPermission( $this->_GetModuleAlias() . '_modify_item' ) ) return;
$handlers = ob_list_handlers();
for($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

lise_utils::log('*****************');
$batch = 1;

header('Content-Type: application/json');

$done = FALSE;

$current = isset($_POST['record']) ? $_POST['record'] : 0;
$total = isset($_POST['of']) ? $_POST['of'] : 0;

$SessionData = \LISE\Session::Read($this,'CSVDATA');
lise_utils::log('session data : ' . $SessionData);

$SessionData = unserialize($SessionData);

$database_values  = $SessionData['database_values'];
$dest_path        = $SessionData['dest_path'];
$separator        = $SessionData['separator'];
$enclosure        = $SessionData['enclosure'];
$import_values    = $SessionData['import_values'];

$errors = array();

if(!file_exists($dest_path))
{
  $errors[] = 'file does not seem to exist: ' . $dest_path;
}

foreach($database_values as $obj)
{
  if( $obj->required )
  {
    if( !$import_values[$obj->alias] ) $errors[] = $this->ModLang( 'required_field_empty' ) . ' (' . $obj->alias . ')';
  }
}

$start = $current;
$end = $current + $batch;
$last = $start - 1;

if($errors)
{
  foreach($errors as $error)
  {
    lise_utils::log('error found : ' . $error);
  }
}

if( empty($errors) )
{
  $database_values = array();
  // Initiate CsvIterator
  $csv = new LISECsvIterator( $dest_path, true, $separator, $enclosure );
  
  
  lise_utils::log('start: ' . $start);
  
  if($start)
  {
    while($csv->key() <= $last)
    {
      $csv->next();
      lise_utils::log('jump key: ' . $csv->key());
      if( !$csv->current() || $csv->key() > $total)
      {
        lise_utils::log('jump stoped at: ' . $csv->key());
        $done = (bool)($csv->key() == $total);
        break;
      }
    }
  }
  
  lise_utils::log('####');
  lise_utils::log('start: ' . $start);
  lise_utils::log('end: ' . $end);
  
  for($cnt =  $start; $cnt < ($end) ; $cnt++)
  {
    if($csv->key() > $total) break;

    if(!$csv->next()) break;
    $row = $csv->current();
  
    foreach( $import_values as $alias => $index )
    {
      if($index)
      {
        $database_values[$csv->key()][$alias] = $row[$index];
      }
      else
      {
        unset($import_values[$alias]);
      }
    }
  }
  
  /****
   * debug start
   */
  
  $starttime = microtime();
  $orig_memory = (function_exists('memory_get_usage') ? memory_get_usage() : 0);
  $db = cmsms()->GetDb();
  $original_sql_queries = $db->query_count;
  $original_sql_time = round($db->query_time_total,5);
  $original_memory_peak = (function_exists('memory_get_peak_usage') ? memory_get_peak_usage() : 'n/a');
  
  $msg = 'Debug data: ';
  $msg .=  'JUST BEFORE START';
  $msg .=  'exec_time(' . $starttime . ' ms) :: ';
  $msg .=  'queries(' . $original_sql_queries . ') :: ';
  $msg .=  'mem(' . $orig_memory . ') :: ';
  $msg .=  'sql_time(' . $original_sql_time . ') :: ';
  $msg .=  'memory_peak(' . $original_memory_peak . ')';
  
  lise_utils::log($msg);
  
  
  // Import data to database
  foreach($database_values as $item_values)
  {
    
    $obj = $this->InitiateItem();
    
    foreach( $item_values as $key => $value )
    {
      
      if( $key == 'item_id' && !is_numeric( $value ) ) continue;
      
      $key = utf8_encode( $key );
      
      $csv_separator = $this->GetPreference('csv_separator', ',');
      $value = explode( $csv_separator, utf8_encode( $value ) );
      
      $obj->SetPropertyValue( $key, $value );
      if( $key == 'item_id' ) LISEItemOperations::Load( $this, $obj ); // <- Try loading item if we actually got ID.
    }
    
    $this->SaveItem($obj);
    
    unset($obj);
  }
  
  $endtime = microtime();
  $time = microtime_diff($starttime, $endtime);
  $memory = (function_exists('memory_get_usage')?memory_get_usage():0);
  $memory = $memory - $orig_memory;
  $sql_time = round($db->query_time_total,5);
  $sql_time = $sql_time - $original_sql_time;
  $sql_queries = $db->query_count;
  $sql_queries = $sql_queries - $original_sql_queries;
  $memory_peak = (function_exists('memory_get_peak_usage')?memory_get_peak_usage():'n/a');
  $memory_peak = $memory_peak - $original_memory_peak;

  $msg = 'Debug data: ';
  $msg .=  'measured';
  $msg .=  'exec_time(' . $time . ' ms) :: ';
  $msg .=  'queries(' . $sql_queries . ') :: ';
  $msg .=  'mem(' . $memory . ') :: ';
  $msg .=  'sql_time(' . $sql_time . ') :: ';
  $msg .=  'memory_peak(' . $memory_peak . ')';
  
  lise_utils::log($msg);

  /*
   * debug - end
   */
  
  /*
  if($last > 0)
  {
    while($last >= $csv->key() )
    {
      $csv->next();
    }
  }
  
  $database_values = array();
  
  echo('<br/>:::::::::::::::::::::<br/>');
  debug_display($cvs);
  echo('<br/>' . __FILE__ . ' : (' . __CLASS__ . ' :: ' . __FUNCTION__ . ') : ' . __LINE__ . '<br/>');
  die('<br/>RIP!<br/>');
  
  

  //for($cnt =  $current; $cnt < ($current + $batch - 1) ; $cnt++)
  
    /*
    if($cnt >= $total)
    {
      $done = TRUE;
      break;
    }
    */
  /*
    // Initiate CsvIterator
    $csv = new LISECsvIterator( $dest_path, true, $separator, $enclosure );
    $jump_done = $csv->jump($current);
    
    echo('<br/>:::::::::::::::::::::<br/>');
    var_export($csv);
    var_export($jump_done);
    //debug_display();
    echo('<br/>' . __FILE__ . ' : (' . __CLASS__ . ' :: ' . __FUNCTION__ . ') : ' . __LINE__ . '<br/>');
    die('<br/>RIP!<br/>');
    
    // Collect data from file
    while( $csv->next() )
    {
      $row = $csv->current();

      foreach( $import_values as $alias => $index )
      {

        if($index)
        {
          $database_values[$csv->key()][$alias] = $row[$index];
        }
        else
        {
          unset($import_values[$alias]);
        }
      }
    }
    
    echo('<br/>:::::::::::::::::::::<br/>');
    debug_display($database_values);
    echo('<br/>' . __FILE__ . ' : (' . __CLASS__ . ' :: ' . __FUNCTION__ . ') : ' . __LINE__ . '<br/>');
    die('<br/>RIP!<br/>');
    
    // Import data to database
    foreach($database_values as $item_values)
    {

      $obj = $this->InitiateItem();

      foreach( $item_values as $key => $value )
      {

        if( $key == 'item_id' && !is_numeric( $value ) ) continue;

        $key = utf8_encode( $key );
        $value = explode( LISE_VALUE_SEPARATOR, utf8_encode( $value ) );

        $obj->SetPropertyValue( $key, $value );
        if( $key == 'item_id' ) LISEItemOperations::Load( $this, $obj ); // <- Try loading item if we actually got ID.
      }

      $this->SaveItem( $obj );

      unset( $obj );
    }
  
    // Redirect back to listing
    //$params = array( 'active_tab' => 'itemtab' );
    //$this->Redirect( $id, 'defaultadmin', $returnid, $params );
  */

} // end of error check
  

$current = $cnt;

$data = [
          'current' => $csv->key(),
          'done'    => $done,
          'POST'    => print_r($_POST, 1),
          'errors'  => $errors
        ];

echo json_encode($data);
exit;
?>