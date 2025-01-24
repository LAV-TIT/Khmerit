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

final class LISEItemOperations
{
	#---------------------
	# Variables
	#---------------------	
  /**
   * an array of valid identifiers
   * @var array|string[]
   */
  public static array $identifiers = [
    'item_id' => 'item_id',
    'alias'   => 'alias',
    'key1'    => 'key1',
    'key2'    => 'key2',
    'key3'    => 'key3',
    'url'     => 'url'
  ];
  /*
   * flags
   */
  
  # get Identifier flags
  public const IDENT_INC_DEFAULT  = 0; # 0000 - DEFAULT is a fallback to previous versions = ACTIVE
  public const IDENT_INC_ACTIVE   = 1; # 0001 - ACTIVE active only
  public const IDENT_INC_INACTIVE = 2; # 0010 - INACTIVE inactive only

	#---------------------
	# Magic methods
	#---------------------		
	
	private function __construct() {}
	
	#---------------------
	# Database methods
	#---------------------	
  
  /**
   * @param \LISE     $mod
   * @param \LISEItem $obj
   *
   * @throws \LISE\Exception
   */
	public static function Save(LISE $mod, LISEItem $obj) : void
  {
		Events::SendEvent( $mod->GetName(), 'PreItemSave', array('item_object' => $obj) );

		// Check against mandatory list
		foreach(LISEItem::$mandatory as $rule)
    {
			if($obj->$rule === '') { return; }
		}
		
		$db = cmsms()->GetDb();
	
		//$time = $db->DBTimeStamp( time() );

		$sql_start_time = $obj->start_time ? date( 'Y-m-d', strtotime($obj->start_time) ) : NULL;
		$sql_end_time   = $obj->end_time ? date( 'Y-m-d', strtotime($obj->end_time) ) : NULL;
		
		// Ensure that we have alias
    if($obj->alias === '')
    {
      $obj->alias = munge_string_to_url($obj->title, TRUE);
    }
  
    // Try grabbing owner if not set
    if(is_null($obj->owner))
    {
      $loggedin = get_userid(FALSE);
      if($loggedin) { $obj->owner = $loggedin; }
    }
			
		// Existing item	
		if ($obj->item_id > 0) 
    {	
			// update item
			$query  = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item 
					SET title = ?, alias = ?, active = ?, start_time = ?, end_time = ?, modified_time = NOW(), key1 = ?, key2 = ?, key3 = ?, owner = ?, url = ? 
					WHERE item_id = ?';
      
      $terms = [
                  $obj->title,
                  $obj->alias,
                  //$obj->category_id,
                  $obj->active,
                  $sql_start_time,
                  $sql_end_time,
                  $obj->key1,
                  $obj->key2,
                  $obj->key3,
                  $obj->owner,
                  $obj->url,
                  $obj->item_id
                ];
						
			$result = $db->Execute($query, $terms);

      if(!$result)
      {
        throw new \LISE\Exception(
          $db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB
        );
      }
		
		
		} 
    else // New item
    {
			// find position before inserting new item
			$query = 'SELECT MAX(position) + 1 FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item';
			$position = $db->GetOne($query);

			if ($position === null) { $position = 1; }
			
			// check alias is unique
			$query = 'SELECT COUNT(alias) as alias FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item WHERE alias LIKE "'.$obj->alias.'%"';
			$dbresult = $db->GetOne($query);
			
			if($dbresult > 0)
				$obj->alias .= '_'.($dbresult+1);	
			
			// insert item
			$query  = 'INSERT INTO ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item 
					(title, alias, position, active, create_time, modified_time, start_time, end_time, key1, key2, key3, owner, url) 
					VALUES (?, ?, ?, ?, NOW(), NOW(), ?, ?, ?, ?, ?, ?, ?)';
          
      $terms = [
                  $obj->title,
                  $obj->alias,
                  //$obj->category_id,
                  $position,
                  $obj->active,
                  $sql_start_time,
                  $sql_end_time,
                  $obj->key1,
                  $obj->key2,
                  $obj->key3,
                  $obj->owner,
                  $obj->url
                ];
					
			$result = $db->Execute($query, $terms);
			
      if(!$result)
      {
        throw new \LISE\Exception(
          $db->ErrorNo() . ' - ' . $db->ErrorMsg() . ' - Query: ' . $db->sql, \LISE\Error::DISCRETE_DB
        );
      }

			// populate $item_id for newly inserted item
			$obj->item_id = $db->Insert_ID();		
		}
	

//		if ($obj->active && '' != $obj->url)
//		{
//			cms_route_manager::del_static('',$mod->_GetModuleAlias(),$obj->item_id);
//
//      $detailpage = $mod->GetPreference('detailpage', -1);
//
//      if(-1 == $detailpage)
//      {
//        $contentops = cmsms()->GetContentOperations();
//        $detailpage = $contentops->GetDefaultContent();
//      }
//
//	  	$parms = ['action' =>'detail',
//                'returnid' =>$detailpage,
//                'item' =>$obj->item_id];
//
//	  	$route = CmsRoute::new_builder($obj->url,$mod->GetName(),$obj->item_id,$parms,TRUE);
//    	cms_route_manager::add_static($route);
//	  }

    $add_to_search = $mod->GetPreference('reindex_search');
    $search        = NULL;
    
    if($add_to_search)
    {
      // Init search
      $allowed_types = ['TextInput', 'TextArea'];
      $search        = cms_utils::get_search_module();
      $words         = $obj->title;
      
      if (is_object($search))
      {
        $search->AddWords($mod->GetName(), $obj->item_id, 'title',  $obj->title);
      }
    }
    
    // handle inserting custom fields into database
    if(count($obj->fielddefs)) 
    {
      //LISEFielddefOperations::ProcessFieldsList($obj->fielddefs); # not here.... needs to be checked elsewhere
      foreach ($obj->fielddefs as $field) 
      {    
        $field->SetItemId($obj->item_id); // <- Remove in 1.5 (???)
        $field->EventHandler()->OnItemSave($mod);
        if($add_to_search)
        {
          // Part of search reindexing
          if( !in_array($field->GetType(), $allowed_types) ) continue;
          if( !$field->GetOptionValue('search_index') ) continue;
          $words .= ' ' . $field->GetValue('string');
        }
      }
    }
    
    if($add_to_search && is_object($search))
    {
      $search->AddWords($mod->GetName(), $obj->item_id, $mod->GetPreference('item_singular', 'item'), $words);
    }

		Events::SendEvent($mod->GetName(), 'PostItemSave', array('item_object' => &$obj));
		
	}
  
