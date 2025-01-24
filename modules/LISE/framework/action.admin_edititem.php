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
use \LISE\api;
if( !defined('CMS_VERSION') ) { exit; }

if( !$this->CheckPermission($this->_GetModuleAlias() . '_modify_item') ) { return; }

#---------------------
# Check params
#---------------------

if (isset($params['cancel']))
{
	lise_utils::clean_params($params, array('page'), true);
	$params['active_tab'] = 'itemtab';
	$this->Redirect($id, 'defaultadmin', $returnid, $params);
}

#---------------------
# Init params
#---------------------

$previous_id  = isset($params['previous_id']) ? $params['previous_id'] : '';
$next_id      = isset($params['next_id']) ? $params['next_id'] : '';
$submit_on_pn = $this->GetPreference('submit_on_pn', 0);# submit on 'previous' or 'next' click
$submit_on_pn = isset($params['submit_on_pn']) ? $params['submit_on_pn'] : $submit_on_pn;
$mode         = lise_utils::init_var('mode', $params, 'edit');
$item_id      = lise_utils::init_var('item_id', $params, -1);
$url          = lise_utils::init_var('url', $params, '');
$title        = lise_utils::init_var('title', $params, '');
$alias        = lise_utils::init_var('alias', $params, '');
$time_control = lise_utils::init_var('time_control', $params, 0);
$active       = 1;
$url_error    = FALSE;
$start_time   = '';
$end_time     = '';
$go           = !empty($params['go']) ? $params['go'] : 0;
$modified     = !empty($params['modified']) ? $params['modified'] : 0;
$preview      = !empty($params['preview']) ? $params['preview'] : 0;

$this->SetPreference('submit_on_pn', (int)$submit_on_pn, 0);

if ($time_control)
{
	$start_time = $params['start_time'];
	$end_time   = $params['end_time'];
}

#---------------------
# Init Item
#---------------------

$obj = $this->LoadItemByIdentifier('item_id', $item_id);
if($mode == 'copy')	$obj = LISEItemOperations::Copy($obj);


#---------------------
# Handle custom fields
#---------------------

if (isset($params['customfield']))
{
  if( !is_array($params['customfield']) ) $params['customfield'] = array($params['customfield']);
  
	foreach ((array)$params['customfield'] as $fldid => $value)
  {
		if(isset($obj->fielddefs[$fldid])) $obj->fielddefs[$fldid]->SetValue($value);
	}
  
  unset($params['customfield']);
}

