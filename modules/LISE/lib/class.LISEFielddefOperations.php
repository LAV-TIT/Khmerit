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
final class LISEFielddefOperations
{
  #---------------------
  # Constants
  #---------------------
  
  public const FIELDDEF_PREFIX = 'lisefd';

  #---------------------
  # Attributes
  #---------------------  
  
  public static $identifiers = [
                                  'fielddef_id'   => 'fielddef_id',
                                  'alias'         => 'alias'
  ];
  
  private static $_allowed_local  = [
    'BackendText',
    'Checkbox',
    'CheckboxGroup',
    'ColorPicker',
    'ContentPages',
    'CustomFieldFromUDT',
    'Dropdown',
    'FilePicker',
    'FileUpload',
    'JQueryMultiSelect',
    'LISEInstance',
    'LISEInstance Item',
    'MultiSelect',
    'RadioGroup',
    'SelectDateTime',
    'SelectFile',
    'Slider',
    'Tags',
    'TextArea',
    'TextInput'
  ];
  
  private static $_allowed_global = [
    'BackendText',
    'Checkbox',
    'CheckboxGroup',
    'ColorPicker',
    'ContentPages',
    'CustomFieldFromUDT',
    'Dropdown',
    'FilePicker',
    'FileUpload',
    'JQueryMultiSelect',
    'LISEInstance',
    'LISEInstance Item',
    'MultiSelect',
    'RadioGroup',
    'SelectDateTime',
    'SelectFile',
    'Slider',
    'Tabs',
    'Tags',
    'TextArea',
    'TextInput'
  ];

  private static $_fielddefs;
  
  
  
  
  #---------------------
  # private methods
  #---------------------
  
  //private static
  
  
  // Get Field Definitions
  public static function GetFieldDefs($instance_name, $include_list = [])
  {
    $instance = \cms_utils::get_module($instance_name);
    
    // Load from database
    $db = cmsms()->GetDb();
    
    $query = 'SELECT *
              FROM ' . cms_db_prefix() . 'module_' . $instance->_GetModuleAlias() . '_fielddef
              GROUP BY fielddef_id
              ORDER BY position';
    
    return $db->GetAll($query);
  }
  
  
  #---------------------
  # Magic methods
  #---------------------

  private function __construct() {}
  
  #---------------------
  # Scanning methods
  #--------------------- 

  public static function ScanModules() : void
  {
    $config = cmsms()->GetConfig();
    
    $fielddefs = self::LoadDatabaseInfo(true, true);
    $installed_modules = ModuleOperations::get_instance()->GetInstalledModules();
    
    // Make sure LISE is scanned first
    array_unshift($installed_modules, LISE);
    $installed_modules = array_unique($installed_modules);
      
    // Scan modules for fielddefs
    $scanned_fielddefs = array();    
    foreach($installed_modules as $mod_name) 
    {
      $res = array();
      $mod_dir = cms_join_path($config['root_path'], 'modules', $mod_name);    
      self::ScanDirForFielddefs($mod_dir, $res);
      $scanned_fielddefs[$mod_name] = $res;
    }    
    
    // Register fielddefs
    foreach($scanned_fielddefs as $mod_name => $mod_defs) 
    {
    
      foreach($mod_defs as $type => $path) 
      {
        $disabled = false;
      
        // Check if Fielddef is moved, unregister in that case.
        if(isset($fielddefs[$type]) && $path != $fielddefs[$type]->path) 
        {  
          self::Unregister($type);
          unset($fielddefs[$type]);          
        }    
      
        // Check if fielddef should be totally disabled, skip whole check if PHP version doesn't meet requirements.
        if (version_compare(PHP_VERSION, '5.3.0') >= 0) 
        {
          require_once($path . DIRECTORY_SEPARATOR . self::FilenameFromType($type));
          $class = self::ClassnameFromType($type);
          $module_deps = @eval("return $class::GetModuleDeps();"); // <- Eval required for not to crash system with PHP 5.2.x
          
          if(is_array($module_deps)) 
          {
          
            foreach((array)$module_deps as $module=>$version) 
            {          
              $obj = cmsms()->GetModuleInstance($module, $version); // <- Why am I getting not installed modules at this point? Core bug?
              
              if(!is_object($obj) || !in_array($module, $installed_modules)) 
              {              
                self::SetDisabledStatus($type, true);
                $disabled = true;
                break; // <- If one dependency fails, all of em fail.
                
              } 
              elseif(isset($fielddefs[$type]) && $fielddefs[$type]->disabled) 
              {            
                self::SetDisabledStatus($type, false);
              }
            }
          }
        }
        
        // Fielddef not in database, register it.
        if(!isset($fielddefs[$type]))
        {                  
          self::Register($mod_name, $type, $path, $disabled);
        }
        else 
        {        
          unset($fielddefs[$type]);
        }        
      }
    }
      
    // Unregister fielddefs
    foreach($fielddefs as $onedef)
    {  
      if(
          !is_readable($onedef->path . DIRECTORY_SEPARATOR . self::FilenameFromType($onedef->type)) || 
          !in_array($onedef->originator, $installed_modules)
        ) 
      {      
        self::Unregister($onedef->type);
      }
    }    
  }
  
