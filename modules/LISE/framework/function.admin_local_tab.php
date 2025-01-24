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



#---------------------
# Check params
#---------------------

//if (isset($params['cancel']))
//{
//	lise_utils::clean_params($params, array('page'), true);
//	$params['active_tab'] = 'itemtab';
//	$this->Redirect($id, 'defaultadmin', $returnid, $params);
//}

#---------------------
# Init params
#---------------------

$mode	      				    = 'edit';
$item_id                = -1;
$url      				      = '';
$title       			 	    = $this->GetName();
$alias		 			 	      = $this->GetName();
$time_control 				  = 0;
$active      			 	    = 1;

$url_error = FALSE;
$start_time = '';
$end_time = '';

#---------------------
# Init Item
#---------------------

if( !empty($local_mode_instance) )
{
  $lmi_mod = \cms_utils::get_module($local_mode_instance);
  $show_local = is_object($lmi_mod);
  $obj = $lmi_mod->LoadItemByIdentifier( 'alias', $this->GetName() );
}
else
{
  return;
}


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
# Submit
#---------------------

if( isset($params['apply']) )
{
  
  $errors = array();
  
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
    //$obj->categories	= $categories;
    //$obj->category_id = $category_id;
    
    // Save item to database
    $lmi_mod->SaveItem($obj);
    
    // PostProcess
    foreach($obj->fielddefs as $field)
    {
      $field->EventHandler()->ItemSavePostProcess($errors, $params);
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
      $this->Redirect($id, 'defaultadmin', $returnid, array(
        'message' => 'savecreate_message'
      ));
    }
    
    // show saved message
    if (isset($params['submit']))
    {
      lise_utils::clean_params($params, array('page'), true);
      $params['active_tab'] = 'localtab';
      $params['message'] = 'changessaved';
      $this->Redirect($id, 'defaultadmin', $returnid, $params);
      
    }
    else
    {
      echo $this->ShowMessage($this->ModLang('changessaved'));
    }
    
  } // end error check
  
} // end submit or apply


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
  echo $this->ShowMessage($this->ModLang('changessaved_create'));



#---------------------
# Smarty processing
#---------------------

$smarty->assign('itemObject', $obj);

$ajax_url1 = $this->create_url($id, 'ajax_geturl', $returnid);
$ajax_url2 = $this->create_url($id, 'ajax_get_alias', $returnid);
$smarty->assign('ajax_get_url', $ajax_url1);
$smarty->assign('ajax_get_alias', $ajax_url2);

$header = '';
$smarty->assign('header', $header);
$smarty->assign('startform', $this->CreateFormStart($id, 'admin_local', $returnid, 'post', 'multipart/form-data', false, '', $params));
$smarty->assign('endform', $this->CreateFormEnd());

$smarty->assign('input_title', $this->CreateInputText($id, 'title', $title, 50));

if($this->CheckPermission($this->_GetModuleAlias() . '_approve_item'))
  $smarty->assign('input_active', $this->CreateInputcheckbox($id, 'active', 1, $active));

echo $this->ModProcessTemplate('local_edit.tpl');
?>
