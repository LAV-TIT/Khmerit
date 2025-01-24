<?php
/**
 * LiseSmartyAssistant
 * may or may not be kept
 */

namespace LISE;

use cms_utils;
use Smarty_CMS;

class lsa
{
  /**
   * private props
   */
  
  private static ?lsa $_instance;
  private ?Smarty_CMS $_smarty;
  
  
  /**
   * public props
   */
  
  /**
   * private methods
   */
  private function __construct()
  {
    $this->_smarty = cms_utils::get_smarty();
  }
  
  /**
   * public methods
   */
  
  public static function getInstance() : ?lsa
  {
    if (self::$_instance === null){ self::$_instance = new lsa();}
    
    return self::$_instance;
  }
  
  /**
   * assigns a Smarty variable
   *
   * @param  array|string $tpl_var the template variable name(s)
   * @param  mixed        $value   the value to assign
   * @param  boolean      $nocache if true any output of this variable will be not cached
   *
   * @return \LISE\lsa
   */
  public function assign($tpl_var, $value = null, $nocache = false) : lsa
  {
    $this->_smarty->assign($tpl_var, $value, $nocache);
    return self::getInstance();
  }
}

?>