  /**
   * @param \LISE     $mod
   * @param \LISEItem $obj
   *
   * @return bool
   * @throws \Exception
   */
	public static function Delete(LISE $mod, LISEItem $obj) : bool
  {
		Events::SendEvent($mod->GetName(), 'PreItemDelete', array('item_object' => &$obj));	
	
		$db = cmsms()->GetDb();
		
		if ($obj->item_id > 0) 
    {
			// get details
			$query = 'SELECT * FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item WHERE item_id = ?';
			$row = $db->GetRow($query, array($obj->item_id));
			
			// delete item
			$query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item WHERE item_id = ?';
			$db->Execute($query, array($obj->item_id));
			
			// Delete from items
			$query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item_categories WHERE item_id = ?';
			$db->Execute($query, array($obj->item_id));				
			
			// Clean up sort order
			$query = 'UPDATE ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item SET position = (position - 1) WHERE position > ?';
			$db->Execute($query, array($row['position']));			
			
			// Delete field values from regular tables
			$query = 'DELETE FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_fieldval WHERE item_id = ?';
			$db->Execute($query, array($obj->item_id));			
			
			// Delete field values from any external tables (this might not belong here, double check)
			if(count($obj->fielddefs)) 
      {
				foreach ((array)$obj->fielddefs as $field) 
        {
					$field->EventHandler()->OnItemDelete($mod);
				} // end of foreach
			} // end of count
			
			Events::SendEvent($mod->GetName(), 'PostItemDelete', array('item_object' => &$obj));
			
			return true;
		}

		return FALSE;
	}
  
  /**
   * @param \LISE     $mod
   * @param \LISEItem $obj
   * @param bool      $row
   * @param bool      $nofds
   *
   * @return bool
   * @throws \Exception
   */
	public static function Load(LISE $mod, LISEItem $obj, $row = FALSE, $nofds = FALSE) : bool
  {
		Events::SendEvent($mod->GetName(), 'PreItemLoad', ['item_object' => &$obj]);
	
		// If we don't have row then attempt to load it
		if(!$row)
    {
			foreach(self::$identifiers as $db_column => $identifier)
      {
				if(NULL !== $obj->$identifier)
        {
					$db = cmsms()->GetDb();

					$query = 'SELECT * FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . "_item
										WHERE $db_column = ?
										LIMIT 1";

					$row = $db->GetRow($query, [$obj->$identifier]);

					if($row) break;
				}
			}
		}
  
		if($row)
    {
			// Item table
			//$obj->id        			= $row['item_id'];
			$obj->item_id        		= $row['item_id']; // deprecated
			$obj->title        			= $row['title'];
			$obj->alias		 			    = $row['alias'];
			$obj->position       		= $row['position'];
			$obj->active       			= $row['active'];
			$obj->create_time  			= $row['create_time'];
			$obj->modified_time  		= $row['modified_time'];
			$obj->start_time   			= $row['start_time'];
			$obj->end_time     			= $row['end_time'];
			$obj->owner     			  = $row['owner'];

			$obj->key1		 			    = $row['key1'];
			$obj->key2		 			    = $row['key2'];
      $obj->key3              = $row['key3'];
			$obj->url		 			      = $row['url'];
			//$obj->category_id 			= $row['category_id'];

      /**
       * we now have a light mode where we don't load extra fields @since 1.5
       */
      
			// Fields
			if( !$nofds && count($obj->fielddefs) )
      {
        foreach((array)$obj->fielddefs as $field)
        {
          $field->SetItemId($obj->item_id); // <- Remove in 1.5
          $field->EventHandler()->OnItemLoad($mod);
        } // end of foreach
      } // end of count

			Events::SendEvent($mod->GetName(), 'PostItemLoad', array('item_object' => &$obj));

			return TRUE;
		}

		return FALSE;
	}
  