  static private function ScanDirForFielddefs($src, &$res)
  {
    $invalid =  array('.', '..');
    $dir = opendir($src); // <- Throw exception on failure?

    while(false !== ($file = readdir($dir))) 
    {  
      if (in_array($file, $invalid)) continue; // <- Skip stuff we never allow to copy

      if (is_dir($src . DIRECTORY_SEPARATOR . $file)) 
      { 
        self::ScanDirForFielddefs($src . DIRECTORY_SEPARATOR . $file, $res); 
      } 
      else 
      { 
        
        if(startswith($file, self::FIELDDEF_PREFIX . '.') && endswith($file, '.php')) 
        {      
          $fn = $src . DIRECTORY_SEPARATOR . $file;
          
          if(is_readable($fn)) 
          {
            $file = explode('.', $file);
            $res[$file[1]] = $src;
          }          
        }
      } 
    } 
    
    closedir($dir);     
  }
  
  static private function FilenameFromType($type)
  {
    return self::FIELDDEF_PREFIX . '.' . $type . '.php';
  }
  
  static private function ClassnameFromType($type)
  {
    return self::FIELDDEF_PREFIX . '_' . $type;
  }  
  
  #---------------------
  # Load methods
  #---------------------     
  
  static private function LoadDatabaseInfo($force_db = false, $load_all = false)
  {
    if(is_array(self::$_fielddefs) && !$force_db)
    {     
      return self::$_fielddefs;
    }
    
    $db = cmsms()->GetDb();
    self::$_fielddefs = array();
  
    $query = "SELECT * FROM " . cms_db_prefix() . "module_lise_fielddefs";
      
    if(!$load_all)
    {
      $query .= " WHERE active = 1 AND disabled = 0";
    }
      
    $query .= " ORDER BY type";
    
    $dbr = $db->Execute($query);

    while ($dbr && $row = $dbr->FetchRow()) 
    {
      $obj = new stdClass();
    
      $obj->type = $row['type'];
      $obj->originator = $row['originator'];
      $obj->active = $row['active'] ? true : false;
      $obj->disabled = $row['disabled'] ? true : false;
      $obj->path = $row['path'];
    
      self::$_fielddefs[$row['type']] = $obj;
    }
  
    return self::$_fielddefs;  
  }

  public static function LoadFielddefByType($type, $mod = null)
  {
    $fielddefs = self::LoadDatabaseInfo();
    
    if(isset($fielddefs[$type])) 
    {
      if(!cms_utils::module_available($fielddefs[$type]->originator)) { return false; }
      
      $fn = $fielddefs[$type]->path . DIRECTORY_SEPARATOR . self::FilenameFromType($type);
      
      if(is_readable($fn)) 
      {
        require_once($fn);
        $class = self::ClassnameFromType($type);
        $obj = new $class($fielddefs[$type], $mod);
        
        return $obj;
      }
    }
    
    return false;
  }

