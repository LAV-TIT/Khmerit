<?php


namespace LISE;


final class title_generator
{
  /**
   * private props
   */
  private static $_instance = NULL;
  private        $_parser   = NULL;
  private        $_instance_name;
  
  /**
   * public props
   */
  
  /**
   * private methods
   */
  private function __construct()
  {
    # tag name => [type, callable]
    $tags = [
              'RandomString' => [ 'function', [$this, '_random_string'] ],
              'ItemCounter'  => [ 'function', [$this, '_item_counter'] ],
              'ItemNextID'   => [ 'function', [$this, '_item_next_id'] ],
              'ItemSingular' => [ 'function', [$this, '_item_singular'] ],
              'ItemPlural'   => [ 'function', [$this, '_item_plural'] ]
    ];
  
    $this->_parser = new mini_smarty_parser();
    $this->_parser ->RegisterTags($tags);
  }
  
  private function _count()
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    $db = \cms_utils::get_db();
    
    $query = 'SELECT count(*) FROM '
             . \cms_db_prefix()
             . 'module_' . $instance->_GetModuleAlias() . '_item';
    
    return (int)$db->GetOne($query);
    
  }
  
  private function _last_id()
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    $db = \cms_utils::get_db();
  
    $query = 'SELECT MAX(item_id) FROM '
             . \cms_db_prefix()
             . 'module_' . $instance->_GetModuleAlias() . '_item';
    
    return (int)$db->GetOne($query);
  }
  
  /**
   * public methods
   */
  
  public static function getInstance()
  {
    if (self::$_instance == null){ self::$_instance = new title_generator();}
    
    return self::$_instance;
  }
  
  function _random_string($params, $smarty)
  {
    $length = isset($params['l']) ? (int)$params['l'] : 10;
    $flags = isset($params['f']) ? (string)$params['f'] : 'm';
    
    $f = RandomString::MIXED;
    $flags = str_split( strtolower($flags) );
    
    foreach($flags as $flag)
    {
      switch ($flag)
      {
        case 'l':
          $f = $f | RandomString::LOWER;
        break;
        case 'u':
          $f = $f | RandomString::UPPER;
        break;
        case 'd':
          $f = $f | RandomString::DIGITS;
        break;
      }
    }
    
    return RandomString::get($length, $f);
  }
  
  
  function _item_singular($params, $smarty)
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    
    if( !is_object($instance) ) throw new \LISEException('Could not load instance ' . $this->_instance_name);
    
    return $instance->GetPreference('item_singular');
  }
  
  
  function _item_plural($params, $smarty)
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    
    if( !is_object($instance) ) throw new \LISEException('Could not load instance ' . $this->_instance_name);
    
    return $instance->GetPreference('item_plural');
  }
  
  
  function _item_counter($params, $smarty)
  {
    return 1 + $this->_count();
  }
  
  function _item_next_id($params, $smarty)
  {
    return 1 + $this->_last_id();
  }
  
  /*** *** ***/
  
  /**
   * @param string $instance_name
   *
   * @return string
   * @throws \LISEException
   */
  function generate_new($instance_name = '')
  {
    $this->_instance_name = $instance_name;
    $instance             = \cms_utils::get_module($instance_name);
    
    if( !is_object($instance) ) throw new \LISEException('Could not load instance ' . $instance_name);
  
    $template = $instance->GetPreference('title_template', '{ItemSingular|capitalize} - {ItemNextID|string_format:"%06u"}');
    
    try
    {
      $out = $this->_parser->Load($template)->Parse();
    }
    catch(\Exception $e)
    {
      \audit( 0, __METHOD__ , $e->getMessage() );
      throw $e;
    }
    
    return $out;
  }
}

?>