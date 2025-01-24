<?php
#-------------------------------------------------------------------------
# LISE - List It Special Edition
# Version 1.2
# A fork of ListI2
# maintained by Fernando Morgado AKA Jo Morg
# since 2015
#-------------------------------------------------------------------------
#
# Original Author: Ben Malen, <ben@conceptfactory.com.au>
# Co-Maintainer: Simon Radford, <simon@conceptfactory.com.au>
# Web: www.conceptfactory.com.au
#
#-------------------------------------------------------------------------
#
# Maintainer since 2011 up to 2014: Jonathan Schmid, <hi@jonathanschmid.de>
# Web: www.jonathanschmid.de
#
#-------------------------------------------------------------------------
#
# Some wackos started destroying stuff since 2012 and stopped at 2014:
#
# Tapio Löytty, <tapsa@orange-media.fi>
# Web: www.orange-media.fi
#
# Goran Ilic, <uniqu3e@gmail.com>
# Web: www.ich-mach-das.at
#
#-------------------------------------------------------------------------
#
# LISE is a CMS Made Simple module that enables the web developer to create
# multiple lists throughout a site. It can be duplicated and given friendly
# names for easier client maintenance.
#
#-------------------------------------------------------------------------
# BEGIN_LICENSE
#-------------------------------------------------------------------------
# This file is part of LISE
# LISE program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# LISE program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#-------------------------------------------------------------------------
# END_LICENSE
#-------------------------------------------------------------------------
class LISEInstance extends LISE
{
  
  private $_mode;
  
  
  #---------------------
  # Private methods
  #---------------------
  
  private function _get_mode()
  {
    if(is_null($this->_mode))
    {
      $query       = 'SELECT module_mode FROM ' . cms_db_prefix() . 'module_lise_instances WHERE module_name = ?';
      $this->_mode = (int)cms_utils::get_db()->GetOne($query, array($this->GetName()));
    }
    
    return $this->_mode;
  }
  
  private function _get_smarty()
  {
    $smarty = $this->GetActionTemplateObject();
    
    if( !is_object($smarty) )
    {
      $smarty = cmsms()->GetSmarty();
    }
  
    return $smarty;
  }
  
  private function _save_mode()
  {
    $query = 'UPDATE ' . cms_db_prefix() . 'module_lise_instances
    SET module_mode=?
    WHERE module_name = ?';
    cms_utils::get_db()->Execute($query, array($this->_mode, $this->GetName()));
  }
  
  #---------------------
  # Magic methods
  #---------------------
  
  public function __construct()
  {
    parent::__construct();
    # deal with registering routes for custom urls
    $db = cmsms()->GetDb();
    
    $query = 'SELECT item_id,url FROM '
             . cms_db_prefix()
             . 'module_'
             . $this->_GetModuleAlias()
             . '_item WHERE url != ?';
    
    $tmp = $db->GetArray($query, array(''));
    
    if(is_array($tmp))
    {
      $detailpage = $this->GetPreference('detailpage', -1);
      
      if($detailpage == -1)
      {
        $contentops = cmsms()->GetContentOperations();
        $detailpage = $contentops->GetDefaultContent();
      }
      
      foreach($tmp as $one)
      {
        $parms = array(
          'action'   => 'detail',
          'returnid' => $detailpage,
          'item'     => $one['item_id']
        );
        
        $route = new CmsRoute($one['url'], $this->GetName(), $parms, TRUE);
        cms_route_manager::register($route);
      }
    }
    
    $mode = $this->_get_mode();
    $smarty = \cms_utils::get_smarty();
    
    switch ($mode)
    {
      case LISE::MODE_LOCAL:
            $smarty->registerClass($this->GetName(), '\LISE\smarty_local');
            $obj = new \LISE\smarty_local_obj();
            $smarty->assignGlobal($this->GetName(), $obj);
          break;
      case LISE::MODE_GLOBAL:
            $smarty->registerClass($this->GetName(), '\LISE\smarty_global');
            $obj = new \LISE\smarty_global_obj();
            $smarty->assignGlobal($this->GetName(), $obj);
          break;
    }
    
  }
  
