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
$out = [
  'msg'     => 'ok',
  'error'   => 0,
  'content' => [],
  'type' => 'array',
  'params'  => $params
];

$handlers = ob_list_handlers();
for($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }

if( !defined('CMS_VERSION') )
{
  header('HTTP/1.1 403 Forbidden!');
  header('Content-Type: application/json; charset=UTF-8');
  $out['msg'] = 'Forbidden';
  $out['error'] = 80085;
  die( json_encode($out) );
}


$csv_file = cms_join_path(TMP_CACHE_LOCATION, $this->GetName() . '_CSV_FILE.csv');
$separator     =  $this->GetPreference('separator', ',');
$enclosure     =  $this->GetPreference('enclosure', '"');
$import_values = unserialize( $this->GetPreference('import_values') );
# remove non-matching columns
$import_values = array_filter($import_values);
$db = \cms_utils::get_db();

if(isset($params['wstp']))
{
  $wizard_step  = (int) $params['wstp'];
  
  switch ($wizard_step)
  {
    # step 0: import the csv to a temp db table and return count items
    case 0:
            //$out['content']['lines'] = $rows - 1;
        break;
        
    # do the actual importing to the instance tables
    case 1:
            if( isset($params['offset'], $params['step']) )
            {
//              $sql = 'SHOW COLUMNS FROM temp_lise_csv_import_data';
//
//              $r = $db->GetArray($sql);
//
//              if($db->ErrorNo() > 0)
//              {
//                $out['error'] = $db->ErrorNo();
//                $out['msg'] = $db->ErrorMsg();
//                break;
//              }
              
//              $headers = [];
//
//              foreach($r as $one)
//              {
//                if('lise_tmp_id' === $one['Field']) { continue; }
//                $headers[] = $one['Field'];
//              }
  
              $database_values = [];
              $_invalid_values = ['create_time', 'modified_time'];
              $database_values = \LISE\api::getInstance()::GetFieldsRequirements(TRUE);
              $fields = array_values($import_values);
  
              $start = (int)$params['offset'];
              $end = (int)($start + $params['step'] - 1);
  
              $sql = 'SELECT ';
              $sql .= implode(',', $fields);
              $sql .= ' FROM temp_lise_csv_import_data WHERE lise_tmp_id BETWEEN ';
              $sql .= $start . ' AND ' . $end;
  
              $r = $db->GetArray($sql);
  
              if($db->ErrorNo() > 0)
              {
                $out['error'] = $db->ErrorNo();
                $out['msg'] = $db->ErrorMsg();
                break;
              }
              
              foreach($r as $one)
              {
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
  
                unset($obj);
              }
              
            }
        break;
        
    # drop the temporary table
    case 2:
      $sql = 'DROP TABLE IF EXISTS temp_lise_csv_import_data';
      $db->execute($sql);
  
      if($db->ErrorNo() > 0)
      {
        $out['error'] = $db->ErrorNo();
        $out['msg'] = $db->ErrorMsg();
      }
        break;
    default:
      $out['error'] = 1001;
      $out['msg'] = 'Unknown step';
  }
}





//$errors = [];

//foreach( $database_values as $obj )
//{
//  if($obj->required && !$import_values[$obj->alias])
//  {
//    $errors[] = $this->ModLang('required_field_empty') . ' (' . $obj->alias . ')';
//  }
//}

//if( empty($errors) )
//{
//
//  for($x = $offset; $x <=  ($offset + $step); $x++)
//  {
//
//
//   // $line_array = $csv_file_obj->current();

//  }
//
//}

//###################################################################################################
//$abc123456 = \compact('r', 'headers', 'import_values');
//echo('<br/>:::::::::::::::::::::<br/>');
//debug_display($abc123456);
//echo('<br/>' . __FILE__ . ' : (' . __CLASS__ . ' :: ' . __FUNCTION__ . ') : ' . __LINE__ . '<br/>');
//die('<br/>RIP!<br/>');
//###################################################################################################


header('Content-Type: application/json; charset=UTF-8');
die(json_encode($out));

?>
