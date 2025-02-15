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

if (!$this->CheckPermission($this->_GetModuleAlias(). '_modify_option')) return;

#---------------------
# Error processing
#---------------------

$errors = array();

if(empty($params['url_prefix']))
{
  $errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_url_prefix'));
}

if(empty($params['friendlyname']))
{
  $errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_friendlyname'));
}

if(empty($params['item_title']))
{
  $errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_item_title'));
}

if(empty($params['item_singular']))
{
  $errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_item_singular'));
}

if(empty($params['item_plural']))
{
  $errors[] = $this->ModLang('error_optionrequired', $this->ModLang('prompt_item_plural'));
}

if(count($errors))
{
  $params = array('errors' => $errors[0], 'active_tab' => 'optiontab');
  $this->Redirect($id, 'defaultadmin', '', $params);
}

#---------------------
# Set new values
#---------------------

$this->SetPreference('friendlyname',		    $params['friendlyname']);
$this->SetPreference('adminsection',		    $params['adminsection']);
$this->SetPreference('moddescription',      $params['moddescription']);
$this->SetPreference('hide_alias',		      (isset($params['hide_alias'])?1:0));
$this->SetPreference('hide_slug',		        (isset($params['hide_slug'])?1:0));
$this->SetPreference('title_auto_gen',		  (isset($params['title_auto_gen'])?1:0));
$this->SetPreference('hide_time_control',		(isset($params['hide_time_control'])?1:0));
$this->SetPreference('title_display_mode',	$params['title_display_mode']);
$this->SetPreference('item_title',			    $params['item_title']);
$this->SetPreference('sortorder',			      $params['items_sortorder']);
$this->SetPreference('item_singular',		    $params['item_singular']);
$this->SetPreference('item_plural',			    $params['item_plural']);
$this->SetPreference('display_create_date', (isset($params['display_create_date'])?1:0));
$this->SetPreference('item_cols',			      ((isset($params['item_cols']) && is_array($params['item_cols'])) ? implode(',', $params['item_cols']) : ''));
$this->SetPreference('items_per_page',	  	$params['items_per_page']);
$this->SetPreference('url_prefix',			    $params['url_prefix']);
$this->SetPreference('local_mode_instance', $params['local_mode_instance']);
$this->SetPreference('display_inline',		  (isset($params['display_inline'])?1:0));
$this->SetPreference('subcategory',			    (isset($params['subcategory'])?1:0));
$this->SetPreference('urltemplate',         (isset($params['urltemplate'])? $params['urltemplate'] : $this->GetPreference('urltemplate', '{$prefix}/{$item_title}') ) );
$this->SetPreference('title_template',      (isset($params['title_template'])? $params['title_template'] : $this->GetPreference('title_template', '{$prefix}/{$item_title}') ) );
$this->SetPreference('alias_template',      (isset($params['alias_template'])? $params['alias_template'] : $this->GetPreference('alias_template', '{$prefix}/{$item_title}') ) );
$this->SetPreference('inactive_item_triggers_404',         (isset($params['inactive_item_triggers_404'])?1:0));
// Module defaults
$this->SetPreference('detailpage',			    $params['detailpage'] >= 0 ? $params['detailpage'] : NULL);
$this->SetPreference('summarypage',			    $params['summarypage'] >= 0 ? $params['summarypage'] : NULL);

// Misc
$this->SetPreference('auto_upgrade',        (isset($params['auto_upgrade']) ? 1 : 0));
$this->SetPreference('separate_settings',   (isset($params['separate_settings']) ? 1 : 0));

// Cross Module options
$old_reindex_search = $this->GetPreference('reindex_search', 0);
$reindex_search = (isset($params['reindex_search']) ? 1 : 0);
$this->SetPreference('reindex_search', $reindex_search);

if($reindex_search != $old_reindex_search && $params['_do_reindex'])
{
  $Search = cms_utils::get_search_module();
  if($reindex_search)
  {
    LISEItemOperations::reindex_search($Search, $this);
  }
  else 
  {
    LISEItemOperations::remove_index_search($Search, $this);
  }
}

$params = array('message' => 'changessaved', 'active_tab' => 'optiontab');
$this->Redirect($id, 'defaultadmin', '', $params);
?>