  #---------------------
  # Module api methods
  #---------------------    
  
  public function GetName()
  {
    return get_class($this);
  }
  
  public function GetFriendlyName()
  {
    return $this->GetPreference('friendlyname', $this->GetName() );
  }
  
  public function GetAdminDescription()
  {
    return $this->GetPreference('moddescription', $this->ModLang('moddescription'));
  }
  
  public function GetAdminSection()
  {
    return $this->GetPreference('adminsection');
  }
  
  public function GetAdminMenuItems()
  {
    // Get Mode
    $is_list   = $this->_mode == LISE::MODE_LIST;
    $is_local  = $this->_mode == LISE::MODE_LOCAL;
    $is_global = $this->_mode == LISE::MODE_GLOBAL;
    
    // get pref
    $separate_settings = $this->GetPreference('separate_settings', FALSE);
    
    $out = [];
    if($this->VisibleToAdminUser() && !$is_local)
    {
      $out[] = CmsAdminMenuItem::from_module($this);
    }
    
    if(($separate_settings && $is_list) || $is_local || $is_global)
    {
      if($this->CheckPermission('Modify Site Preferences'))
      {
        $obj              = new CmsAdminMenuItem();
        $obj->module      = $this->GetName();
        $obj->section     = 'siteadmin';
        $obj->title       = lang('settings') . ' - ' . $this->GetFriendlyName();
        $obj->description = lang('settings') . ' - ' . $this->GetFriendlyName();
        $obj->action      = 'admin_settings';
        $out[]            = $obj;
      }
    }
    
    return $out;
  }
  
  function AllowAutoInstall()
  {
    return $this->GetPreference('auto_install', FALSE);
  }
  
  public function AllowAutoUpgrade()
  {
    return ($this->GetPreference('auto_upgrade', FALSE));
  }
  
  public function GetDependencies()
  {
    return array('LISE' => '1.2.2');
  }
  
  public function VisibleToAdminUser()
  {
    return $this->CheckPermission($this->_GetModuleAlias() . '_modify_item');
  }
  
  public function IsPluginModule()
  {
    return TRUE;
  }
  
  public function LazyLoadFrontend()
  {
    return FALSE;
  }
  
  public function SubPackage()
  {
    return FALSE;
  }
  
  
  public function GetHelp()
  {
    $smarty = cmsms()->GetSmarty();
    //$config = cmsms()->GetConfig();
    $config     = \LISE\ConfigManager::GetConfigInstance(cmsms()->GetModuleInstance('LISE'));
    $page_limit = isset($config['global_LISEQuery_page_limit']) ? $config['global_LISEQuery_page_limit'] : 100000;
    $config     = \LISE\ConfigManager::GetConfigInstance($this);
    $page_limit = isset($config['LISEQuery_page_limit']) ? $config['LISEQuery_page_limit'] : $page_limit;
    
    $smarty->assign('parent_name', parent::GetName());
    $smarty->assign('root_url', $config['root_url']);
    $smarty->assign('mod', $this);
    $smarty->assign('page_limit', $page_limit);
    $smarty->assign('usage_text', str_replace('{$module_name}', $this->GetName(), $this->ModLang('help_usage')));
    $smarty->assign(
      'permissions_text', str_replace('{$module_name}', $this->GetName(), $this->ModLang('help_permissions'))
    );
    $smarty->assign(
      'categories_text', str_replace('{$module_name}', $this->GetName(), $this->ModLang('help_categories'))
    );
    $smarty->assign(
      'templates_text', str_replace('{$module_name}', $this->GetName(), $this->ModLang('help_templates'))
    );
    $smarty->assign(
      'duplicating_text', str_replace('{$module_name}', $this->GetName(), $this->ModLang('help_duplicating'))
    );
    
    return $this->ModProcessTemplate('help.tpl');
  }
  