  /**
   * @param \LISEItem $obj
   *
   * @return \LISEItem
   */
	public static function Copy(LISEItem $obj) : \LISEItem
  {
    $obj                = clone $obj;
    $obj->item_id       = NULL;
    //$obj->alias         = NULL;
    $obj->position      = -1;
    $obj->create_time   = '';
    $obj->modified_time = '';
    $obj->key1          = NULL;
    $obj->key2          = NULL;
    $obj->key3          = NULL;
    $obj->url           = NULL;
    $obj->owner         = NULL;
	
		return $obj;
	}
  
  /**
   * @param \LISE  $mod
   * @param string $identifier
   * @param int    $flags
   *
   * @return array
   * @throws \Exception
   */
  public static function GetIdentifier(LISE $mod, $identifier = 'item_id', $flags = self::IDENT_INC_DEFAULT)
  {
  
    $query = 'SELECT title, '
             . $identifier
             . ' FROM '
             . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item ';
    
    switch ($flags)
    {
      case self::IDENT_INC_DEFAULT:
      case self::IDENT_INC_ACTIVE:
            $query .= ' WHERE active = 1';
          break;
          
      case self::IDENT_INC_INACTIVE:
            $query .= ' WHERE active = 0';
          break;
      
      # all
      case (self::IDENT_INC_INACTIVE || self::IDENT_INC_ACTIVE):
          break;
    }
  
    $query .= ' ORDER BY position';
    
    
    
    //$query = "SELECT title, $identifier FROM " . cms_db_prefix() . "module_" . $mod->_GetModuleAlias() . "_item WHERE active = 1 ORDER BY position";
    $dbr = cmsms()->GetDb()->Execute($query);
    

    
    $ret = array();
    while($dbr && !$dbr->EOF) {
    
      $ret[$dbr->fields[$identifier]] = $dbr->fields['title'];  
      $dbr->MoveNext();
    }
    
    if($dbr) $dbr->Close();
    
    return $ret;
  }
  
  /**
   * @param       $Search
   * @param \LISE $mod
   *
   * @throws \Exception
   */
  public static function reindex_search($Search, LISE $mod) : void
  {
    if( !$mod->GetPreference('reindex_search', 0) ) return;
        
    if(!is_object($Search)) return;
  
    $params        = [];
    $item_query    = $mod->GetItemQuery($params);
    $item_query->AppendTo(LISEQuery::VARTYPE_WHERE, 'A.active = 1');
    $result        = $item_query->Execute(TRUE);
    $items         = [];
    $allowed_types = ['TextInput', 'TextArea'];
  
    while($result && $row = $result->FetchRow()) 
    {
      $words = $row['title'];
      $item  = $mod->InitiateItem();
      self::Load($mod, $item, $row);  
      $obj   = clone $item;
      
      foreach($obj->fielddefs as $one)
      {
        if( !in_array($one->GetType(), $allowed_types) ) continue;
        if( !$one->GetOptionValue('search_index') ) continue;
        $words .= ' ' . $one->GetValue('string'); 
      }
      
      $Search->AddWords( $mod->GetName(), $row['item_id'], $mod->GetPreference('item_singular', 'item'), $words );
    }             
  }
  
  /**
   * @param       $Search
   * @param \LISE $mod
   */
  public static function remove_index_search($Search, LISE $mod) : void
  {
    if(!is_object($Search)) return;
  
    $params     = [];
    $item_query = $mod->GetItemQuery($params);
    $item_query->AppendTo(LISEQuery::VARTYPE_WHERE, 'A.active = 1');
    $result     = $item_query->Execute(true);

    while($result && $row = $result->FetchRow()) 
    {
      $Search->DeleteWords($mod->GetName(), $row['item_id'], $mod->GetPreference('item_singular', 'item'));
    }    
  }
  
