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
class LISECategoryOperations
{
	#---------------------
	# Variables
	#---------------------
  
  private static $_prep_q = [];

	public static $identifiers = array(
		'category_id' 		=> 'category_id', 
		'category_alias' 	=> 'alias', 
		'hierarchy' 		=> 'hierarchy', 
		'id_hierarchy' 		=> 'id_hierarchy', 
		'hierarchy_path' 	=> 'hierarchy_path', 
		'key1' 				=> 'key1', 
		'key2' 				=> 'key2', 
		'key3' 				=> 'key3'
	);
  
  
  /**
   * Private methods
   */

  private static function _prepare_st($sid, $query)
  {
    if( !isset(self::$_prep_q[$sid]) )
    {
      self::$_prep_q[$sid] = cmsms()->GetDb()->Prepare($query);
    }
  
    return self::$_prep_q[$sid];
  }
  
	#---------------------
	# Magic methods
	#---------------------		
	
	private function __construct() {}
	
	#---------------------
	# Database methods
	#---------------------	
	
	static final public function Save(LISE &$mod, LISECategory &$obj)
	{
		// Check against mandatory list
		foreach(LISECategory::$mandatory as $rule)
		{
		  if($obj->$rule == '') { return; }
		}
		
		// Ensure that we have alias
		if($obj->alias == '')
		{
			$obj->alias = munge_string_to_url($obj->name, true);
		}
	
		$db = cmsms()->GetDb();
		
    // Get new position
    $sid      = 'save_get_max_position';
    $query    = 'SELECT max(position) + 1
                 FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
                 WHERE parent_id = ?';
    //$query    = self::_prepare_st($sid, $query);
    $position = $db->GetOne($query, [$obj->parent_id]);
    
    if($position == null) { $position = 1; }
	
		// Updadte Existing
		if($obj->category_id > 0)
		{
		  // Get old data
      $sid      = 'save_get_old_data';
			$query    = 'SELECT
                    parent_id,
                    position
                  FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
                  WHERE category_id = ?';
			
      //$query    = self::_prepare_st($sid, $query);
			$old_data = $db->GetRow($query, array($obj->category_id));		
		
			if($obj->parent_id != $old_data['parent_id'])
			{
		    // have to update position indexes of old siblings if changing parents.
        $sid      = 'save_update_position_idx';
        $query    = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
					           SET position = position - 1
                     WHERE parent_id = ? AND position > ?';
        //$query    = self::_prepare_st($sid, $query);
					
        $db->Execute($query, array($old_data['parent_id'], $old_data['position']));
			  
			}
			else
      {
				$position = $old_data['position'];
			}
      
      $sid      = 'save_update_category';
			$query    = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
					         SET
					            category_name = ?,
					            category_description = ?,
					            category_alias = ?,
					            position = ?,
					            parent_id = ?,
					            active = ?,
					            modified_date = NOW(),
					            key1 = ?,
					            key2 = ?,
					            key3 = ?
                   WHERE category_id = ?';
			
      //$query    = self::_prepare_st($sid, $query);
			$result   = $db->Execute($query, array(
				$obj->name, 
				$obj->description, 
				$obj->alias,  
				$position, 
				$obj->parent_id,
				$obj->active,
				$obj->key1,
				$obj->key2,
				$obj->key3,				
				$obj->category_id
			));
			
			if(!$result)
      {
        throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB );
      }
		}
		else // Create New
    {
			// check alias is unique
      $sid      = 'save_unique_alias';
      $query    = 'SELECT COUNT(alias) AS alias
                   FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
                   WHERE category_alias LIKE "' . $obj->alias . '%"';
      
      //$query    = self::_prepare_st($sid, $query);
      $dbresult = $db->GetOne($query);
			
			if($dbresult > 0) { $obj->alias .= '_'.($dbresult+1);	}
			
      $sid      = 'save_insert_new';
			$query    = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
					      (
                  category_name,
                  category_description,
                  category_alias,
                  position,
                  parent_id,
                  active,
                  create_date,
                  modified_date,
                  key1,
                  key2,
                  key3
					      )
					      VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?, ?)';
      //$query    = self::_prepare_st($sid, $query);
      
			$result   = $db->Execute($query, array(
                  $obj->name,
                  $obj->description,
                  $obj->alias,
                  $position,
                  $obj->parent_id,
                  $obj->active,
                  $obj->key1,
                  $obj->key2,
                  $obj->key3
                ));
			