  public function InitializeFrontend()
  {
    $mode = $this->_get_mode();
    
    if($mode == LISE::MODE_LIST)
    {
      $this->RegisterModulePlugin();
      $this->RestrictUnknownParams();
  
      // Set allowed parameters
      $this->SetParameterType('action', CLEAN_STRING);
      $this->SetParameterType('showall', CLEAN_INT);
      $this->SetParameterType('category', CLEAN_STRING);
      $this->SetParameterType('exclude_category', CLEAN_STRING);
      $this->SetParameterType('subcategory', CLEAN_INT);
      $this->SetParameterType('orderby', CLEAN_STRING);
      $this->SetParameterType('detailtemplate', CLEAN_STRING);
      $this->SetParameterType('summarytemplate', CLEAN_STRING);
      $this->SetParameterType('searchtemplate', CLEAN_STRING);
      $this->SetParameterType('categorytemplate', CLEAN_STRING);
      $this->SetParameterType('archivetemplate', CLEAN_STRING);
      $this->SetParameterType(CLEAN_REGEXP . '/template_.*/', CLEAN_STRING);
      $this->SetParameterType('detailpage', CLEAN_STRING);
      $this->SetParameterType('summarypage', CLEAN_STRING);
      $this->SetParameterType('item', CLEAN_STRING);
      $this->SetParameterType('id_hierarchy', CLEAN_STRING);
      $this->SetParameterType('pagelimit', CLEAN_INT);
      $this->SetParameterType('start', CLEAN_INT);
      $this->SetParameterType('pagenumber', CLEAN_INT);
      $this->SetParameterType('search', CLEAN_STRING);
      $this->SetParameterType(CLEAN_REGEXP . '/search_.*/', CLEAN_STRING);
      $this->SetParameterType('filter', CLEAN_STRING);
      $this->SetParameterType(CLEAN_REGEXP . '/filter_.*/', CLEAN_STRING);
      $this->SetParameterType('filterorderby', CLEAN_STRING); # @since 1.3
      $this->SetParameterType('debug', CLEAN_INT);
      $this->SetParameterType('collapse', CLEAN_INT);
      $this->SetParameterType('show_items', CLEAN_INT);
      $this->SetParameterType('number_of_levels', CLEAN_INT);
      $this->SetParameterType('include_items', CLEAN_STRING);
      $this->SetParameterType('exclude_items', CLEAN_STRING);
      $this->SetParameterType('tag', CLEAN_STRING);
  
      // Get summarypage
      $summarypage = $this->GetPreference('summarypage', NULL);
      if(is_null($summarypage))
      {
    
        if(!isset($contentops))
        {
          $contentops = cmsms()->GetContentOperations();
        }
    
        $summarypage = $contentops->GetDefaultPageID();
      }
  
      // Get detailpage
      $detailpage = $this->GetPreference('detailpage', NULL);
      if(is_null($detailpage))
      {
    
        if(!isset($contentops))
        {
          $contentops = cmsms()->GetContentOperations();
        }
    
        $detailpage = $contentops->GetDefaultPageID();
      }
  
      // Get subcategory
      $subcategory = $this->GetPreference('subcategory');
  
      // fix prefixes
  
      $prefix = str_replace('/', '\/', $this->prefix);
  
      // Archive
      $this->RegisterRoute(
        '/'
        . $prefix
        . '\/archive\/(?P<filter_year>[0-9]+?)\/(?P<filter_month>[0-9]+?)\/(?P<returnid>[0-9]+)$/',
        array('action' => 'default')
      );
  
      $this->RegisterRoute(
        '/'
        . $prefix
        . '\/archive\/(?P<filter_year>[0-9]+?)\/(?P<returnid>[0-9]+)$/',
        array('action' => 'default')
      );
  
      // Pagination
      $this->RegisterRoute(
        '/'
        . $prefix
        . '\/(?P<category>.+?)\/page\/(?P<pagenumber>[0-9]+?)\/(?P<pagelimit>[0-9]+)\/(?P<returnid>[0-9]+)$/',
        array('action' => 'default')
      );
  
      $this->RegisterRoute(
        '/'
        . $prefix
        . '\/page\/(?P<pagenumber>[0-9]+?)\/(?P<pagelimit>[0-9]+)\/(?P<returnid>[0-9]+)$/',
        array('action' => 'default')
      );
  
      $this->RegisterRoute(
        '/'
        . $prefix
        . '\/page\/(?P<pagenumber>[0-9]+?)\/(?P<returnid>[0-9]+)$/',
        array('action' => 'default')
      );
  
      // Hierarchy view
      $this->RegisterRoute(
        '/'
        . $prefix
        . '\/(?P<category>.+?)\/(?P<id_hierarchy>[0-9.]+)\/(?P<item>.+?)\/(?P<returnid>[0-9]+)$/',
        array('action' => 'detail')
      );
  
      $this->RegisterRoute(
        '/'
        . $prefix
        . '\/(?P<category>.+?)\/(?P<id_hierarchy>[0-9.]+)\/(?P<returnid>[0-9]+)$/',
        array('action' => 'default', 'subcategory' => $subcategory)
      );
  
      // Singular
      $this->RegisterRoute(
        '/'
        . $prefix
        . '\/(?P<item>.+?)\/(?P<returnid>[0-9]+)\/(?P<detailtemplate>.+?)$/',
        array('action' => 'detail')
      );
  
  
      $this->RegisterRoute(
        '/'
        . $prefix
        . '\/(?P<item>.+?)\/(?P<returnid>[0-9]+)$/',
        array('action' => 'detail')
      );
    }
  }
  
//  public function InitializeAdmin()
//  {
//
//  }
  