#---------------------
# Submit, Preview, etc
#---------------------
if($preview)
{
  // save data for preview.
  unset(
    $params['apply'],
    $params['preview'],
    $params['submit'],
    $params['cancel'],
    $params['go'],
    $params['ajax']
  );
  
  $params['item_obj'] = base64_encode( serialize($obj) );
  
  $tmpfname = tempnam(TMP_CACHE_LOCATION, $this->GetName() . '_preview');
  
  file_put_contents($tmpfname, serialize($params));
  $detail_returnid = $this->GetPreference('summarypage', -1);
  
  if($detail_returnid <= 0)
  {
    $detail_returnid = ContentOperations::get_instance()->GetDefaultContent();
  }
  if(isset($params['previewpage']) && (int)$params['previewpage'] > 0)
  {
    $detail_returnid = (int)$params['previewpage'];
  }
  
  $_SESSION['lise_preview'] = [
    'fname'    => basename($tmpfname),
    'checksum' => md5_file($tmpfname)
  ];
  
  $tparms                   = ['preview' => md5(serialize($_SESSION['lise_preview']))];
  
  if(isset($params['detailtemplate']))
  {
    $tparms['detailtemplate'] = trim($params['detailtemplate']);
  }
  $url = $this->create_url('_preview_', 'detail', $detail_returnid, $tparms, TRUE);
  $response['url'] = $url;
  $response['error'] = '';
  
  if(isset($error) && $error != '')
  {
    $response['error'] =  $error;
  }
  
  $handlers = ob_list_handlers();
  for($cnt = 0; $cnt < sizeof($handlers); $cnt++) { ob_end_clean(); }
  header('Content-Type: text/json');
  echo json_encode($response);
  exit;
}
elseif( isset($params['submit']) || isset($params['apply']) || isset($params['save_create']) || ($go && $modified) )
{
	$errors = array();
	
	// check title
	if (empty($title))
  {
		$errors[] = $this->ModLang('item_title_empty');
	}

  // check alias
  if (!lise_utils::is_valid_alias($alias) && !empty($alias))
  {
    $errors[] = $this->ModLang('alias_invalid');
  }
  
  // Check for duplicate
  if( api::IsDuplicateItem($item_id, $alias) )
  {
    $errors[] = $this->ModLang('item_alias_exists');
  }
  
	// check if start date is less end date
	if ($time_control && $start_time && $end_time && strtotime($start_time) > strtotime($end_time))
  {
		$errors[] = $this->ModLang('error_startgreaterend');
	}
  
  // validate url format and route
  if( !empty($url) )
  {
    if( startswith($url,'/') || endswith($url,'/') )
    {
      $errors[] = $this->ModLang('item_url_invalid');
      $url = $obj->url;
      $url_error = TRUE;
    }
    else
    {
      $translated = munge_string_to_url($url, false, true);
      
      if( strtolower($translated) != strtolower($url) )
      {
        $errors[] = $this->ModLang('item_url_invalid');
        $url = $obj->url;
        $url_error = TRUE;
      }
    }
    
    if(!$url_error)
    {
      $url = trim($url," /\t\r\n\0\x08");

      if($item_id == -1 || $url !== $obj->url)
      {
        cms_route_manager::load_routes();
        $route = cms_route_manager::find_match($url);
        
        if($route)
        {
          $errors[] = $this->ModLang('item_url_invalid');
          $url = $obj->url;
          $url_error = TRUE;
        }
      }
    }
  }
	
	// PreProcess & Validations
	foreach($obj->fielddefs as $field)
  {
		$field->EventHandler()->ItemSavePreProcess($errors, $params);
	}
	
	// title and required fields have values, let's continue
	if (empty($errors))
  {
		$obj->title        	  = $title;
		$obj->alias		 	      = $alias;
		$obj->active       	  = isset($params['active']) ? 1 : 0;
		$obj->start_time   	  = $start_time;
    $obj->end_time        = $end_time;
		$obj->url     	      = $url;
		
		// Save item to database
		$this->SaveItem($obj);
		
		// PostProcess
		foreach($obj->fielddefs as $field)
    {
			$field->EventHandler()->ItemSavePostProcess($errors, $params);
		}
  
		// make sure you redirect to the requested go item_id
    if($go && $modified)
    {
      $this->Redirect($id, 'admin_edititem', $returnid, array(
          'item_id' => $go,
          'message' => 'changes_saved_previous'
        )
      );
      
    }
    
		// if apply and ajax
		if (isset($params['apply']) && isset($params['ajax']))
    {
			$response = '<EditItem>';
			$response .= '<Response>Success</Response>';
			$response .= '<Details><![CDATA[' . $this->ModLang('changessaved') . ']]></Details>';
      $response .= '<ItemID>' . $obj->item_id . '</ItemID>';
      $response .= '<ItemAlias>' . $obj->alias . '</ItemAlias>';
			$response .= '</EditItem>';
			echo $response;
			return;
		}
		
		// if save and create new
		if (isset($params['save_create']) )
    {
			$this->Redirect($id, 'admin_edititem', $returnid, array(
				'message' => 'changessaved_create'
			));
		}
  
		// show saved message
		if (isset($params['submit']))
    {
			lise_utils::clean_params($params, array('page'), true);
			$params['active_tab'] = 'itemtab';
			$params['message'] = 'changessaved';
			$this->Redirect($id, 'defaultadmin', $returnid, $params);
			
		}
    else
    {
			echo $this->ShowMessage($this->ModLang('changessaved'));
		}
		
	} // end error check
	
} // end submit or apply
elseif($go) // go is set with a previous or next item_id
{
  $this->Redirect($id, 'admin_edititem', $returnid, array('item_id' => $go));
}
elseif($obj->item_id > 0 || 'copy' == $mode)
{
	$item_id		      = $obj->item_id;
	$title 			      = $obj->title;
	$alias		  	    = $obj->alias;
	$active       	  = $obj->active;
	$start_time   	  = $obj->start_time;
  $end_time         = $obj->end_time;
	$url     	        = $obj->url;
	
	if(!empty($start_time)|| !empty($end_time))
  {
		$time_control = 1;
	}
  
  if('copy' == $mode)
  {
    $title 			      = $obj->title . ' (copy)';
    $alias		  	    = $obj->alias . '_copy';
  }
  
}

#---------------------
# Message control
#---------------------

