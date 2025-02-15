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

#---------------------
# Check params
#---------------------

if( isset( $params['cancel'] ) )
{
  $params['active_tab'] = 'itemtab';
  $this->Redirect( $id, 'defaultadmin', $returnid, $params );
}

$csv_mimetypes = [
                    'text/csv',
                    'text/plain',
                    'application/csv',
                    'text/comma-separated-values',
                    'application/excel',
                    'application/vnd.ms-excel',
                    'application/vnd.msexcel',
                    'text/anytext',
                    'application/octet-stream',
                    'application/txt',
                  ];

$admintheme    = cms_utils::get_theme_object();
$dest_path     = cms_join_path(TMP_CACHE_LOCATION, $this->GetName() . '_CSV_FILE.csv');
$file_values   = [];
$template      = 'admin_csv_import_export.tpl';
$plural        = $this->GetPreference('item_plural', '');
$separator     = lise_utils::init_var('separator', $params, $this->GetPreference('separator', ',') );
$enclosure     = lise_utils::init_var('enclosure', $params, $this->GetPreference('enclosure', '"') );
$import_values = lise_utils::init_var('import_values', $params, []);
$this->SetPreference( 'import_values', serialize($import_values) );

#---------------------
# Load item variables
#---------------------

$database_values = [];
$_invalid_values = ['create_time', 'modified_time'];
$item            = $this->InitiateItem();

$database_values = \LISE\api::getInstance()::GetFieldsRequirements(FALSE);

#---------------------
# Go back
#---------------------

if( isset( $params['previous'] ) )
{
  unset($params['submit'], $params['previous']);
}

#---------------------
# Do import
#---------------------

if( isset( $params['do_import'] ) )
{
  $this->Redirect( $id, 'csv_import_app', $returnid, $params );

//  $errors = [];
//
//  foreach( $database_values as $obj )
//  {
//
//    if( $obj->required )
//    {
//      if( !$import_values[$obj->alias] ) $errors[] = $this->ModLang( 'required_field_empty' ) . ' (' . $obj->alias . ')';
//    }
//  }
//
//  if( empty( $errors ) )
//  {
//
//    $database_values = [];
//
//    // Initiate CsvIterator
//    $csv = new LISECsvIterator( $dest_path, true, $separator, $enclosure );
//
//    // Collect data from file
//    while( $csv->next() )
//    {
//
//      $row = $csv->current();
//
//      foreach( $import_values as $alias => $index )
//      {
//
//        if( $index )
//        {
//          $database_values[$csv->key()][$alias] = $row[$index];
//        }
//        else
//        {
//          unset( $import_values[$alias] );
//        }
//      }
//    }
//
//    // Import data to database
//    foreach( $database_values as $item_values )
//    {
//
//      $obj = $this->InitiateItem();
//
//      foreach( $item_values as $key => $value )
//      {
//
//        if( $key == 'item_id' && !is_numeric( $value ) ) continue;
//
//        $obj->SetPropertyValue( $key, $value );
//        if( $key == 'item_id' ) LISEItemOperations::Load( $this, $obj ); // <- Try loading item if we actually got ID.
//      }
//
//      $this->SaveItem( $obj );
//
//      unset( $obj );
//    }
//
//    // Redirect back to listing
//    $params = ['active_tab' => 'itemtab'];
//    $this->Redirect( $id, 'defaultadmin', $returnid, $params );

//  } // end of error check
}

#---------------------
# Submit
#---------------------

if( isset($params['submit']) )
{
  
  $this->SetPreference('separator', $params['separator'] ?? ',');
  $this->SetPreference('enclosure', $params['enclosure'] ?? "'");
  
  if( !isset( $params['do_import'] ) )
  {
    $errors = [];

    // Start file validation
    $_file = $_FILES[$id . 'csvfile'];

    if( !isset( $_file['name'] ) || '' === $_file['name'])
    {
      $errors[] = $this->ModLang( 'error_file_empty' );
    }
    /* DISABLE UNTIL FURTHER NOTICE!
    if(!in_array($_file['type'], $csv_mimetypes)) {
    
    $errors[] = $this->ModLang('error_file_nocsv');
    }
    */
    if(empty($errors) && !move_uploaded_file($_file['tmp_name'], $dest_path))
    {
      $errors[] = $this->ModLang( 'error_file_permissions' );
    }
  }
  
  // No file validation errors, read file
  if( empty( $errors ) || isset( $params['do_import'] ) )
  {

    // Initiate CsvIterator
    $csv = new LISECsvIterator( $dest_path, false, $separator, $enclosure );

    $csv->next();
    $tmp = $csv->current();
    $csv->tearDown();

    // Build dropdown array
    $file_values = [0 => lang('none' )];
    foreach( $tmp as $tmpval )
    {
      $file_values[$tmpval] = utf8_encode( $tmpval );
    }

    $template = 'admin_csv_import.tpl';
  }

} // end of submit



#---------------------
# Smarty processing
#---------------------

// display errors if there are any
if( !empty( $errors ) )
{
  if( isset( $params['apply'] ) && isset( $params['ajax'] ) )
  {
    $response = '<EditItem>';
    $response .= '<Response>Error</Response>';
    $response .= '<Details><![CDATA[';
    foreach( $errors as $error )
    {
      $response .= '<li>' . $error . '</li>';
    }
    $response .= ']]></Details>';
    $response .= '</EditItem>';
    echo $response;
    return;
  }
  else
  {
    echo $this->ShowErrors( $errors );
  }
}

// Part 1
$smarty->assign( 'input_file', $this->CreateFileUploadInput( $id, 'csvfile', '', 25 ) );
$smarty->assign( 'input_separator', $this->CreateInputText( $id, 'separator', $separator, 50 ) );
$smarty->assign( 'input_enclosure', $this->CreateInputText( $id, 'enclosure', $enclosure, 50 ) );

// Part 2
$smarty->assign( 'database_values', $database_values );
$smarty->assign( 'file_values', $file_values );

$smarty->assign( 'title', $this->ModLang( 'import', $plural ) );
$smarty->assign( 'backlink', $this->CreateBackLink( 'itemtab' ) );
$smarty->assign( 'startform', $this->CreateFormStart( $id, 'admin_importitems', $returnid, 'post', 'multipart/form-data', false, '', $params ) );
$smarty->assign( 'endform', $this->CreateFormEnd() );

$smarty->assign( 'submit', $this->CreateInputSubmit( $id, 'submit', lang( 'submit' ) ) );
$smarty->assign( 'previous', $this->CreateInputSubmit( $id, 'previous', lang( 'previous' ) ) );
$smarty->assign( 'do_import', $this->CreateInputSubmit( $id, 'do_import', lang( 'submit' ) ) );
$smarty->assign( 'cancel', $this->CreateInputSubmit( $id, 'cancel', lang( 'cancel' ) ) );

echo $this->ModProcessTemplate( $template );

?>