  public function GetHeaderHTML()
  {
    // SSL check (Hopefully core would do this soon...)
    $use_ssl = FALSE;
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
    {
      $use_ssl = TRUE;
    }
    
    $config      = cmsms()->GetConfig();
    $smarty      = cmsms()->GetSmarty();
    $modulename  = $this->GetName();
    $moduledir   = $this->GetParentURLPath($use_ssl);
    $globals_js  = ($use_ssl ? $config['ssl_url'] : $config['root_url']) . '/modules/' . LISE . '/lib/js/';
    $globals_css = ($use_ssl ? $config['ssl_url'] : $config['root_url']) . '/modules/' . LISE . '/lib/css/';
    $admindir    = $config['admin_url'];
    $userkey     = get_secure_param();
    $jqueryui    = '';
    
    if(version_compare(CMS_VERSION, '1.11-alpha0') < 0)
    {
      $jqueryui = '<link type="text/css" rel="stylesheet" href="' . $moduledir .
                  '/css/jquery-ui-1.8.2.custom.css"></link>';
    }
    
    $smarty->assign('moduledir', $moduledir);
    $smarty->assign('globals_css', $globals_css);
    $smarty->assign('globals_js', $globals_js);
    $smarty->assign('jqueryui', $jqueryui);
    $smarty->assign('admindir', $admindir);
    $smarty->assign('userkey', $userkey);
    $smarty->assign('modulename', $modulename);
    
    $tmpl = $this->ModProcessTemplate('HTML_Header.tpl');
    
    $tmpl .= LISEFielddefOperations::GetHeaderHTML();
    
    return $tmpl;
  }
  