			if (!$result)
      {
        throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB );
      }

			// populate $category_id for newly inserted category
			$obj->category_id = $db->Insert_ID();
		}

		// update hierarchy
		self::UpdateHierarchyPositions($mod);				
	}

	static final public function Delete(LISE &$mod, LISECategory &$obj)
	{
		$db = cmsms()->GetDb();
		
		if ($obj->category_id > 0)
		{
			// Get details
      $sid      = 'del_get_details';
			$query    = '
                  SELECT
                    position,
                    parent_id
                  FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
                  WHERE category_id = ?';
      //$query    = self::_prepare_st($sid, $query);
			$row      = $db->GetRow($query, array($obj->category_id));
			
			// Delete category
      $sid      = 'del_do_del_cat';
			$query    = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
			             WHERE category_id = ?';
      //$query    = self::_prepare_st($sid, $query);
			$db->Execute($query, array($obj->category_id));
			
			// Delete from items
      $sid      = 'del_do_delfrom_items';
			$query    = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item_categories
			             WHERE category_id = ?';
      //$query    = self::_prepare_st($sid, $query);
			$db->Execute($query, array($obj->category_id));			
									
			// Update position for siblings
			if($row['parent_id'] > 0)
			{
        $sid      = 'del_update_sib_pos';
				$query    = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
                     SET position = position - 1
                     WHERE parent_id = ? AND position > ?';
        //$query    = self::_prepare_st($sid, $query);
				$db->Execute($query, array($row['parent_id'], $row['position']));				
			}
			else
      {
        $sid      = 'del_update_cat_pos';
				$query    = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
				             SET position = position + 1
				             WHERE parent_id = ?';
        //$query    = self::_prepare_st($sid, $query);
				$db->Execute($query, array($obj->category_id));			
			}
			
			// Update parent for children
      $sid      = 'del_update_chld_pos';
			$query    = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
			             SET parent_id = ?
			             WHERE parent_id = ?';
      //$query    = self::_prepare_st($sid, $query);
			$db->Execute($query, array($row['parent_id'], $obj->category_id));			
			
			self::UpdateHierarchyPositions($mod);
			
			return true;
		}

		return FALSE;
	}

	static final public function Load(LISE &$mod, LISECategory &$obj, $row = false)
	{	
		$db = cmsms()->GetDb();
	
		// If we don't have row then attempt to load it
		if(!$row)
		{
			foreach(self::$identifiers as $db_column => $identifier)
			{
				if( !is_null($obj->$identifier) )
				{
          //$sid      = 'load_select_cat';
					$query    = "SELECT * FROM " . cms_db_prefix() . "module_" . $mod->_GetModuleAlias() . "_category
										   WHERE $db_column = ?
										   LIMIT 1";
          //$query    = self::_prepare_st($sid, $query);
					$row      = $db->GetRow($query, array($obj->$identifier));
					
					if($row) { break; }
				}
			}
		}
		
		if($row)
		{
      $obj->category_id    = $row['category_id'];
      $obj->alias          = $row['category_alias'];
      $obj->name           = $row['category_name'];
      $obj->description    = $row['category_description'];
      $obj->active         = $row['active'];
      $obj->position       = $row['position'];
      $obj->parent_id      = $row['parent_id'];
      $obj->hierarchy      = $row['hierarchy'];
      $obj->id_hierarchy   = $row['id_hierarchy'];
      $obj->hierarchy_path = $row['hierarchy_path'];
      $obj->create_date    = $row['create_date'];
      $obj->modified_date  = $row['modified_date'];
      $obj->depth          = count(explode('.', $obj->hierarchy));
      $obj->key1           = $row['key1'];
      $obj->key2           = $row['key2'];
      $obj->key3           = $row['key3'];
			
			// Items
			$query = '
			SELECT
			  A.item_id
			FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item A
      LEFT JOIN ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item_categories IB
      ON A.item_id = IB.item_id
      WHERE (IB.category_id = ?
      AND A.active = 1) ORDER BY position, item_id';

			$obj->items = $db->GetCol($query, array($obj->category_id));

			// Children
			$query = '
			SELECT category_id FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category
			WHERE parent_id = ? AND active = 1';
			$obj->children = $db->GetCol($query, array($obj->category_id));			
		
			return TRUE;
		}

		return FALSE;
	}	
	
	#---------------------
	# Utility methods
	#---------------------	

	static final public function GetHierarchyList(LISE &$mod, $null = true, $excludes = null)
	{
		if(!is_null($excludes) && !is_array($excludes)) {
		
			$excludes = array($excludes);
		}
		
		if(is_null($excludes)) $excludes = array();

		$db = cmsms()->GetDb();
		$contentops = cmsms()->GetContentOperations();
		
		$query = 'SELECT hierarchy, category_id, category_name FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category ORDER BY hierarchy ASC';
		$dbresult = $db->Execute($query);
		
		$options = $null ? array('--- '.lang('none').' ---' => '-1') : array();

		while($dbresult && $row = $dbresult->FetchRow()){
		
			if(in_array($row['category_id'], $excludes)) 
				continue;
				
			$position = $contentops->CreateFriendlyHierarchyPosition($row['hierarchy']);
			$options[$position . '. - ' . $row['category_name']] = $row['category_id'];
		}
		
		return $options;
	}
	
	// No in use
	static final public function GetChildrensForCategory(LISE &$mod, $id)
	{
		$db = cmsms()->GetDb();
	
		$query = 'SELECT category_id FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category WHERE parent_id = ?';
		$categories = $db->GetCol($query, array($id));

		$result = array();
		foreach($categories as $one_id) {
		
			$result[] = $mod->LoadCategoryByIdentifier('category_id', $one_id);
		}
	
		return $result;
	}
	
	static final public function GetCategoryNameFromId(LISE &$mod, $id_array)
	{
		$db = cmsms()->GetDb();
	
		$query = 'SELECT category_name FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category';
		$qparms = array();
		$clause = array();
		$result = array();
		
		foreach((array)$id_array as $one_id) {
			$clause[] = 'category_id = ?';
			$qparms[] = $one_id;
		}
		
		$query .= ' WHERE ' . implode(' OR ', $clause);
		$dbr = $db->Execute($query, $qparms);
		
		while($dbr && !$dbr->EOF) {
			
			$result[] = $dbr->fields['category_name'];
			$dbr->MoveNext();
		}
		
		if($dbr) 
			$dbr->Close();	
		
		return $result;
	}
	
	static final public function UpdateHierarchyPosition(LISE &$mod, $id)
	{
		$db = cmsms()->GetDb();

		$current_hierarchy_position = '';
		$current_id_hierarchy_position = '';
		$current_hierarchy_path = '';
		$current_parent_id = $id;

		while ($current_parent_id > -1)
		{
			$query = 'SELECT position, parent_id, category_alias FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category WHERE category_id = ?';
			$row = $db->GetRow($query, array($current_parent_id));
			if ($row) {
			
				$current_hierarchy_position = str_pad($row['position'], 5, '0', STR_PAD_LEFT) . '.' . $current_hierarchy_position;
				$current_id_hierarchy_position = $current_parent_id . '.' . $current_id_hierarchy_position;
				$current_hierarchy_path = $row['category_alias'] . '/' . $current_hierarchy_path;
				$current_parent_id = $row['parent_id'];
			}
			else {
			
				$current_parent_id = -1;
			}
		}

		if (strlen($current_hierarchy_position) > 0) {
		
			$current_hierarchy_position = substr($current_hierarchy_position, 0, strlen($current_hierarchy_position) - 1);
		}
		
		if (strlen($current_id_hierarchy_position) > 0) {
		
			$current_id_hierarchy_position = substr($current_id_hierarchy_position, 0, strlen($current_id_hierarchy_position) - 1);
		}
		
		if (strlen($current_hierarchy_path) > 0) {
		
			$current_hierarchy_path = substr($current_hierarchy_path, 0, strlen($current_hierarchy_path) - 1);
		}

		$query = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category SET hierarchy = ?, id_hierarchy = ?, hierarchy_path = ? WHERE category_id = ?';
		$db->Execute($query, array($current_hierarchy_position, $current_id_hierarchy_position, $current_hierarchy_path, $id));
	}

	static final public function UpdateHierarchyPositions(LISE &$mod)
	{
		$db = cmsms()->GetDb();

		$query = 'SELECT category_id FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_category';
		$dbr = $db->Execute($query);

		while ($dbr && !$dbr->EOF) {
		
			self::UpdateHierarchyPosition($mod, $dbr->fields['category_id']);
			$dbr->MoveNext();
		}
		
		if($dbr) 
			$dbr->Close();
	}	
	
} // end of class

?>