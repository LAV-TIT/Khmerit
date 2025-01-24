<?php


namespace LISE;


class mini_smarty_parser
{
  # settings flags
  const SET_IGNORE_UNKNOWN_TAGS = 1; # 00000001
  
  /**
   * private props
   */
  private $_smarty = NULL;
  private $_settings_flags = self::SET_IGNORE_UNKNOWN_TAGS;
  private $_buffer         = '';
  private $_source         = '';
  private $_out            = '';
  private $_left_del       = '{';
  private $_right_del      = '}';
  
  
  /**
   * public props
   */
  
  /**
   * private methods
   */
  
  private function _clear_buffer()
  {
    $this->_buffer = '';
  }
  
  private function _clear_tokens()
  {
    $this->_tokens = [];
  }
  
  private function _clear_out()
  {
    $this->_out = '';
  }
  
  private function _reset()
  {
    $this->_clear_tokens();
    $this->_clear_out();
  }

  
  private function _parse()
  {
    $this->_reset();
    //$this->_source = $this->_buffer;
    $this->_out = $this->_smarty->fetch('eval:' . $this->_buffer);
  }
  
  /**
   * public methods
   */
  
  public function __construct()
  {
    $this->_smarty = new \Smarty();
    $this->_smarty->setCompileDir(TMP_TEMPLATES_C_LOCATION);
    $this->_smarty->setCacheDir(TMP_CACHE_LOCATION);
    
    // allow to use CMSMS core plugins
    $this->_smarty->addPluginsDir( \cms_join_path(CMS_ROOT_PATH, 'lib','plugins') );
    
    // register default plugin handler
    $this->_smarty->registerDefaultPluginHandler(array( $this, 'DefaultPluginHandler') );
  
    $security_policy = new \Smarty_Security($this->_smarty);
    
    $config = api::GetConfigForInstanceName();
    
    $dat_fn = \cms_join_path($config['module_path'], 'data', 'smartysafelist.dat');
    $functions = file($dat_fn, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    // allow PHP functions
    $security_policy->php_functions = $functions;
    if(version_compare(\Smarty::SMARTY_VERSION, '4.0.0') < 1)
    {
      // remove PHP tags
      $security_policy->php_handling = \Smarty::PHP_REMOVE;
    }
    // allow PHP functions as modifier
    $security_policy->php_modifiers  = $functions;
    
    // enable security
    $this->_smarty->enableSecurity($security_policy);
    
  }
  
  public static function _dflt_plugin($params, $smarty){ return ''; }
  public static function _dflt_block_plugin($params, $content, $smarty, &$repeat, $template) { return ''; }
  public static function _dflt_mod() { return ''; }
  
  
  /**
   * Default Plugin Handler
   *
   * called when Smarty encounters an undefined tag during compilation
   *
   * @param string                      $name      name of the undefined tag
   * @param string                      $type      tag type (e.g. Smarty::PLUGIN_FUNCTION, Smarty::PLUGIN_BLOCK,
   *                                               Smarty::PLUGIN_COMPILER, Smarty::PLUGIN_MODIFIER,
   *                                               Smarty::PLUGIN_MODIFIERCOMPILER)
   * @param Smarty_Internal_Template    $template  template object
   * @param string                     &$callback  returned function name
   * @param string                     &$script    optional returned script filepath if function is external
   * @param bool                       &$cacheable true by default, set to FALSE if plugin is not cacheable
   *                                               (Smarty >= 3.1.8)
   *
   * @return bool                      true if successful
   */
  function DefaultPluginHandler ($name, $type, $template, &$callback, &$script, &$cacheable)
  {
    switch($type)
    {
      case \Smarty::PLUGIN_COMPILER:
      case \Smarty::PLUGIN_FUNCTION:
        $callback = array(__CLASS__, '_dflt_plugin');
        $cachable = FALSE;
      
        return TRUE;
  
      case \Smarty::PLUGIN_BLOCK:
        $callback = array(__CLASS__, '_dflt_block_plugin');
        $cachable = FALSE;
      
        return TRUE;
    
      case \Smarty::PLUGIN_MODIFIER:
        $callback = array(__CLASS__, '_dflt_mod');
        $cachable = FALSE;
      
        return TRUE;
    
      default:
        return FALSE;
    }
  }
  
  public function GetCustomSmartyObject() : \Smarty
  {
    return $this->_smarty;
  }
  
  public function RegisterTag($type, $name, $callable)
  {
    $this->_smarty->registerPlugin($type, $name, $callable);
    return $this;
  }
  
  public function RegisterTags($tags)
  {
    foreach($tags as $name => $def)
    {
      list($type, $callable) = $def;
      $this->RegisterTag($type, $name, $callable);
    }
    
    return $this;
  }
  
  public function Load($lines = '')
  {
    $this->_buffer = $lines;
    return $this;
  }
  
  public function Parse()
  {
    $this->_parse();
    return $this->_out;
  }
  
  public function SetLeftDel($delim)
  {
    $this->_left_del = $delim;
    return $this;
  }
  
  public function SetRightDel($delim)
  {
    $this->_right_del = $delim;
    return $this;
  }
}

?>