  public function DoAction($name, $id, $params, $returnid = '')
  {
    $cms_states     = CmsApp::get_instance()->get_states();
    $CMS_ADMIN_PAGE = in_array(CmsApp::STATE_ADMIN_PAGE, $cms_states);
    $exceptions     = ['ajax_geturl', 'ajax_get_alias'];
    $smarty         = $this->_get_smarty();
    $db             = cmsms()->GetDb(); # needed for includes
    
    $smarty->assign('mod', $this);
    $smarty->assign('actionid', $id);
    $smarty->assign('returnid', $returnid);
    
    cms_utils::set_app_data('lise_instance', $this->GetName());
    
    if( cmsms()->is_frontend_request() )
    {
      if( isset($params['id_hierarchy']) )
      {
        cms_utils::set_app_data('lise_id_hierarchy', $params['id_hierarchy']);
        $category = $this->LoadCategoryByIdentifier('id_hierarchy', $params['id_hierarchy']);
        $smarty->assign('category', $category);
        $smarty->assign($this->GetName() . '_category', $category); // <- Alias for $category        
      }
    }
    
    if($CMS_ADMIN_PAGE)
    {
      $themeObject = cms_utils::get_theme_object();
      $smarty->assign('themeObject', $themeObject);
    }
    
    if($name != '')
    {
      $got_contents = FALSE;
      $contents     = '';
      $name         = preg_replace('/[^A-Za-z0-9\-_+]/', '', $name);
      
      // Check if we have an action file
      $filename = cms_join_path(
        $this->GetModulePath(),
        'action.' . $name . '.php'
      );
      
      if(@is_file($filename) && !$got_contents)
      {
        ob_start();
        include($filename);
        $contents .= ob_get_contents();
        ob_end_clean();
        $got_contents = TRUE;
      }
      
      // Check parent if we don't
      
      $filename = cms_join_path(
        $this->GetParentPath(),
        'action.' . $name . '.php'
      );
      
      if(@is_file($filename) && !$got_contents)
      {
        ob_start();
        include($filename);
        $contents .= ob_get_contents();
        ob_end_clean();
        $got_contents = TRUE;
      }
      
      if( $got_contents && $CMS_ADMIN_PAGE && !in_array($name, $exceptions) )
      {
        $contents = '<div class="lise-admin-wrapper">' . $contents .  '</div>';
      } // TODO we need to revisit this too (JM)
      
      echo $contents;
    }
  }
  
  function SearchReindex($module)
  {
    LISEItemOperations::reindex_search($module, $this);
  }
  
  
  function Upgrade($oldversion, $newversion)
  {
    # needed for the include
    $config = cmsms()->GetConfig();
    $smarty = cmsms()->GetSmarty();
    $db     = cmsms()->GetDb();
    
    $response = FALSE;
    
    $filename = cms_join_path(
      $this->GetParentPath(),
      'method.upgradeGlobals.php'
    );
    
    if(@is_file($filename))
    {
      
      $res = include($filename);
      
      if(lise_utils::isCMS2())
      {
        if($res == 1 || $res == '')
        {
          $response = FALSE;
        }
        else
        {
          $response = $res;
        }
      }
      else
      {
        if($res == 1 || $res == '')
        {
          $response = TRUE;
        }
      }
    }
    
    $filename = cms_join_path(
      $this->GetModulePath(),
      'method.upgrade.php'
    );
    
    if(@is_file($filename))
    {
      $res = include($filename);
      
      if(lise_utils::isCMS2())
      {
        if($res == 1 || $res == '')
        {
          $response = FALSE;
        }
        else
        {
          $response = $res;
        }
      }
      else
      {
        if($res == 1 || $res == '')
        {
          $response = TRUE;
        }
      }
    }
    
    // Check if module in our own control tables yet
    $query     = 'SELECT module_id FROM ' . cms_db_prefix() . 'module_lise_instances WHERE module_name = ?';
    $modstatus = $db->GetOne($query, array($this->GetName()));
    
    if(!$modstatus)
    {
      $this->RegisterModule();
    }
    
    return $response;
  }
  
  function Install()
  {
    # needed for the include
    $config = cmsms()->GetConfig();
    $smarty = cmsms()->GetSmarty();
    $db     = cmsms()->GetDb();
    
    $response = FALSE;
    
    $filename = cms_join_path(
      $this->GetParentPath(),
      'method.installGlobals.php'
    );
    
    if(@is_file($filename))
    {
      $res = include($filename);
      
      if($res == 1 || $res == '')
      {
        $response = FALSE;
      }
      else
      {
        $response = $res;
      }
    }
    
    $filename = cms_join_path(
      $this->GetModulePath(),
      'method.install.php'
    );
    
    if(@is_file($filename))
    {
      $res = include($filename);
      
      if($res == 1 || $res == '')
      {
        $response = FALSE;
      }
      else
      {
        $response = $res;
      }
    }
    
    if(!$response)
    {
      $this->RegisterModule();
    }
    
    return $response;
  }
  
