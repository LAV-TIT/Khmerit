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


#---------------------
# Database tables
#---------------------

$dict = NewDataDictionary($db);
$taboptarray = array('mysql' => 'Engine=InnoDB');

// create item table
$fields = '
            item_id I KEY AUTO,
            url C(255),
            category_id I,
            title C(255),
            alias C(255),
            position I,
            active I4,
            create_time DT,
            modified_time DT,
            start_time D,
            end_time D,
            key1 C(50),
            key2 C(50),
            key3 C(50),
            owner I
';

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item', $fields, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// create category table
$fields = '
            category_id I KEY AUTO,
            category_name C(255),
            category_alias C(255),
            category_description X,
            parent_id I,
            position I,
            hierarchy C(255),
            hierarchy_path C(255),
            id_hierarchy C(255),
            active I4,
            create_date DT,
            modified_date DT,
            key1 C(50),
            key2 C(50),
            key3 C(50)
';

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_category', $fields, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// create item_categories
$fields = '
    item_id I KEY NOT NULL DEFAULT \'-1\',
    category_id I KEY NOT NULL DEFAULT \'-1\'
';

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_item_categories', $fields, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// create fielddef table
$fields = '
            fielddef_id I KEY AUTO,
            name C(255),
            alias C(255),
            help C(255),
            type C(50),
            position I,
            required I,
            template C(255),
            extra X
';

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fielddef', $fields, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// create fielddef options table
$fields = '
            fielddef_id I KEY,
            name C(255) KEY,
            value X
';

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fielddef_opts', $fields, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

// create fieldval table
$fields = '
            item_id I KEY NOT null,
            fielddef_id I KEY NOT null,
            value_index I KEY NOT null,
            value X,
            data X
';

$sqlarray = $dict->CreateTableSQL(cms_db_prefix() . 'module_' . $this->_GetModuleAlias() . '_fieldval', $fields, $taboptarray);
$dict->ExecuteSQLArray($sqlarray);

# now check for DNA data and if it exists use it instead
$fn = cms_join_path($this->GetModulePath(), 'data', 'dna.xml');

$imported = FALSE;
if(@is_readable($fn))
{
  $xmlstr = file_get_contents($fn);
  $importer = new \LISE\DNAImporter($xmlstr);
  
  try
  {
    $importer->Run();
    $imported = TRUE;
  }
  catch(Exception $e)
  {
    audit('', $this->GetName(), 'Could not import from DNA file!');
  }
}

if(!$imported)
{
  #---------------------
  # Templates
  #---------------------
  
  // Summary templates
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_summary_default.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('summary_default', $template);
    $this->SetPreference($this->_GetModuleAlias() . '_default_summary_template', 'default');
  }
  
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_summary_categorized.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('summary_categorized', $template);
  }
  
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_summary_accordion.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('summary_accordion', $template);
  }
  
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_summary_searchresults.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('summary_searchresults', $template);
  }
  
  // Detail templates
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_detail_default.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('detail_default', $template);
    $this->SetPreference($this->_GetModuleAlias() . '_default_detail_template', 'default');
  }
  
  // Search templates
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_search_default.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('search_default', $template);
    $this->SetPreference($this->_GetModuleAlias() . '_default_search_template', 'default');
  }
  
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_search_filter.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('search_filter', $template);
  }
  
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_search_multiselect.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('search_multiselect', $template);
  }
  
  // Category templates
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_category_default.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('category_default', $template);
    $this->SetPreference($this->_GetModuleAlias() . '_default_category_template', 'default');
  }
  
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_category_hierarchy.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('category_hierarchy', $template);
  }
  
  // Archive templates
  $fn = cms_join_path(LISE_TEMPLATE_PATH, 'fe_archive_default.tpl');
  if( file_exists( $fn ) ) {
    $template = @file_get_contents($fn);
    $this->SetTemplate('archive_default', $template);
    $this->SetPreference($this->_GetModuleAlias() . '_default_archive_template', 'default');
  }
  
  #---------------------
  # Preferences
  #---------------------
  
  $this->SetPreference('sortorder', 'ASC');
  $this->SetPreference('adminsection', 'content');
  $this->SetPreference('url_prefix', munge_string_to_url($this->GetName(), true));
  $this->SetPreference('urltemplate', '{Prefix|lower}/{ItemTitle|lower}');
  $this->SetPreference('alias_template', '{ItemTitle|lower}_{ItemNextID|string_format:"%06u"}');
  $this->SetPreference('friendlyname', $this->GetName());
  $this->SetPreference('item_singular', utf8_encode(html_entity_decode($this->ModLang('item'))));
  $this->SetPreference('item_plural', utf8_encode(html_entity_decode($this->ModLang('items'))));
  $this->SetPreference('item_title', utf8_encode(html_entity_decode($this->ModLang('item_title'))));
  $this->SetPreference('inactive_item_triggers_404', 1);
  //$this->SetPreference($this->_GetModuleAlias() . '_default_category', '1');
}

#---------------------
# Permissions
#---------------------

$this->CreatePermission($this->_GetModuleAlias() . '_modify_item', $this->_GetModuleAlias() . ': Modify Items');
$this->CreatePermission($this->_GetModuleAlias() . '_modify_category', $this->_GetModuleAlias() . ': Modify Categories');
$this->CreatePermission($this->_GetModuleAlias() . '_modify_option', $this->_GetModuleAlias() . ': Modify Options');
$this->CreatePermission($this->_GetModuleAlias() . '_remove_item', $this->_GetModuleAlias() . ': Remove items');
$this->CreatePermission($this->_GetModuleAlias() . '_approve_item', $this->_GetModuleAlias() . ': Approve items');
$this->CreatePermission($this->_GetModuleAlias() . '_modify_all_item', $this->_GetModuleAlias() . ': Modify all items');

#---------------------
# Events
#---------------------

$this->CreateEvent('PreItemSave');
$this->CreateEvent('PostItemSave');

$this->CreateEvent('PreItemDelete');
$this->CreateEvent('PostItemDelete');

$this->CreateEvent('PreItemLoad');
$this->CreateEvent('PostItemLoad');

$this->CreateEvent('PreRenderAction');