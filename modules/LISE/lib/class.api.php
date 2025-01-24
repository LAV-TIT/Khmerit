<?php


namespace LISE;


class api
{
  /**
   * private props
   */
  
  private static ?api $_instance = NULL;
  
  
  /**
   * public props
   */
  
  /**
   * private methods
   */
  private function __construct(){}
  
  /**
   * allows for some type of overloading:
   * $instance can be either a valid LISE instance name
   * or the instance itself...
   * if left empty (NULL) it will try to determine
   * the instance from the context
   *
   * @param null $instance
   *
   * @return \LISEInstance|null
   */
  private static function _overload_lise_get_instance($instance = NULL) : ?\LISEInstance
  {
    $ret = NULL;
    
    if( !\is_a($instance, \LISEInstance::class) )
    {
      if( \is_string($instance) )
      {
        if( empty($instance) ){ $instance = self::InstanceName(); }
        
        if('LISE' !== $instance)
        {
          $ret = \cms_utils::get_module($instance);
        }
      }
    }
    else
    {
      $ret = $instance;
    }
    
    return $ret;
  }
  
  
  /**
   * public methods
   */
  
  public static function getInstance() : ?api
  {
    if (null === self::$_instance){ self::$_instance = new self;}
    
    return self::$_instance;
  }
  
  /************************
   * Public API
   ************************/
  
  /*********************************************************************************/
  
  /**
   * Instance(s) functions
   */
  
  /**
   * Tries to determine the instance name
   * from the request context
   * will return an empty string if impossible to determine
   * or the name of the instance
   *
   * @return string
   */
  public static function InstanceName() : string
  {
    $instance_name = \cms_utils::get_app_data('lise_instance');
    if( empty($instance_name) ) $instance_name = '';
    
    return $instance_name;
  }
  
  /**
   * Tries to determine the instance
   * from the request context
   * will return the instance or NULL
   * if impossible to determine
   *
   * @param string $instance_name
   *
   * @return \LISEInstance|null
   */
  public static function InstanceObj($instance_name = '') : ?\LISEInstance
  {
    $obj = NULL;
    
    if( empty($instance_name) )
    {
      $instance_name = self::InstanceName();
    }
    
    if( !empty($instance_name) )
    {
      $obj = self::_overload_lise_get_instance($instance_name);
      
      if( \is_a($obj, \LISEInstance::class) ) { return $obj; }
    }
    
    return $obj;
  }
  
  /**
   * Given a LISE instance name
   * return its configuration object
   *
   * @param $mod_name
   *
   * @return \LISEConfig
   */
  public static function GetConfigForInstanceName($mod_name = 'LISE') : \LISEConfig
  {
    return ConfigManager::GetConfigForInstanceName($mod_name);
  }
  
  /**
   * Given a LISE instance name
   * or instance object
   * return its configuration object
   *
   * NOTE: it won't work for the LISE
   * main module
   *
   * @param $instance
   *
   * @return \LISEConfig
   */
  public static function GetConfigForInstance($instance) : \LISEConfig
  {
    $instance = self::_overload_lise_get_instance($instance);
    
    return ConfigManager::GetConfigInstance($instance);
  }
  
  /**
   * @param null $mode
   *
   * @return array
   * @throws \Exception
   */
  public static function GetInstancesList($mode = NULL) : array
  {
    return instances_operations::ListModules($mode);
  }
  
  /*********************************************************************************/
  
  /**
   * Items functions
   */
  
  /**
   * @param      $identifier - a valid identifier @see LISEItemOperations
   * @param      $value      - the value to search for within the identifier
   * @param bool $nofds      - whether to load the fields or not
   * @param null $instance - the instance we are working with
   *                       (the API will try to determine the current instance
   *                       from the action, but it may fail)
   *
   * @return \LISEItem|mixed|null
   * @throws \LISEException
   * @throws \LISE\Exception
   */
  public static function LoadItemByIdentifier($identifier, $value, $nofds = FALSE, $instance = NULL)
  {
    $instance = self::_overload_lise_get_instance($instance);
  
    if(!$instance)
    {
      throw new \LISEException('Could not determine instance');
    }
  
    return $instance->LoadItemByIdentifier($identifier, $value, $nofds);
  }
  
  /**
   * @param null $item
   * @param null $instance
   *
   * @throws \LISEException
   */
  public static function SaveItem($item = NULL, $instance = NULL)
  {
    $instance = self::_overload_lise_get_instance($instance);
  
    if(!$instance)
    {
      throw new \LISEException('Could not determine instance');
    }
  }
  
