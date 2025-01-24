<?php


namespace LISE;


final class modules_ops
{
  private static $_instance = null;
  protected static $_mods = [];
  
  /**
   * private methods
   */
  
  private function __construct(){}
  
  /**
   * copies modules names core knows about
   * @return array
   */
  private static function load_modules()
  {
    if( empty(self::$_mods) )
    {
      self::$_mods = \cmsms()->GetModuleOperations()->GetAllModuleNames();
    }
    
    return self::$_mods;
  }
  
  /**
   * public methods
   */
  
  public static function getInstance()
  {
    if (self::$_instance == null)
    {
      self::$_instance = new modules_ops();
    }
    
    return self::$_instance;
  }
  
  public static function exists($module_name = '')
  {
    self::load_modules();
    
    return in_array($module_name, self::$_mods);
  }
  
  public static function is_active($module_name = '')
  {
    if( self::exists($module_name) )
    {
      return \cmsms()->GetModuleOperations()->IsModuleActive($module_name);
    }
  }
}

?>