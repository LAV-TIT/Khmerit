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
use LISE\parameters;
use LISE\Session;

/**
 * variables in scope from file inclusion
 */
/** @var int $returnid */
/** @var \LISEInstance $this */
/**/

if( !defined('CMS_VERSION') ) exit;

/**
 * extract values from params
 */

$summarytemplate = $this->GetPreference($this->_GetModuleAlias() . '_default_summary_template');
$detailpage      = $this->GetPreference('detailpage', $returnid);

/**
 * expected params set in a blueprint array
 *
 * they will be converted to variables with set or default values
 */
/** @var string $tag */
/** @var string $search */
/** @var string $summarytemplate */
/** @var string|int $detailpage */
/** @var string|int $summarypage */
/** @var bool $debug */
/** @var bool $noprops */
/** @var bool $nofds */

$blueprint = [
  'tag' => [
    'default' => '',
    'type' => 'string',
  ],
  'search' => [
    'default' => '',
    'type' => 'string',
  ],
  // deprecated, scheduled for removal
  'template_summary' => [
    'default' => $summarytemplate,
    'type' => 'string',
  ],
  'summarytemplate' => [
    'default' => $summarytemplate,
    'type' => 'string',
  ],
  'detailpage' => [
    'default' => $detailpage,
    'type' => 'string',
  ],
  'summarypage' => [
    'default' => '',
    'type' => 'string',
  ],
  'debug' => [
    'default' => FALSE,
    'type' => 'bool',
  ],
  'noprops' => [
    'default' => FALSE,
    'type' => 'bool',
  ],
  'nofds' => [
    'default' => FALSE,
    'type' => 'bool',
  ]
];

# smallish hack for tags
if( isset($params['tag']) )
{
  $params['search'] = urldecode($params['tag']);
  unset($params['tag']);
}

$vars = parameters::from_blueprint($params, $blueprint);

# now pass them into vars
//foreach($vars as $k => $v){ $$k = $v; } # <- by some accounts this can be faster???
extract($vars, EXTR_OVERWRITE);

# now make some corrections
//which template to use
$detail_override = isset($params['summarytemplate']);
$summarytemplate = ($detail_override && $template_summary !== $summarytemplate) ? $summarytemplate : $template_summary;
$summarytemplate = 'summary_' . $summarytemplate;

#---------------------
# Check params End
#---------------------


# flag to define which kind of urls to use on pagination
# given the fact that search results and filtered pages can't use pretty URLS... period!!!
$pretty_pagination = TRUE;

# store the search and filter parameters into the session so they can be retrieved by smarty if needed
# instancename_search and # instancename_search_*, where * is a field alias
$sesvarprefix   = $this->GetName() . '_';
$params2session = [
                    'showall',
                    'category',
                    'exclude_category',
                    'subcategory',
                    'start',
                    'include_items',
                    'exclude_items',
                    'filter_year',
                    'filter_month'
                  ];


foreach($params as $k => $v)
{
  if( startswith($k, 'search') )
  {
    Session::Store($this, $k, $v);
    $pretty_pagination = FALSE;
  }
  
  if( in_array($k, $params2session) )
  {
    Session::Store($this, $k, $v);
    $pretty_pagination = FALSE;
  }
}

#---------------------
# Init objects
#---------------------
$item_query = $this->GetItemQuery($params);

Events::SendEvent(
                    $this->GetName(),
                    'PreRenderAction',
                    ['action_name' => $name,
                    'query_object' => &$item_query]
                  );

if( !is_numeric($detailpage) && cmsms()->is_frontend_request())
{
  if( !isset($hm) )
  {
    $hm = cmsms()->GetHierarchyManager();
  }
  
  $detailpage_obj = $hm->sureGetNodeByAlias($detailpage);
  
  if( is_object($detailpage_obj) )
  {
    $detailpage = $detailpage_obj->GetId();
  }
  else
  {
    $detailpage = 0;
  }
}
else
{
  $detailpage = $this->GetPreference('detailpage', $returnid);
}