  /**
   * @param int  $current_id
   * @param bool $by_position
   * @param null $instance
   *
   * @return bool|mixed
   * @throws \LISEException
   * @throws \Exception
   */
  public static function PreviousItem($current_id = -1, $by_position = TRUE, $instance = NULL, $params = [])
  {
    $instance = self::_overload_lise_get_instance($instance);
    
    if(!$instance)
    {
      throw new \LISEException('Could not determine instance');
    }
    
    return \LISEItemOperations::previous_from_current($current_id, $instance, $by_position, $params);
  }
  
  /**
   * @param int  $current_id
   * @param bool $by_position
   * @param null $instance
   *
   * @return bool|mixed
   * @throws \LISEException
   */
  public static function NextItem($current_id = -1, $by_position = TRUE, $instance = NULL)
  {
    $instance = self::_overload_lise_get_instance($instance);
    
    if(!$instance)
    {
      throw new \LISEException('Could not determine instance');
    }
    
    return \LISEItemOperations::next_from_current($current_id, $instance, $by_position);
  }
  
  /**
   * Generate a title from the instance template
   * If $instance_name is empty or invalid
   * and cannot be determined from the request context
   * it will throw an exception
   *
   * @param string $instance_name
   *
   * @return mixed|string
   * @throws \LISEException
   */
  public static function GenerateTitle($instance_name = '')
  {
    if( empty($instance_name) ){ $instance_name = self::InstanceName(); }

    try
    {
      $out = title_generator::getInstance()->generate_new($instance_name);
    }
    catch(\Exception $e)
    {
      $out = '--error--';
    }
    
    return $out;
  }
  
  /**
   * @param string $instance_name
   * @param string $title
   * @param int    $iid
   * @param int    $cid
   *
   * @return string
   */
  public static function GenerateSlug($title = '', $iid = -1, $cid = -1, $instance_name = '') : string
  {
    if( empty($instance_name) ){ $instance_name = self::InstanceName(); }

    try
    {
      $out = slug_generator::getInstance()->generate_new($instance_name, $title, $iid, $cid);
    }
    catch(\Exception $e)
    {
      $out = '--error--';
    }
    
    return $out;
  }
  
  /**
   * Generate an alias from the instance template
   * If $instance_name is empty or invalid
   * and cannot be determined from the request context
   * it will throw an exception
   *
   * if title is empty a new one will be generated
   * from the instance template for titles
   *
   * @param string $instance_name
   * @param string $title
   *
   * @return string
   */
  public static function GenerateAlias($title = '', $instance_name = '') : string
  {
    if( empty($instance_name) ){ $instance_name = self::InstanceName(); }
    
    try
    {
      $out = alias_generator::getInstance()->generate_new($instance_name, $title);
    }
    catch(\Exception $e)
    {
      $out = '--error--';
    }
    
    return $out;
  }
  
  /**
   * Tests if for a duplicate Item by item_id or alias or both
   *
   * @param string $instance_name
   * @param int    $id
   * @param string $alias
   *
   * @return bool
   * @throws \Exception
   */
  public static function IsDuplicateItem($id = -1, $alias = '', $instance_name = '') : bool
  {
    if( empty($instance_name) ){ $instance_name = self::InstanceName(); }
    
    $mod = self::InstanceObj($instance_name);
    
    if( !\is_object($mod) ){ return FALSE; }
    
    if($id > 0 && !empty($alias) ){ return \LISEItemOperations::is_duplicate($mod, $id, $alias); }
    
    if($id > 0){ return \LISEItemOperations::is_duplicate_id($mod, $id); }
    
    return \LISEItemOperations::is_duplicate_alias($mod, $alias);
  
  }
  
  /**
   * fields functions
   */
  
  public static function LoadFieldDefinitions($instance_name = '')
  {
    if( empty($instance_name) ){ $instance_name = self::InstanceName(); }
  
    $mod = self::InstanceObj($instance_name);
    
    \LISEFielddefOperations::GetRegisteredFielddefs($mod);
  }
  
  /**
   * Get all field aliases for a specific instance
   *
   * @param $minimal - whether the help text and the "required" icon should be returned
   * @param $instance_name
   *
   * @return array|false
   */
  public static function GetFieldsRequirements($minimal = TRUE, $instance_name = '')
  {
    if( empty($instance_name) ){ $instance_name = self::InstanceName(); }
  
    $mod = self::InstanceObj($instance_name);
  
    if( !\is_object($mod) ){ return FALSE; }
    
    return \LISEFielddefOperations::GetDbValuesRequirements($mod, $minimal);
  }
  
  
  /**
   * general utils
   */
  
  /**
   * Get the Core DB connection
   *
   * @return \CMSMS\Database\Connection
   * @throws \Exception
   */
  public static function DB() : \CMSMS\Database\Connection
  {
    return \cms_utils::get_db();
  }
  
  /**
   * Get CMSMS core smarty object
   * @return \Smarty_CMS
   */
  public static function Smarty() : \Smarty_CMS
  {
    return \cms_utils::get_smarty();
  }
}

?>