  public static function GetFielddefTypes($mode = LISE::MODE_LIST, $instance = NULL) : array
  {
    $fielddefs = self::LoadDatabaseInfo();
    
    $result = [];
    foreach($fielddefs as $onedef)
    {
      if($mode == LISE::MODE_LOCAL && !in_array($onedef->type, self::$_allowed_local) ) continue;
      if($mode == LISE::MODE_GLOBAL && !in_array($onedef->type, self::$_allowed_global) ) continue;
      
      $obj = self::LoadFielddefByType($onedef->type, $instance);
      if( is_object($obj) ) $result[$obj->GetFriendlytype()] = $obj->GetType();
    }
    
    ksort($result);
    
    return $result;
  }
  
  static function GetRegisteredFielddefs($force_db = false, $load_all = false, $instance = NULL)
  {
    $fielddefs = self::LoadDatabaseInfo($force_db, $load_all);
    
    $result = array();
    foreach($fielddefs as $onedef) 
    {
      $obj = self::LoadFielddefByType($onedef->type, $instance);
      if(is_object($obj))
      {  
        $result[$obj->GetFriendlytype()] = $obj;
      }
    }
      
    return $result;  
  }

  #---------------------
  # Module help methods
  #---------------------   
  
  static function GetHeaderHTML()
  {
    $fielddefs = self::LoadDatabaseInfo();
    
    $string = '';
    foreach($fielddefs as $onedef)
    {
      $obj = self::LoadFielddefByType($onedef->type);
      
      if(is_object($obj)) 
      {    
        $field_header_html = $obj->GetHeaderHTML();
        
        if(NULL !== $field_header_html)
          $string .= $field_header_html;
          
        unset($obj);
      }
    }
      
    return $string;  
  }
  
  #---------------------
  # Toggle methods
  #---------------------   
  
  public static function ToggleActive($type)
  {
    $db = cmsms()->GetDb();
  
    $query  = 'SELECT active FROM ' . cms_db_prefix() . 'module_lise_fielddefs WHERE type=?';
    $active = $db->GetOne($query, array($type));
      
    $active = $active ? false : true;
  
    self::SetActiveStatus($type, $active);
    
    return $active;
    
  }
  