  /**
   * @param       $current_id
   * @param \LISE $mod
   *
   * @return bool|mixed
   * @throws \Exception
   */
  public static function current_position($current_id, \LISE $mod)
  {
    $table_name = cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item';
    
    $query = 'SELECT position FROM '
             . $table_name
             . ' WHERE item_id=?';
    
    return cmsms()->GetDb()->GetOne($query, [$current_id]);
  }
  
  /**
   * @param       $current_id
   * @param \LISE $mod
   * @param bool  $by_position
   *
   * @return bool|mixed
   * @throws \Exception
   */
  public static function next_from_current($current_id, \LISE $mod, $by_position = TRUE)
  {
    $table_name   = cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item';
    $sub_q_by_id  = '(SELECT min(item_id) FROM ' . $table_name . ' WHERE item_id > ?)';
    $sub_q_by_pos = '(SELECT min(item_id) FROM ' . $table_name . ' WHERE position > ?)';
    
    $query = 'SELECT item_id FROM '
             . $table_name
             . ' WHERE item_id = ';
    
    if($by_position)
    {
      $query .= $sub_q_by_pos;
      $pos =  self::current_position($current_id, $mod);
      
//      $r = cmsms()->GetDb()->GetOne($query, [$pos]);
//      $error =  cmsms()->GetDb()->ErrorMsg();
      
      return cmsms()->GetDb()->GetOne($query, [$pos]);
    }
  
    $query .= $sub_q_by_id;
    
    return cmsms()->GetDb()->GetOne($query, [$current_id]);
    
  }
  
  /**
   * @param       $current_id
   * @param \LISE $mod
   * @param bool  $by_position
   *
   * @return bool|mixed
   * @throws \Exception
   */
  public static function previous_from_current($current_id, \LISE $mod, $by_position = TRUE, $params = [])
  {
    $table_name   = cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item';
    $q = new \LISE\Query( 'item', $mod->_GetModuleAlias(), cms_db_prefix() );
    
    $sub_q_by_id  = '(SELECT max(item_id) FROM ' . $table_name . ' WHERE item_id < ?)';
    $sub_q_by_pos = '(SELECT max(item_id) FROM ' . $table_name . ' WHERE position < ?)';
    
    $query = 'SELECT item_id FROM '
             . $table_name
             . ' WHERE item_id = ';
    
    if($by_position)
    {
      $query .= $sub_q_by_pos;
      $pos   = self::current_position($current_id, $mod);
      
      return cmsms()->GetDb()->GetOne($query, [$pos]);
    }
  
    $query .= $sub_q_by_id;
  
    return cmsms()->GetDb()->GetOne($query, [$current_id]);
    
  }
  
  /**
   * @param null   $mod
   * @param int    $id
   * @param string $alias
   *
   * @return bool
   * @throws \Exception
   */
  public static function is_duplicate($mod = NULL, $id = -1, $alias = '') : bool
  {
    if(empty($mod) || $id < 1) return FALSE; # TODO should throw exception
    if( !is_a($mod, \LISEInstance::class) ) return FALSE; # TODO should throw exception
    
    $tn = \cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item';
    $p = [];
  
    $q = 'SELECT item_id FROM '
         . $tn
         . ' WHERE alias = ?';
  
    $p[] = $alias;
    
    if ($id > 0)
    {
      $q .= ' AND item_id != ?';
  
      $p[] = $id;
      
      $r = api::DB()->GetOne($q, $p);
    }
    else
    {
      $r = api::DB()->GetOne($q, $p);
    }
    
    return (bool)$r;
  }
  
  /**
   * @param null $mod
   * @param int  $id
   *
   * @return bool
   * @throws \Exception
   */
  public static function is_duplicate_id($mod = NULL, $id = -1)
  {
    if(empty($mod) || $id < 1) return FALSE; # TODO should throw exception
    if( !is_a($mod, \LISEInstance::class) ) return FALSE; # TODO should throw exception
  
    $tn = \cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item';
    $p = [$id];
  
    $q = 'SELECT item_id FROM '
         . $tn
         . ' WHERE item_id = ?';
    
    return (bool)api::DB()->GetOne($q, $p);
  }
  
  /**
   * @param null   $mod
   * @param string $alias
   *
   * @return bool
   * @throws \Exception
   */
  public static function is_duplicate_alias($mod = NULL, $alias = '') : bool
  {
    if( empty($mod) || empty($alias) ) return FALSE; # TODO should throw exception
    if( !is_a($mod, \LISEInstance::class) ) return FALSE; # TODO should throw exception
    
    
    $tn = \cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item';
    $p = [$alias];
    
    $q = 'SELECT item_id FROM '
         . $tn
         . ' WHERE alias = ?';
  
    return (bool)api::DB()->GetOne($q, $p);
  }
	
} // end of class
?>