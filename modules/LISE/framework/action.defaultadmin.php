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
if( !defined('CMS_VERSION') ) exit;

if (!$this->CheckPermission($this->_GetModuleAlias() . '_modify_item')) return;

// Get Mode
$is_list   = (bool)( ( (int)$this->_mode ) == LISE::MODE_LIST );
$is_local  = (bool)( ( (int)$this->_mode ) == LISE::MODE_LOCAL );
$is_global = (bool)( ( (int)$this->_mode ) == LISE::MODE_GLOBAL );

$modes = [
  0 => $this->ModLang('mode_list'),
  1 => $this->ModLang('mode_local'),
  2 => $this->ModLang('mode_global')
];

// Get prefs
$separate_settings = $this->GetPreference('separate_settings', FALSE);
$local_mode_instance = $this->GetPreference('local_mode_instance', '');
$show_categories   = LISEFielddefOperations::TestExistenceByType($this, 'Categories') && $is_list;
$show_local = FALSE;

if( !empty($local_mode_instance) )
{
  $lmi_mod = \cms_utils::get_module($local_mode_instance);
  $show_local = is_object($lmi_mod);
}

if( isset($params['message']) ) 
{
	echo $this->ShowMessage($this->ModLang($params['message']));
}

if( isset($params['errors']) && count($params['errors']) ) 
{
	echo $this->ShowErrors($params['errors']);
}

if($is_global)
{
  include dirname(__FILE__) . '/function.admin_global.php';
}
else
{
  if( !empty($params['active_tab']) )
  {
    $tab = $params['active_tab'];
  }
  else
  {
    if($is_list)
    {
      $tab = 'itemtab';
    }
    else
    {
      $tab = 'fielddeftab';
    }
  }
  
  # something odd with preferences in 2.0 ??? this is a workaround
  $pref = $this->GetPreference('item_plural', '');
  $item_plural_string = empty($pref) ? $this->ModLang('items') : $pref;
  $current_action = 'defaultadmin';
  
  echo $this->StartTabHeaders();
  
  if($is_list)
  {
    echo $this->SetTabHeader('itemtab', $item_plural_string, ($tab == 'itemtab'));
  }
  
  if($is_global)
  {
    echo $this->SetTabHeader('globaltab', $this->ModLang('global'), ($tab == 'globaltab'));
  }
  
  if($show_local)
  {
    echo $this->SetTabHeader('localtab', $this->ModLang('local_settings'), ($tab == 'localtab'));
  }
  
  if ($this->CheckPermission($this->_GetModuleAlias() . '_modify_category') && $show_categories)
  {
    echo $this->SetTabHeader('categorytab', $this->ModLang('categories'), ($tab == 'categorytab'));
  }
  
  if(!$separate_settings)
  {
    if($this->CheckPermission($this->_GetModuleAlias() . '_modify_option'))
    {
      echo $this->SetTabHeader('fielddeftab', $this->ModLang('fielddefs'), ($tab == 'fielddeftab'));
      
      if($is_list)
      {
        echo $this->SetTabHeader('templatetab', $this->ModLang('templates'), ($tab == 'templatetab'));
      }
      
      echo $this->SetTabHeader('optiontab', $this->ModLang('options'), ($tab == 'optiontab'));
    }
  }
  
  echo $this->EndTabHeaders();
  echo $this->StartTabContent();
  
  if($is_list)
  {
    echo $this->StartTab('itemtab', $params);
    include dirname(__FILE__) . '/function.admin_itemtab.php';
    echo $this->EndTab();
  }
  
  if ($this->CheckPermission($this->_GetModuleAlias() . '_modify_category') && $show_categories)
  {
    echo $this->StartTab('categorytab', $params);
    include dirname(__FILE__) . '/function.admin_categorytab.php';
    echo $this->EndTab();
  }
  
  if(!$separate_settings)
  {
  
    if($show_local)
    {
      echo $this->StartTab('localtab', $params);
      include dirname(__FILE__) . '/function.admin_local_tab.php';
      echo $this->EndTab();
    }
    
    if ($this->CheckPermission($this->_GetModuleAlias() . '_modify_option'))
    {
      echo $this->StartTab('fielddeftab', $params);
      include dirname(__FILE__) . '/function.admin_fielddeftab.php';
      echo $this->EndTab();
      
      if($is_list)
      {
        echo $this->StartTab('templatetab', $params);
        include dirname(__FILE__) . '/function.admin_templatetab.php';
        echo $this->EndTab();
      }
    }
    
    echo $this->StartTab('optiontab', $params);
    include dirname(__FILE__) . '/function.admin_optiontab.php';
    echo $this->EndTab();
    
  }
  
  echo $this->EndTabContent();
}

?>