  public static function SetActiveStatus($type, $status) : void
  {
    $db = cmsms()->GetDb();
    
    $query  = 'UPDATE ' . cms_db_prefix() . 'module_lise_fielddefs SET active=? WHERE type=?';
    $result = $db->Execute($query, array($status, $type));

    if(!$result)
      throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB ); 
    
  }

  // Not used currently anywhere
  public static function ToggleDisabled($type)
  {
    $db = cmsms()->GetDb();
  
    $query  = 'SELECT disabled FROM ' . cms_db_prefix() . 'module_lise_fielddefs WHERE type=?';
    $active = $db->GetOne($query, array($type));
      
    $active = $active ? false : true;
  
    self::SetDisabledStatus($type, $active);
    
    return $active;
    
  }
  
  public static function SetDisabledStatus($type, $status) : void
  {
    $db = cmsms()->GetDb();
    
    $query  = 'UPDATE ' . cms_db_prefix() . 'module_lise_fielddefs SET disabled=? WHERE type=?';
    $result = $db->Execute($query, array($status, $type));
    
    if (!$result) 
      throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB ); 
    
  }    
  
  #---------------------
  # Register methods
  #---------------------     

  static public function Register($originator, $type, $path, $disabled = 0, $active = 1) : bool
  {
    $db = cmsms()->GetDb();
    
    $query  = 'SELECT originator FROM ' . cms_db_prefix() . 'module_lise_fielddefs WHERE type=?';
    $exists = $db->GetOne($query, array($type));
    
    if($exists) return false;
        
    $query  = 'INSERT INTO ' . cms_db_prefix() . 'module_lise_fielddefs (type, originator, path, active, disabled) VALUES (?,?,?,?,?)';
    $result = $db->Execute($query, array($type, $originator, $path, $active, $disabled));

    if(!$result) 
      throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB ); 
    
    return true;
  }
  
  // Make brute force attempt to wipe it from modules
  public static function Unregister($type) : bool
  {
    $db = cmsms()->GetDb();

    $query = 'DELETE FROM ' . cms_db_prefix() . 'module_lise_fielddefs WHERE type = ?';
    $result = $db->Execute($query, array($type));
    
    if(!$result) 
      throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB ); 
    
    return true;    
  }
  
  #---------------------
  # Framework methods
  #---------------------   

  public static function Save(LISE &$mod, LISEFielddefBase &$obj) : void
  {
    $db = cmsms()->GetDb();  
  
    // generate alias if not supplied
    if ($obj->GetAlias() == '') 
    {
      $alias = lise_utils::generate_alias($obj->GetName(), $obj->GetFriendlyType());
      while(self::Load($mod, 'alias', $alias) != false) {$alias .= '_';}
      $obj->SetAlias($alias);
    }  
  
    // update
    if ($obj->GetId() > 0) 
    {
    
      $query =  'UPDATE ' 
                . cms_db_prefix() 
                . 'module_' 
                . $mod->_GetModuleAlias() 
                . '_fielddef SET name = ?, alias = ?, help = ?, type = ?, required = ?, template=? WHERE fielddef_id = ?';
      
      $result = $db->Execute(
                              $query, 
                              array(
                                      $obj->GetName(), 
                                      $obj->GetAlias(), 
                                      $obj->GetDesc(), 
                                      $obj->GetType(), 
                                      $obj->GetRequired(),
                                      $obj->GetTemplate(),
                                      $obj->GetId()
                                    )
                            );
      if(!$result) 
        throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB ); 

    // insert
    } 
    else 
    {
    
      $query = 'SELECT max(position) + 1 FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef';
      
      $position = $db->GetOne($query);
      
      if ($position == null) $position = 1;
      
      $query = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef (name, alias, help, type, position, required, template) VALUES (?, ?, ?, ?, ?, ?, ?)';
      
      $result = $db->Execute(
                              $query,
                              [
                                $obj->GetName(),
                                $obj->GetAlias(),
                                $obj->GetDesc(),
                                $obj->GetType(),
                                $position,
                                $obj->GetRequired(),
                                $obj->GetTemplate()
                              ]
                            );

      if(!$result) 
        throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB );      

      $obj->SetId($db->Insert_ID());  
    }
    
    // Drop all options
    $query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef_opts WHERE fielddef_id = ?';
    $result = $db->Execute($query, array($obj->GetId()));    
    
    if(!$result) 
      throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB );    
    
    $query = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef_opts (fielddef_id, name, value) VALUES (?, ?, ?)';
    
    // Insert all options
    foreach($obj->GetOptionValues() as $key=>$value)
    {
      $result = $db->Execute($query, array($obj->GetId(), $key, $value));      
      
      if(!$result) 
        throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB );      
    }
  }
  
  public static function Delete(LISE $mod, $fielddef_id) : void
  {
    $db = cmsms()->GetDb();
/*    
    // Handle external databases (this might not belong here, double check)
    $fielddef = self::Load($mod, 'fielddef_id', $fielddef_id);
    $fielddef->EventHandler()->Delete($mod);
*/    
    // get details
    $query = 'SELECT * FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef WHERE fielddef_id = ?';
    $row = $db->GetRow($query, array($fielddef_id));
      
    // delete field definitions
    $query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef WHERE fielddef_id = ?';
    $db->Execute($query, array($fielddef_id));
    
    // delete field definitions options
    $query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef_opts WHERE fielddef_id = ?';
    $db->Execute($query, array($fielddef_id));  
    
    // delete field values
    $query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fieldval WHERE fielddef_id = ?';
    $db->Execute($query, array($fielddef_id));
    
    // clean up sort order
    $query = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef SET position = (position - 1) WHERE position > ?';
    $db->Execute($query, array($row['position']));
    
  }
  
  /**
   * Loads fielddef object
   *
   * @LISE &$mod, Array $row
   * @LISE &$mod, String $key, String $value
   * @return bool|\LISEFielddefBase
   * @throws \Exception
   */
  public static function Load()
  {
    $args = func_get_args();
    $mod = $args[0];
    $row = 2 == count($args) ? $args[1] : false;
    $db = cmsms()->GetDb();  
    
    if(!$row) 
    {
      foreach(self::$identifiers as $db_column => $identifier)
      {
        if($identifier == $args[1]) 
        {
          $query = "SELECT * FROM " . cms_db_prefix() . "module_" . $mod->_GetModuleAlias() . "_fielddef
                    WHERE $db_column = ? 
                    LIMIT 1";                  
                    
          $row = $db->GetRow($query, [$args[2]]);
          
          if($row) { break; }
        }
      }
    }

    if($row) 
      {
    
      $obj = self::LoadFielddefByType($row['type'], $mod);
      
      if(is_object($obj)) 
      {
        // Fill object
        $obj->SetId($row['fielddef_id']);
        $obj->SetName($row['name']);
        $obj->SetAlias($row['alias']);
        $obj->SetDesc($row['help']);
        $obj->SetPosition($row['position']);
        $obj->SetRequired($row['required']);
        $obj->SetTemplate($row['template']);
        
        // Set options
        $query = 'SELECT name, value FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef_opts WHERE fielddef_id = ?';
        $dbr = $db->Execute($query, array($obj->GetId()));
        
        while($dbr && !$dbr->EOF)
        {
          $obj->SetOptionValue($dbr->fields['name'], $dbr->fields['value']);
          $dbr->MoveNext();
        }    

        if($dbr) $dbr->Close();

        return $obj;
      }
    }
      
    return FALSE;  
  }
  
  #---------------------
  # Utility methods
  #---------------------     
  
  public static function LoadValuesForFieldDef(LISE $mod, LISEFielddefBase $obj, $sortby = 'value|ASC')
  {

    $orderby_map = [
                      'value'         => 'fv.value',
                      'item_id'       => 'fv.item_id',
                      'alias'         => 'i.alias',
                      'title'         => 'i.title',
                      'position'      => 'i.position',
                      'create_time'   => 'i.create_time',
                      'modified_time' => 'i.modified_time'
    ];
                        

                        
    $col_parts = explode('|', $sortby);
    
    // column name
    $col_name = $col_parts[0];
    $col_order = 'ASC';
    
    // order column ascending or descending
    if( isset($col_parts[1]) ) 
    {
      #this needs revisiting (JM)
      $col_order = ( in_array(strtoupper($col_parts[1]), array('ASC', 'DESC') ) ? $col_parts[1] : 'ASC');
    }
    
    $col_order = ( in_array($col_order, array('ASC', 'DESC') ) ? $col_order : 'ASC');
    
    if(isset($orderby_map[$col_name])) 
    {
      $order_by = ' ORDER BY ' . $orderby_map[$col_name] . ' ' . $col_order;
    }
    else
    {
      $order_by = ' ' . $col_order;
    }    
    
    $db = cmsms()->GetDb();
    $obj->values = []; # declared dynamically TODO: check if is a valid use - (JM)
      
    $query = 'SELECT fv.value, fv.item_id, i.item_id, i.position FROM '
              . cms_db_prefix() 
              . 'module_' 
              . $mod->_GetModuleAlias() . '_fieldval AS fv, '
              . cms_db_prefix() 
              . 'module_' 
              . $mod->_GetModuleAlias() . '_item AS i '               
              . ' WHERE fv.item_id = i.item_id AND '
              . 'fielddef_id = ? GROUP BY fv.value' . $order_by;
    
    $dbr = $db->Execute( $query, array( $obj->GetId() ) );
    
    $values = [];

    while($dbr && $row = $dbr->FetchRow())
    {
      $values[] = $row['value']; 
    }     
    
    if($obj->type === 'LISEInstanceItem')
    {
      
      if( $col_name != 'value' && isset($orderby_map[$col_name])) 
      {
        $order_by = ' ORDER BY ' . $col_name . ' ' . $col_order;
      }
      else
      {
        $order_by = ' ORDER BY item_id ' . $col_order;
      }
  
      $identifier    = $obj->GetOptionValue('identifier');
      $instance_name = $obj->GetOptionValue('instance');
     
      $query = 'SELECT * FROM '
      . cms_db_prefix() 
      . 'module_' 
      . strtolower($instance_name) . '_item  '
      . 'WHERE ' . $identifier 
      . ' IN ('
      . implode(',', array_fill(0, count($values), '?') )
      . ')'
      . $order_by;
     
      $dbr = $db->Execute($query, $values);
      
      $values = array();

      while($dbr && $row = $dbr->FetchRow())
      {
        $values[] = $row[$identifier];
      }        
    }     
    
    $obj->values = $values;

    return $obj->values;
  }
  
  
  /**
   * @param LISE  $mod
   * @param mixed $type
   *
   * @return bool
   * @throws \Exception
   */
  public static function TestExistenceByType(LISE &$mod, $type) : bool
  {      
    $db = cmsms()->GetDb();
  
    $query = 'SELECT fielddef_id FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fielddef WHERE type = ?';
    $exists = $db->GetOne($query, array($type));
    
    if($exists)
      return $exists;
      
    return FALSE;
  }
  
  
  
  public static function GetDbValuesRequirements(LISEInstance $instance, $minimal = TRUE)
  {
    $database_values = [];
    $_invalid_values = ['create_time', 'modified_time'];
    $item            = $instance->InitiateItem();
    $admintheme    = \cms_utils::get_theme_object();
  
    foreach( $item as $k => $v )
    {
    
      if( $v instanceof LISEFielddefArray )
      {
      
        foreach( $v as $f )
        {
          $obj = new stdClass;
        
          if( in_array( $f->GetAlias(), $_invalid_values ) ) { continue; }
        
          $obj->alias          = $f->GetAlias();
          $obj->required       = $f->IsRequired() ? 1 : 0;
          
          if(!$minimal)
          {
            $obj->required_image = $f->IsRequired() ? $admintheme->DisplayImage(
              'icons/system/true.gif', '', '', '', 'systemicon'
            ) : $admintheme->DisplayImage('icons/system/false.gif', '', '', '', 'systemicon');
            $obj->help           = $f->GetDesc();
          }

          $database_values[]   = $obj;
        }
      }
      else
      {
        $obj = new stdClass;
      
        if( in_array( $k, $_invalid_values ) ) { continue; }
      
        $obj->alias          = $k;
        $obj->required       = in_array($k, LISEItem::$mandatory) ? 1 : 0;
        if(!$minimal)
        {
          $obj->required_image = in_array($k, LISEItem::$mandatory)
            ? $admintheme->DisplayImage('icons/system/true.gif', '', '', '', 'systemicon')
            : $admintheme->DisplayImage(
              'icons/system/false.gif', '',
              '', '', 'systemicon'
            );
          $obj->help           = $instance->ModLang('item_var_help_' . $k);
        }

        $database_values[]   = $obj;
      }
    
    }
  
    unset($item);
  
    return $database_values;
  }
  
  /**
   * Enforce the Unique and Last
   * properties for the fields
   *
   * note: still a bit raw...
   *
   * @param $array
   *
   * @return array|void
   */
  public static function ProcessFieldsList(&$array)
  {
    $array = $array ?? [];
    if( empty($array) ) { return $array; }
  
    $c      = \count($array);
    $last   = [];
    $unique = [];
    $stack  = [];
    
    foreach($array as $k => $field)
    {
      $f = 0;
      
      if( $c > 1 && $field->IsLast() )
      {
        $last[] = $field;
        $f = 1;
      }
      
      if( $field->IsUnique() )
      {
        $unique[] = $field;
        if(\count($unique) < 1 )
        {
          $stack[] = $field;
        }
      }
      elseif(!$f) # is not flagged as last add it
      {
        $stack[] = $field;
      }
      
      # nothing to do here: we're already past the conditions to add the field
    }
  
    if(count($unique) > 1)
    {
      \audit(0, 'ProcessFieldsList', 'note: too many unique fields!');
    }
  
    if(count($last) > 1)
    {
      \audit(0, 'ProcessFieldsList', 'note: too many last fields!');
    }
  
    # there can be only one!!!!
    $stack[] = array_shift($last);
    
    # another pass to set the positions right
    foreach($array as $k => $field)
    {
      $field->SetPosition($k);
    }
    
    $array = $stack;
  }
  
} // end of class

?>