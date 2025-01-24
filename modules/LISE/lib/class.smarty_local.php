<?php


namespace LISE;

class smarty_local
{
  private static $_instances = [];
  private static $_local_instances = [];
  private static $_props = [];
  
  private static function _get_instance()
  {
    $instance_name = \cms_utils::get_app_data('lise_instance');
    
    if( empty($instance_name) ) return;
    
    if( !isset(self::$_instances[$instance_name]) )
    {
      self::$_instances[$instance_name] = \cms_utils::get_module($instance_name);
    }
    
    return self::$_instances[$instance_name];
  }
  
  private static function _get_local_instance_name()
  {
    $instance = self::_get_instance();
    
    if( !is_object($instance) ) return;
    
    return $instance->GetPreference('local_mode_instance');
  }
  
  private static function _get_local_instance()
  {
    $instance_name = self::_get_instance();
    
    if( empty($instance_name) ) return;
    
    $local_name = self::_get_local_instance_name();
    
    if( !isset(self::$_local_instances[$local_name]) )
    {
      self::$_local_instances[$local_name] = \cms_utils::get_module($local_name);
    }
    
    return self::$_local_instances[$local_name];
  }
  
  private static function _get_prop($property = '')
  {
    if( empty($property) ) return '<!-- invalid -->';
  
    $instance_name = \cms_utils::get_app_data('lise_instance');
    
    if( empty($instance_name) ) return '<!-- invalid: called outside instance scope -->';
    
    if( !isset(self::$_props[$instance_name][$property] ) )
    {
      $mod = self::_get_local_instance();
      $item = $mod->LoadItemByIdentifier('alias', $instance_name);
  
      foreach($item->fielddefs as $one)
      {
        self::$_props[$instance_name][$one['alias']] = $one['value'];
      }
      
      # still doesn't exist?
      if( !isset(self::$_props[$instance_name][$property] ) ) return '<!-- invalid -->';
    }
    
    return self::$_props[$instance_name][$property];
  }
  
  static function get($property = '')
  {
    return self::_get_prop($property);
  }
  
}

?>