  function Uninstall()
  {
    $config = cmsms()->GetConfig();
    $smarty = cmsms()->GetSmarty();
    $db     = cmsms()->GetDb();
    
    $response = FALSE;
    
    $filename = cms_join_path(
      $this->GetParentPath(),
      'method.uninstallGlobals.php'
    );
    
    if(@is_file($filename))
    {
      $res = include($filename);
      
      if($res == 1 || $res == '')
      {
        $response = FALSE;
      }
      else
      {
        $response = $res;
      }
    }
    
    $filename = cms_join_path(
      $this->GetModulePath(),
      'method.uninstall.php'
    );
    
    if(@is_file($filename))
    {
      $res = include($filename);
      
      if($res == 1 || $res == '')
      {
        $response = FALSE;
      }
      else
      {
        $response = $res;
      }
    }
    
    if(!$response)
    {
      
      $this->UnregisterModule();
    }
    
    return $response;
  }
  
  #---------------------
  # Manipulation methods
  #---------------------   
  
  public function ModLang()
  {
    $mod = cmsms()->GetModuleInstance(LISE);
    if(!is_object($mod))
    {
      return '';
    }
    #throw new \LISE\Exception('Cannot retrive LISE Object.');
    #throw new LISEException('Cannot retrive LISE Object.');
    
    $mod->LoadLangMethods();
    
    $args = func_get_args();
    array_unshift($args, '');
    
    if(lise_utils::isCMS2())
    {
      $args[0] = $mod->GetName();
      
      return CmsLangOperations::lang_from_realm($args);
    }
    else
    {
      $args[0] = &$mod;
      
      return call_user_func_array('cms_module_Lang', $args);
    }
  }
  
  public function GetParentPath()
  {
    $config = cmsms()->GetConfig();
    
    return cms_join_path($config['root_path'], 'modules', LISE, 'framework');
  }
  
  public function GetParentURLPath($use_ssl = FALSE)
  {
    $config = cmsms()->GetConfig();
    
    return ($use_ssl ? $config['ssl_url'] : $config['root_url']) . '/modules/' . LISE . '/framework';
  }
  
  #---------------------
  # Instance methods
  #---------------------
  
  public function GetMode()
  {
    return $this->_get_mode();
  }
  
  public function SetMode($mode = LISE::MODE_LIST)
  {
    $this->_mode = $mode;
    $this->_save_mode();
  }
  
  private function RegisterModule()
  {
    $db   = cmsms()->GetDb();
    $mode = is_null($this->_mode) ? 1 : $this->_mode;
    
    $query  = 'INSERT INTO ' . cms_db_prefix() . 'module_lise_instances (module_name, module_mode) VALUES (?,?)';
    $result = $db->Execute($query, array($this->GetName(), $mode));
    
    if(!$result)
    {
      throw new \LISE\Exception(
        $db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB
      );
    }
    
    return TRUE;
  }
  
  private function UnregisterModule()
  {
    $db = cmsms()->GetDb();
    
    $query  = 'DELETE FROM ' . cms_db_prefix() . 'module_lise_instances WHERE module_name = ?';
    $result = $db->Execute($query, array($this->GetName()));
    
    if(!$result)
    {
      throw new \LISE\Exception(
        $db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB
      );
    }
    
    return TRUE;
  }
  
