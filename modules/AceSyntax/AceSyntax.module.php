<?php
#---------------------------------------------------------------------------
# Module: AceSyntax
# Authors: Fernando Morgado (Jo Morg), Rolf Tjassens (cmscanbesimple.org)
#---------------------------------------------------------------------------
# CMS Made Simple - Power for the professional, Simplicity for the end user.
# (c) 2004 - 2011 by Ted Kulp (wishy@cmsmadesimple.org)
# (c) 2011 - 2018 by The CMS Made Simple Development Team
# (c) 2018 - 2019 by The CMS Made Simple Foundation
# This project's homepage is: https://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/acesyntax
#---------------------------------------------------------------------------
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#---------------------------------------------------------------------------

use AceSyntax\SmartyPlugins;

class AceSyntax extends CMSModule
{

	#---------------------
	# Attributes
	#---------------------	

//	protected $noeditors       = 0;
//	public $headerinfosent     = false;
//	private $_htmlactive       = false;
//	private $_plainactive      = false;
//	private $_javascriptactive = false;
//	private $_cssactive        = false;
//	private $_phpactive        = false;
//	private $_xmlactive        = false;
//	private $_jsonactive       = false;
//	private $_defaultactive    = false;
  
  
  
  #---------------------
  # Internal autoloader
  #---------------------
  
  public final function _autoloader($classname)
  {
    $parts = explode('\\', $classname);
    $classname = end($parts);
    
    $fn = cms_join_path(
      $this->GetModulePath(),
      'lib',
      'class.' . $classname . '.php'
    );
    
    if(file_exists($fn))
    {
      require_once($fn);
    }
  }
  
  public function __construct()
  {
    spl_autoload_register(array($this, '_autoloader'));
    parent::__construct();
  }
  
	#---------------------
	# Module api methods
	#---------------------

	public function GetName() { return 'AceSyntax'; }
	public function GetFriendlyName() { return $this->Lang('friendlyname'); }
	public function GetVersion() { return '1.0.1'; }
	public function GetAuthor() { return 'Jo Morg, Rolf Tjassens'; }
	public function GetAuthorEmail() { return 'jomorg [at] sm-art-lab [dot] com, info [at] cmscanbesimple [dot] org'; }
	public function GetChangeLog() { return $this->ProcessTemplate('changelog.tpl'); }
	public function IsPluginModule() { return true; }
	public function HasAdmin() { return true; }
	public function GetAdminSection() { return 'myprefs'; }
	public function GetAdminDescription() { return $this->Lang('admindescription'); }
	public function VisibleToAdminUser() { return $this->CheckPermission('Modify Site Preferences') || $this->CheckPermission('AceEditor User Preference') || $this->CheckPermission('Modify Templates'); }
	public function MinimumCMSVersion() { return '2.1'; }
	public function InstallPostMessage() { return $this->Lang('postinstall'); }
	public function UninstallPostMessage() { return $this->Lang('postuninstall'); }
	public function UninstallPreMessage() { return $this->Lang('really_uninstall'); }
	public function LazyLoadFrontend() { return false; }
	public function LazyLoadAdmin() { return true; }
	public function IsWYSIWYG() { return true; }
	public function IsSyntaxHighlighter() { return true; }
	public function SyntaxPageFormSubmit() { return; }

	function GetAdminMenuItems()
	{
		if ( $this->VisibleToAdminUser() )
		{
			$out = null;
			$out[] = CmsAdminMenuItem::from_module($this);

			$obj = new CmsAdminMenuItem();
			$obj->module = $this->GetName();
			$obj->section = 'siteadmin';
			$obj->title = $this->Lang('title_acesyntax_settings');
			$obj->description = $this->Lang('desc_acesyntax_settings');
			$obj->action = 'admin_settings';
			$out[] = $obj;
			
			return $out;
		}
	}

	public function HasCapability($capability, $params = array())
	{
		# Just add more to the array when expanded
		$capabilities = [
			CmsCoreCapabilities::SYNTAX_MODULE,
			CmsCoreCapabilities::WYSIWYG_MODULE
		];
    
		# single line handles it here :)
		return in_array($capability, $capabilities);
	}
	
	public function GetHelp()
	{
		$smarty = cmsms()->GetSmarty();
		$smarty->assign('module_path', $this->GetModuleURLPath());
		$smarty->assign('modes_list', $this->AceGetModes());
		$smarty->assign('themes_list', $this->AceGetThemes());

		return $this->ProcessTemplate('help.tpl');
	}
	