$_SESSION[$this->GetName() . 'dp'] = [$detailpage => $returnid];

if( empty($detailpage) ) { $detailpage = $returnid; }

# Summary page check
if( isset($summarypage))
{
  if( !is_numeric($summarypage) )
  {
    if( !isset($hm) )
    {
      $hm = cmsms()->GetHierarchyManager();
    }
    
    $summarypage_obj = $hm->sureGetNodeByAlias($summarypage);
    
    if( is_object($summarypage_obj) )
    {
      $summarypage = $summarypage_obj->GetId();
    }
  }
}
else
{
  $summarypage = $this->GetPreference('summarypage', $returnid);
}

// Workaround for BR#11074, can be removed when fixed.
if( empty($summarypage) )
{
  $summarypage = $returnid;
}

# light mode?
$nofds = $nofds || $noprops;

# inline?
$inline = $this->GetPreference('display_inline', 0);

#---------------------
# Init items
#---------------------
$item_query->AppendTo(LISEQuery::VARTYPE_WHERE, 'A.active = 1');
$result     = $item_query->Execute(TRUE);

$totalcount = 0;
$fields     = $nofds ? FALSE : [];
$items      = [];

####
#$linkparams = $params; // Initialize with the original $params
####

while($result && $row = $result->FetchRow())
{
	if(!isset($this->_item_cache[$row['item_id']]))
  {
		$cache = $this->InitiateItem($fields);
    
    try
    {
      LISEItemOperations::Load($this, $cache, $row, $nofds);
    }
    catch(Exception $e)
    {
      $this->Audit($this->GetName(), $e->getMessage(), 'item_load');
    }
    
    $this->_item_cache[] = $cache;
	}
  
  $obj                = clone $this->_item_cache[$row['item_id']];
  $linkparams         = [];
  $linkparams['item'] = $obj->alias;
  
  lise_utils::clean_params($params, ['returnid']);

	$linkparams = array_merge($linkparams, $params);
  
  # just a minor hack to allow $params['detailpage'] to override the item set url when it exists
  # if we set $pretty_url to '' the custom url will be ignored and one will be generated
  
  $pretty_url = $detail_override ? '' : $pretty_url = $obj->url;
  $obj->url   = $this->CreatePrettyLink(
    $id,
    'detail',
    $detailpage,
    '',
    $linkparams,
    '',
    TRUE,
    $inline,
    '',
    FALSE,
    $pretty_url
  );
  
  // lets deal with tags if they are available
  foreach($obj->fielddefs as $one)
  {
    $linkparams = [];
    if( 'Tags' !== $one->type) continue;
    $one->SetTagsParams($this, $id, 'default', $summarypage, $linkparams);
  }
  
	$items[$row['item_id']] = $obj;
  $totalcount = $item_query->TotalCount();
}

#---------------------
# Smarty processing
#---------------------

$pagenumber = $item_query->GetPageNumber();
$pagecount  = $item_query->GetPageCount();

$smarty_vars = [];

$smarty_vars['totalcount'] = $totalcount;