  /**
   * Backend Items list for AJAX search
   *
   * @param array $params
   *
   * @return mixed|string
   * @throws \LISE\Exception
   */
  final function beItemsList($params = array())
  {
    $params     = lise_utils::recover_params($params);
    $id         = $params['id'] ?? -1;
    $returnid   = $params['returnid'] ?? '';
    $admintheme = cms_utils::get_theme_object();
    $smarty     = $this->GetActionTemplateObject();
    $singular   = $this->GetPreference('item_singular', '');
    $plural     = $this->GetPreference('item_plural', '');
    $fields     = explode(',', $this->GetPreference('item_cols', ''));
    $limit      = $this->GetPreference('items_per_page', 20);
    $dateformat = trim(get_preference(get_userid(), 'date_format_string', '%Y-%m-%d'));
    
    if( empty($dateformat) ) { $dateformat = '%Y-%m-%d'; }
    
    #---------------------
    # Init items
    #---------------------
    $params['pagelimit'] = $limit;
    $params['showall']   = TRUE;  // <- To disable time control queries
    
    $item_query = new LISEItemQuery($this, $params);
    
    if(!$this->CheckPermission($this->_GetModuleAlias() . '_modify_all_item'))
    {
      $item_query->AppendTo(LISEQuery::VARTYPE_WHERE, 'A.owner = ?');
      $item_query->AppendTo(LISEQuery::VARTYPE_QPARAMS, get_userid(FALSE));
    }
    
    $result = $item_query->Execute(TRUE);
    
    //$page = $item_query->GetPageNumber();
    $totalcount = $item_query->TotalCount();
    
    $items = [];
    while($result && $row = $result->FetchRow())
    {
      $obj = $this->InitiateItem($fields);
      
      LISEItemOperations::Load($this, $obj, $row);
      
      // Check if we need to show any fields
      if(count($fields) > 0)
      {
        // Check static
        if(!in_array('alias', $fields))
        {
          unset($obj->alias);
        }
        
        if(!in_array('create_time', $fields))
        {
          unset($obj->create_time);
        }
        else
        {
          $obj->create_time = lise_utils::strftime($dateformat, strtotime($obj->create_time));
        }
        
        if(!in_array('modified_time', $fields))
        {
          unset($obj->modified_time);
        }
        else
        {
          $obj->modified_time = lise_utils::strftime($dateformat, strtotime($obj->modified_time));
        }
        
        if(in_array('start_time', $fields))
        {
          $obj->start_time = !empty($obj->start_time) ? lise_utils::strftime($dateformat, strtotime($obj->start_time)) : '';
        }
        
        if(in_array('end_time', $fields))
        {
          $obj->end_time = !empty($obj->end_time) ? lise_utils::strftime($dateformat, strtotime($obj->end_time)) : '';
        }
      }
      
      // approve
      if($this->CheckPermission($this->_GetModuleAlias() . '_approve_item'))
      {
        if($obj->active)
        {
          $obj->approve = $this->CreateLink(
            $id, 'admin_approveitem', $returnid,
            $admintheme->DisplayImage('icons/system/true.gif', $this->ModLang('revert'), '', '', 'systemicon'), array(
              'approve' => 0,
              'item_id' => $row['item_id']
            )
          );
        }
        else
        {
          $obj->approve = $this->CreateLink(
            $id, 'admin_approveitem', $returnid,
            $admintheme->DisplayImage('icons/system/false.gif', $this->ModLang('approve'), '', '', 'systemicon'), array(
              'approve' => 1,
              'item_id' => $row['item_id']
            )
          );
        }
      }
      
      $linkparams            = array();
      $linkparams['item_id'] = $row['item_id'];
      
      lise_utils::clean_params($params, array('page'), TRUE);
      $linkparams = array_merge($linkparams, $params);
      
      // edit
      $obj->editlink = $this->CreateLink(
        $id, 'admin_edititem', $returnid, $admintheme->DisplayImage(
        'icons/system/edit.gif', $this->ModLang('edit'), '', '', 'systemicon'
      ), $linkparams
      );
      $obj->title    = $this->CreateLink($id, 'admin_edititem', $returnid, $obj->title, $linkparams);
      
      $linkparams['mode'] = 'copy';
      
      // copy
      $obj->copylink = $this->CreateLink(
        $id, 'admin_edititem', $returnid, $admintheme->DisplayImage(
        'icons/system/copy.gif', $this->ModLang('copy'), '', '', 'systemicon'
      ), $linkparams
      );
      
      // delete
      if($this->CheckPermission($this->_GetModuleAlias() . '_remove_item'))
      {
        $obj->delete = $this->CreateLink(
          $id, 'admin_deleteitem', $returnid,
          $admintheme->DisplayImage('icons/system/delete.gif', $this->ModLang('delete'), '', '', 'systemicon'), array(
            'item_id' => $row['item_id']
          )
        );
      }
      
      // select box
      $obj->select = $this->CreateInputCheckbox($id, 'items[]', $row['item_id']);
      
      $items[] = $obj;
    }
    
    #---------------------
    # Smarty processing
    #---------------------
    
    $pagenumber = $item_query->GetPageNumber();
    $pagecount  = $item_query->GetPageCount();
    $smarty->assign('totalcount', $totalcount);
    
    ## new for quick search form
    $smarty->assign('previous_page_number', $pagenumber - 1);
    $smarty->assign('next_page_number', $pagenumber + 1);
    $smarty->assign('first_page_number', 1);
    $smarty->assign('last_page_number', $pagecount);
    
    // some pagination variables to smarty.
    if($pagenumber == 1)
    {
      $smarty->assign('prevpage', '<');
      $smarty->assign('firstpage', '<<');
    }
    else
    {
      $smarty->assign(
        'prevpage',
        $this->CreateLink(
          $id, 'defaultadmin',
          $returnid, '<',
          array(
            'pagenumber' => $pagenumber - 1,
            'active_tab' => 'itemtab'
          )
        )
      );
      $smarty->assign(
        'firstpage',
        $this->CreateLink(
          $id, 'defaultadmin',
          $returnid, '<<',
          array(
            'pagenumber' => 1,
            'active_tab' => 'itemtab'
          )
        )
      );
    }
    if($pagenumber >= $pagecount)
    {
      $smarty->assign('nextpage', '>');
      $smarty->assign('lastpage', '>>');
    }
    else
    {
      $smarty->assign(
        'nextpage',
        $this->CreateLink(
          $id, 'defaultadmin',
          $returnid, '>',
          array(
            'pagenumber' => $pagenumber + 1,
            'active_tab' => 'itemtab'
          )
        )
      );
      $smarty->assign(
        'lastpage',
        $this->CreateLink(
          $id, 'defaultadmin',
          $returnid, '>>',
          array(
            'pagenumber' => $pagecount,
            'active_tab' => 'itemtab'
          )
        )
      );
    }
    
    $ajax_url = $this->create_url($id, 'ajax', $returnid);
    $smarty->assign('ajax_url', $ajax_url);
    
    $smarty->assign('pagenumber', $pagenumber);
    $smarty->assign('pagecount', $pagecount);
    $smarty->assign('oftext', $this->ModLang('prompt_of'));
    
    $smarty->assign('items', $items);
    $smarty->assign('title', $this->GetPreference('item_singular', ''));
    $smarty->assign('title_plural', $this->GetPreference('item_plural', ''));
    
    $smarty->assign('submitorder', $this->CreateInputSubmit($id, 'submit_itemorder', $this->ModLang('submit_order')));
    $smarty->assign(
      'addlink', $this->CreateLink(
      $id, 'admin_edititem', $returnid,
      $admintheme->DisplayImage('icons/system/newobject.gif', $this->ModLang('add', $singular), '', '', 'systemicon') .
      $this->ModLang('add', $singular)
    )
    );
    
    if($this->CheckPermission($this->_GetModuleAlias() . '_modify_all_item'))
    {
      $smarty->assign(
        'exportlink', $this->CreateLink(
        $id, 'admin_exportitems', $returnid, $admintheme->DisplayImage(
             'icons/system/export.gif', $this->ModLang('export', $singular), '', '', 'systemicon'
           ) .
                                             $this->ModLang('export', $plural)
      )
      );
      $smarty->assign(
        'importlink', $this->CreateLink(
        $id, 'admin_importitems', $returnid, $admintheme->DisplayImage(
             'icons/system/import.gif', $this->ModLang('import', $singular), '', '', 'systemicon'
           ) .
                                             $this->ModLang('import', $plural)
      )
      );
    }
    
    return $this->ModProcessTemplate('ajax_quick_search.tpl');
  }
  
  function test()
  {
    exit;
    return 'here!';
  }
  
} // end of class

?>