// display errors if there are any
if (!empty($errors))
{
  $formated_errors = '';
  
  foreach ($errors as $error)
  {
    $formated_errors .= '<li>' . $error . '</li>';
  }
  
    if (isset($params['apply']) && isset($params['ajax']))
    {
      $response = '<EditItem>';
      $response .= '<Response>Error</Response>';
      $response .= '<Details><![CDATA[';
      $response .= $formated_errors;
      $response .= ']]></Details>';
      $response .= '</EditItem>';
      echo $response;
      return;
    }
    else
    {
      echo $this->ShowErrors('<ul>' . $formated_errors . '</ul>');
    }
}

if(isset($params['message']) && empty($errors))
    echo $this->ShowMessage($this->ModLang($params['message']));
    //echo $this->ShowMessage($this->ModLang('changessaved_create')); # apparent bug??? TODO: remove comment if fixed

$title_display_mode  = $this->GetPreference('title_display_mode', 0);
$hide_alias          = $this->GetPreference('hide_alias', 1);
$hide_slug           = $this->GetPreference('hide_slug', 1);
$hide_time_control   = $this->GetPreference('hide_time_control', 1);

#---------------------
# Smarty processing
#---------------------


$smarty->assign('itemObject', $obj)
  ->assign( 'previous_id', api::PreviousItem($obj->item_id, TRUE, $this) )
  ->assign( 'next_id', api::NextItem($obj->item_id, TRUE, $this) );

$item_name = ($item_id > 0 ? $title : '&laquo;' . $this->ModLang('untitled') . '&raquo;');
$header = $this->GetPreference('item_singular', '') . ': ' . $item_name;

$ajax_url1 = $this->create_url($id, 'ajax_geturl', $returnid);
$ajax_url2 = $this->create_url($id, 'ajax_get_alias', $returnid);

$smarty->assign('ajax_get_url', $ajax_url1)
  ->assign('ajax_get_alias', $ajax_url2)
  ->assign('edit_mode', $mode)
  ->assign('backlink', $this->CreateBackLink('itemtab'))
  ->assign('page_title', ($item_id > 0 ? $this->ModLang('edit') . ' ' . $this->GetPreference('item_singular', '') : $this->ModLang('add', $this->GetPreference('item_singular', ''))))
  ->assign('header', $header)
  ->assign('startform', $this->CreateFormStart($id, 'admin_edititem', $returnid, 'post', 'multipart/form-data', false, '', $params))
  ->assign('endform', $this->CreateFormEnd());

/**/
$smarty->assign('title', $title)
  ->assign('hide_alias', $hide_alias)
  ->assign('hide_slug', $hide_slug)
  ->assign('hide_time_control', $hide_time_control);

if($hide_alias)
{
  $smarty->assign('input_alias', $this->CreateInputHidden($id, 'alias', $alias));
}
else
{
  $smarty->assign('input_alias', $this->CreateInputText($id, 'alias', $alias, 50));
}

if($hide_slug)
{
  $smarty->assign('input_url', $this->CreateInputHidden($id, 'url', $alias));
}
else
{
  $smarty->assign('input_url', $this->CreateInputText($id, 'url', $url, 50));
}

$smarty->assign('url', $url);

if($hide_time_control)
{
  $smarty->assign('input_time_control', '')
         ->assign('use_time_control', '')
         ->assign('input_start_time', '')
         ->assign('input_end_time', '');
}
else
{
  $smarty->assign('input_time_control', $this->CreateInputcheckbox($id, 'time_control', 1, $time_control, 'onclick="togglecollapse(\'expiryinfo\');"'))
         ->assign('use_time_control', $time_control)
         ->assign('input_start_time', $this->CreateInputText($id, 'start_time', $start_time, 20))
         ->assign('input_end_time', $this->CreateInputText($id, 'end_time', $end_time, 20));
}


$smarty->assign('input_time_control', $this->CreateInputcheckbox($id, 'time_control', 1, $time_control, 'onclick="togglecollapse(\'expiryinfo\');"'))
  ->assign('use_time_control', $time_control)
  ->assign('input_start_time', $this->CreateInputText($id, 'start_time', $start_time, 20))
  ->assign('input_end_time', $this->CreateInputText($id, 'end_time', $end_time, 20));

if($this->CheckPermission($this->_GetModuleAlias() . '_approve_item'))
	$smarty->assign('input_active', $this->CreateInputcheckbox($id, 'active', 1, $active));

$contentops = cmsms()->GetContentOperations();
$smarty->assign('preview_returnid', $contentops->CreateHierarchyDropdown('', $this->GetPreference('detail_returnid', -1), 'preview_returnid'));


echo $this->ModProcessTemplate('edititem.tpl');
?>