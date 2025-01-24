<?php


namespace LISE;


final class alias_generator
{
  /**
   * private props
   */
  private static $_instance = null;
  private  $_parser = NULL;
  private  $_instance_name;
  private  $_item_title;
  
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
              'ItemPlural'   => [ 'function', [$this, '_item_plural'] ],
              'ItemTitle'    => [ 'function', [$this, '_item_title'] ]
    ];
  
    $this->_parser = new mini_smarty_parser();
    $this->_parser ->RegisterTags($tags);
  }
  
  private function _conform($str)
  {
    // left trim up to the first letter
    $str = preg_replace('/^[^a-zA-Z0-9_\x7f-\xff]*/', '', $str);
  
    // replace any invalid characters with an underscore
    $str = preg_replace('/[^a-zA-Z0-9_\-\x7f-\xff]/', '_', $str);
  
    // replace multiple underscores with single underscore
    $str = preg_replace('/_+/', '_', $str);
  
    // convert to lowercase
    $str = strtolower($str);
  
    // remove underscore from start and end
    $str = trim($str, '_');
    
    return $str;
  }
  
  private function _starts_with_digits($str)
  {
    return preg_match('/^\d/', $str) === 1;
  }
  
  private function _count()
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    $db = \cms_utils::get_db();
  
    $query = 'SELECT count(*) FROM '
             . \cms_db_prefix()
             . 'module_' . $instance->_GetModuleAlias() . '_item';
  
    return $db->GetOne($query );
    
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
  
  private function _is_unique($alias)
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    $db = \cms_utils::get_db();
    
    $query = 'SELECT count(*) as c FROM '
             . \cms_db_prefix()
             . 'module_' . $instance->_GetModuleAlias()
             . '_item WHERE alias = ?';
    
    return !(bool)$db->GetOne($query, array($alias) );
  }
  
  
  /**
   * public methods
   */
  
  public static function getInstance()
  {
    if (self::$_instance == null){ self::$_instance = new alias_generator();}
    
    return self::$_instance;
  }
  
  public function _random_string($params, $smarty)
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
  
  
  function _item_singular()
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    
    if( !is_object($instance) ) throw new \LISEException('Could not load instance ' . $this->_instance_name);
    
    return $instance->GetPreference('item_singular');
  }
  
  
  function _item_plural()
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    
    if( !is_object($instance) ) throw new \LISEException('Could not load instance ' . $this->_instance_name);
    return $instance->GetPreference('item_plural');
  }
  
  public function _item_title($params, $smarty)
  {
    $r = empty($this->_item_title) ? api::GenerateTitle() : $this->_item_title;
    $r = empty($r) ? 'lise_title_error' :$r;
    return $r;
  }
  
  public function _item_counter($params, $smarty)
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
   * @param string $title
   *
   * @return string|string[]|null
   * @throws \LISEException
   */
  function generate_new($instance_name = '', $title = '')
  {
    if( empty($instance_name) ) $instance_name = api::InstanceName();
    $this->_instance_name = $instance_name;
    $this->_item_title    = $title;
    $instance = \cms_utils::get_module($instance_name);
    
    if( !is_object($instance) ) throw new \LISEException('Could not load instance ' . $instance_name);
  
    $template = $instance->GetPreference('alias_template', '');
    
    $compare = '';
    $c = 0;
    
    do
    {
      $tmp = $compare;
      $out = $this->_parser->Load($template)->Parse();
      
      $compare = $out = $this->_conform($out);
      
      # the template won't solve uniqueness?
      if($tmp === $compare)
      {
        # we'll add an incremental numeric suffix inf the form of '_n'
        $test = $out;
        
        do
        {
          $suffix = '_' . $c++;
          $out = $test . $suffix;
        }
        while(!$this->_is_unique($out));
      }
    }
    while( !$this->_is_unique($out) );
    
    return $out;
  }
}

?>