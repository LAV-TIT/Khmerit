<?php


namespace LISE;


final class slug_generator
{
  /**
   * private props
   */
  private static $_instance = NULL;
  private        $_parser   = NULL;
  private        $_instance_name;
  private        $_item_categories;
  private        $_item_prefix;
  private        $_item_title;
  
  
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
              'ItemCategory' => [ 'function', [$this, '_item_category'] ],
              'ItemTitle'    => [ 'function', [$this, '_item_title'] ],
              'ItemAlias'    => [ 'function', [$this, '_item_alias'] ],
              'Prefix'       => [ 'function', [$this, '_item_prefix'] ]
    ];
  
    $this->_parser = new mini_smarty_parser();
    $this->_parser ->RegisterTags($tags);
  }
  
  private function _count()
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    $db = \cms_utils::get_db();
  
    $query = 'SELECT count(*) as c FROM '
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
  
  private function _find_tag($haystack, $needle)
  {
    return (bool) strstr($haystack, $needle);
  }
  
  /**
   * we remove all weird chars tha may have been generated in the template
   * and keep the url under 2k characters in length
   * this should keep it working on all clients
   *
   * @param $url
   *
   * @return bool|string
   */
  private function _trim($url)
  {
    return substr(trim($url," /\t\r\n\0\x08"),0,2000);
  }
  
  private function _invalid_route($out, $item_id)
  {
    $route = \cms_route_manager::find_match($out);
    
    if(!$route) return FALSE;
    
    $instance = \cms_utils::get_module($this->_instance_name);
    $dflts    = $route->get_defaults();
    
    $r        = $route->is_content();
    $r        = $r || $route->get_dest() != $instance->GetName();
    $r        = $r || !isset($dflts['item']);
    $r        = $r || $dflts['item'] != $item_id;
    
    return $r;
  }
  
  /**
   * public methods
   */
  
  public static function getInstance()
  {
    if (self::$_instance == null){ self::$_instance = new slug_generator();}
    
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
  
  public function _item_singular($params, $smarty)
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    
    if( !is_object($instance) ) throw new \LISEException('Could not load instance ' . $this->_instance_name);
    return $instance->GetPreference('item_singular');
  }
  
  
  public function _item_plural($params, $smarty)
  {
    $instance = \cms_utils::get_module( $this->_instance_name);
    
    if( !is_object($instance) ) throw new \LISEException('Could not load instance ' . $this->_instance_name);
    return $instance->GetPreference('item_plural');
  }
  
  public function _item_title($params, $smarty)
  {
    return $this->_item_title;
  }
  
  
  public function _item_category($params, $smarty)
  {
    if(count($this->_item_categories))
    {
      $category_name = \munge_string_to_url( trim($this->_item_categories[0]) );
    }
    else
    {
      $category_name = 'no-category';
    }
    return $category_name;
  }
  
  public function _item_alias($params, $smarty)
  {
    return api::GenerateAlias($this->_instance_name, $this->_item_title);
  }
  
  public function _item_prefix($params, $smarty)
  {
    return $this->_item_prefix;
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
   * @param $instance_name
   * @param $title
   * @param $iid
   * @param $cid
   *
   * @return string
   * @throws \LISEException
   */
  public function generate_new($instance_name, $title, $iid, $cid)
  {
    $this->_instance_name = $instance_name;
    $this->_item_title    = $title;
    $instance             = \cms_utils::get_module($instance_name);
    
    if( !is_object($instance) ) throw new \LISEException('Could not load instance ' . $instance_name);
    
    $this->_item_prefix = $instance->GetPreference( 'url_prefix', \munge_string_to_url($instance->GetName(), true) );
    $template = $instance->GetPreference('urltemplate', '{$prefix}/{$item_title}');
    
    if( $this->_find_tag($template, '{$item_category') ||  $this->_find_tag($template, 'ItemCategory'))
    {
      $ids = array($cid);
      $this->_item_categories = \LISECategoryOperations::GetCategoryNameFromId($instance, $ids);
      
      if(count($this->_item_categories))
      {
        $category_name = \munge_string_to_url( trim($this->_item_categories[0]) );
      }
    }
    else
    {
      $category_name = 'no-category';
    }
    
    $smarty = $this->_parser->GetCustomSmartyObject();
    $smarty->assign('item_title',  trim($title) )
    ->assign('item_category',  $category_name)
    ->assign('prefix', $this->_item_prefix);
    $compare = '';
    $c = 0;

    \cms_route_manager::load_routes();
  
    do
    {
      $tmp = $compare;
      $out = $this->_parser->Load('{strip}' .$template. '{/strip}')->Parse();
      $compare = $out = \munge_string_to_url ($this->_trim($out), FALSE, TRUE );
      
      # the template won't solve uniqueness?
      if($tmp === $compare)
      {
        # we'll add an incremental numeric suffix inf the form of '-n'
        $test = $out;
  
        do
        {
          $suffix = '-' . $c++;
          $out = $test . $suffix;
          
          # break infinite loop
          if($c > 100) throw new \Exception('too many iterations');
          
        }
        while( $this->_invalid_route($out, $iid) );
      }
    }
    while( $this->_invalid_route($out, $iid) );
    
    return $out;
  }
}

?>