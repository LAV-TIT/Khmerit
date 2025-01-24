<?php
class lisefd_HelpPopup extends LISEFielddefBase
{
  private $_opts = array();
  
	public function __construct($db_info, $caller_object)
	{	
		parent::__construct($db_info, $caller_object);
    		
		$this->SetFriendlyType($this->ModLang('fielddef_HelpPopup'));
	}
  
  public function GetOptions()
  {
    $this->_opts['title'] = $this->GetOptionValue('title', '');
    $this->_opts['msg'] = $this->GetOptionValue('msg', '');
    
    return $this->_opts;
  }
  
  public function GetIcon()
  {
    $theme = cms_utils::get_theme_object();
    if( !is_object($theme) ) return;
    $config = \cms_config::get_instance();
    $icon_url = $config['admin_url']
                . '/themes/'
                . $theme->themeName
                . '/images//icons/system/info.gif';
    return $icon_url;
  }
  
}