// Assign some pagination variables to smarty
if(1 === $pagenumber)
{
  $smarty_vars['prevpage']  = $this->ModLang('prevpage');
  $smarty_vars['firstpage'] = $this->ModLang('firstpage');
}
else
{
	$params['pagenumber'] = $pagenumber-1;
  
  if($pretty_pagination)
  {
    $smarty_vars['prevpage']  = $this->ModLang('prevpage');
    $smarty_vars['prevurl']   = $this->CreatePrettyLink($id, 'default', $summarypage,'', $params, '', true, $inline);
  }
  else
  {
    $smarty_vars['prevpage']  = $this->CreateLink($id, 'default', $summarypage, $this->ModLang('prevpage'),$params, '', false, $inline);
    $smarty_vars['prevurl']   = $this->CreateLink($id, 'default', $summarypage,'', $params, '', true, $inline);
  }
	
  $params['pagenumber'] = 1;
  
  if($pretty_pagination)
  {
    $smarty_vars['firstpage']  = $this->CreatePrettyLink($id, 'default', $summarypage, $this->ModLang('firstpage'),$params, '', false, $inline);
    $smarty_vars['firsturl']   = $this->CreatePrettyLink($id, 'default', $summarypage,'', $params, '', true, $inline);
  }
  else
  {
    $smarty_vars['firstpage']  = $this->CreateLink($id, 'default', $summarypage, $this->ModLang('firstpage'),$params, '', false, $inline);
    $smarty_vars['firsturl']   = $this->CreateLink($id, 'default', $summarypage,'', $params, '', true, $inline);
  }
}

if($pagenumber >= $pagecount)
{
  $smarty_vars['nextpage']  = $this->ModLang('nextpage');
  $smarty_vars['lastpage']  = $this->ModLang('lastpage');
}
else
{
	$params['pagenumber'] = $pagenumber+1;
  
  if($pretty_pagination)
  {
    $smarty_vars['nextpage'] = $this->CreatePrettyLink($id, 'default', $summarypage, $this->ModLang('nextpage'), $params, '', false, $inline);
    $smarty_vars['nexturl']  = $this->CreatePrettyLink($id, 'default', $summarypage, '', $params, '', true, $inline);
  }
  else
  {
    $smarty_vars['nextpage'] = $this->CreateLink($id, 'default', $summarypage, $this->ModLang('nextpage'), $params, '', false, $inline);
    $smarty_vars['nexturl']  = $this->CreateLink($id, 'default', $summarypage, '', $params, '', true, $inline);
  }
  
	$params['pagenumber'] = $pagecount;

  if($pretty_pagination)
  {
    $smarty_vars['lastpage'] = $this->CreatePrettyLink($id, 'default', $summarypage, $this->ModLang('lastpage'), $params, '', false, $inline);
    $smarty_vars['lasturl']  = $this->CreatePrettyLink($id, 'default', $summarypage, '', $params, '', true, $inline);
  }
  else
  {
    $smarty_vars['lastpage'] = $this->CreateLink($id, 'default', $summarypage, $this->ModLang('lastpage'), $params, '', false, $inline);
    $smarty_vars['lasturl']  = $this->CreateLink($id, 'default', $summarypage, '', $params, '', true, $inline);
  }
}

$smarty_vars['pagenumber'] = $pagenumber;
$smarty_vars['pagecount']  = $pagecount;

$pagelinks = [];

while($pagecount)
{
  $obj                  = new stdClass();
  $params['pagenumber'] = $pagecount;
  
  if($pretty_pagination)
  {
    $obj->link = $this->CreatePrettyLink($id, 'default', $summarypage, $pagecount, $params, '', false, $inline);
    $obj->url = $this->CreatePrettyLink($id, 'default', $summarypage, '', $params, '', true, $inline);
  }
  else
  {
	  $obj->link = $this->CreateLink($id, 'default', $summarypage, $pagecount, $params, '', false, $inline);
	  $obj->url = $this->CreateLink($id, 'default', $summarypage, '', $params, '', true, $inline);
  }
	
	$pagelinks[$pagecount] = $obj;
	$pagecount--;
}

$pagelinks = array_reverse($pagelinks, true);

$smarty_vars['pagelinks']                 = $pagelinks;
$smarty_vars['items']                     = $items;
$smarty_vars[$this->GetName() . '_items'] = $items; // <- Alias for $items
$smarty_vars['LISE_action']               = 'default';

$smarty->assign($smarty_vars);

echo $this->ProcessTemplateFromDatabase($summarytemplate);

if($debug)
	$smarty->display('string:<pre>{$items|@print_r}</pre>');
?>