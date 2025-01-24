<?php


namespace LISE;
use \LISE\instances_operations as io;

class smarty_global
{
  private static $_global_instances = [];
  private static $_props;
  private static $_initialized = FALSE;
  
  private static function _initialize()
  {
    if(!self::$_initialized)
    {
      # instances and properties
      foreach(io::ListModules(\LISE::MODE_GLOBAL) as $one)
      {
        self::$_global_instances[] = $one->module_name;
        $mod = \cms_utils::get_module($one->module_name);
        
        $item = $mod->LoadItemByIdentifier('alias', $one->module_name);
        $fds = $item->fielddefs;
  
        foreach($fds as $one)
        {
          self::$_props[$one['alias']] = $one['value'];
        }
      }
      
      self::$_initialized = TRUE;
    }
  }
  
  static function get($property = '')
  {
    if( !empty($property) )
    {
      self::_initialize();
      
      if(isset( self::$_props[$property]) ) return self::$_props[$property];
    }
    
    return '<!-- invalid -->';
  }
}

?>