	public function InitializeFrontend()
	{
		$this->RestrictUnknownParams();
		$this->SetParameterType('height',           CLEAN_STRING);
		$this->SetParameterType('htmlentities',     CLEAN_INT);
		$this->SetParameterType('mode',             CLEAN_STRING); 
		$this->SetParameterType('theme',            CLEAN_STRING);
		$this->SetParameterType('width',            CLEAN_STRING);
		SmartyPlugins::register();
		$smarty = cmsms()->GetSmarty();
		$smarty->registerClass('acesyn', '\AceSyntax\SmartyTools');
	}

	public function InitializeAdmin()
	{
		$this->CreateParameter('height', '400', $this->Lang('help_param_height'));
		$this->CreateParameter('htmlentities', 0, $this->Lang('help_param_htmlentities'));
		$this->CreateParameter('mode', 'html', $this->Lang('help_param_mode'));
		$this->CreateParameter('theme', 'textmate', $this->Lang('help_param_theme'));
		$this->CreateParameter('width', '400', $this->Lang('help_param_width'));
	}

	public function SyntaxGenerateHeader($htmlresult = '')
	{
    	$smarty = cmsms()->GetSmarty();
    	$smarty->assign('mod', $this);
    	$top = $this->ProcessTemplate('ace_top.tpl');
    	$bottom = $this->ProcessTemplate('ace_bottom.tpl');
    	//$smarty->assign('editorid', 'ace_editor');
    	$smarty->assign('top', $top);
    	$smarty->assign('bottom', $bottom);
    
		# deprecated... but we'll keep it for cmsms 2.2.x branch (JM)
		$ajax_link = $this->create_url('cntnt01', 'admin_ajax');
		$smarty->assign('ajax_link', $ajax_link);
  
		return $this->ProcessTemplate('AdminSyntaxGenerateHeader.tpl');
	}

	public function WYSIWYGGenerateHeader($selector = NULL, $cssname = NULL)
  	{
    	$smarty = cmsms()->GetSmarty();
    	$smarty->assign('mod', $this);
	    $top = $this->ProcessTemplate('ace_top.tpl');
	    $bottom = $this->ProcessTemplate('ace_bottom.tpl');
	    $smarty->assign('editorid', 'ace_editor');
	    $smarty->assign('top', $top);
	    $smarty->assign('bottom', $bottom);
	  
	    # deprecated... but we'll keep it for cmsms 2.2.x branch (JM)
	    $ajax_link = $this->create_url('cntnt01', 'admin_ajax');
	    $smarty->assign('ajax_link', $ajax_link);
	  
	    return $this->ProcessTemplate('AdminSyntaxGenerateHeader.tpl');
	}

	#---------------------
	# Module methods
	#--------------------- 
  
	/**
   	 * Gets a preference for the current backend user
	 *
     * @param        $name    - name of the preference
     * @param string $default - default value for the preference
     *
     * @return string         - the value of the preference if it exists otherwise the $default
     */
	final public function AceGetPreference($name, $default = '')
	{
		$userid = get_userid();
		$result = cms_userprefs::get_for_user($userid, $this->GetName() . '_' . $name);
		
		if ($result === '') return $default;
				
		return $result;
	}
  
  	/**
     * Sets a preference for the current backend user
     *
     * @param $name     - default value for the preference
     * @param $value    - the value of the preference
     */
	final protected function AceSetPreference($name, $value)
	{
		$userid = get_userid();
		cms_userprefs::set_for_user($userid, $this->GetName() . '_' . $name, $value);	
	}
  
	/**
     * List installed Ace Modes
     * @return array
     */
	final public function AceGetModes()
	{
		$modes = array();

		foreach ( glob(cms_join_path($this->GetModulePath(), 'lib', 'ace', 'modes', '*.js') ) as $filename ) {

			$mode = basename($filename);
			$mode = explode('.', $mode);
			$mode = explode('-', $mode[0]);
		
			$modes[$mode[1]] = $this->Lang($mode[1]);
		}
		
		return $modes;
	}
  
	/**
     * List installed Ace Themes
     * @return array
     */
	final public function AceGetThemes()
	{
		$themes = array();
		foreach(glob(cms_join_path($this->GetModulePath(), 'lib', 'ace', 'themes', '*.js') ) as $filename)
		{
			$theme = basename($filename);
			$theme = explode('.', $theme);
			$theme = explode('-', $theme[0]);
			$themes[$theme[1]] = $this->Lang($theme[1]);
		}
		
		return $themes;
	}

} // end of class

#
# EOF
#