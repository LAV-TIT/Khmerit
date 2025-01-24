<?php
if( !defined('CMS_VERSION') ) { exit; }

if( !$this->CheckPermission( $this->_GetModuleAlias() . '_modify_item' ) ) { return; }
$admintheme    = cms_utils::get_theme_object();
$dest_path     = cms_join_path(TMP_CACHE_LOCATION, $this->GetName() . '_CSV_FILE.csv');
$file_values   = [];
$template      = 'admin_csv_import_export.tpl';
$plural        = $this->GetPreference('item_plural', '');
$separator     = lise_utils::init_var('separator', $params, $this->GetPreference('separator', ',') );
$enclosure     = lise_utils::init_var('enclosure', $params, $this->GetPreference('enclosure', '"') );
$import_values = unserialize( $this->GetPreference('import_values') );

#---------------------
# Load item variables
#---------------------
$database_values = [];
$_invalid_values = ['create_time', 'modified_time'];
$item            = $this->InitiateItem();

$database_values = \LISE\api::getInstance()::GetFieldsRequirements(TRUE);

$errors = [];

foreach( $database_values as $obj )
{

  if($obj->required && !$import_values[$obj->alias])
  {
    $errors[] = $this->ModLang('required_field_empty') . ' (' . $obj->alias . ')';
  }
}

//  if( empty($errors) )
//  {
//
//    $database_values = [];
//
//
//    }

$template = 'admin_csv_import_app.tpl';

echo $this->ModProcessTemplate( $template );
?>