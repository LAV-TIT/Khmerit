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
use LISE\Query;

/**
 * Class LISEItemQuery
 */
class LISEItemQuery extends LISEQuery
{
  #---------------------
  # Attributes
  #---------------------
  
  /**
   * @var string[]
   */
  private static array $orderby_map = [
    // items
    'item_id'            => 'A.item_id',
    'item_title'         => 'A.title',
    'item_position'      => 'A.position',
    'item_created'       => 'A.create_time',
    'item_modified'      => 'A.modified_time',
    'item_start'         => 'A.start_time',
    'item_end'           => 'A.end_time',
    
    // category
    'category_id'        => 'B.category_id',
    'category_name'      => 'B.category_name',
    'category_hierarchy' => 'B.hierarchy',
    'category_position'  => 'B.position',
    // <- Not necessarily valid, if JOIN to category table is not made, check this.
    
    // functions
    'rand'               => 'RAND()'
  ];
  
  #---------------------
  # Query methods
  #---------------------
  
  /**
   * @throws \LISE\Exception
   */
  private function _append_internal() : void
  {
    if( isset($this->query) ) { return; }
  
    $db        = $this->GetDb();
    $mod       = $this->GetModuleInstance();
    $params    = $this->GetParams();
    $operators = ['=', 'LIKE'];
    $array     = [];
    $str       = '';
  
    /*
     * ORDER BY
     */
    if( isset($params['orderby']) )
    {
      // Always returning two arrays
      [$order_cols, $custom_cols] = self::explode_orderby($params['orderby'], self::$orderby_map);
      
      // Handle custom_* orderby stuff
      if(!empty($custom_cols))
      {
        foreach($custom_cols as $index => $obj)
        {
          $onedef = LISEFielddefOperations::Load($mod, 'alias', $obj->name);
          
          if($onedef)
          {
            $as = 'VAL' . $onedef->GetId();
            
            $this->AppendTo(
              parent::VARTYPE_JOINS,
              'LEFT JOIN '
              . $this->_mod_alias()
              . '_fieldval '
              . $as
              . ' ON A.item_id = '
              . $as
              . '.item_id'
            );
            
            $this->AppendTo(
              parent::VARTYPE_WHERE,
              $as
              . '.fielddef_id = '
              . $db->qstr( $onedef->GetId() )
            );
            
            $order_cols[$index] = $as . '.value ' . $obj->order;
          }
        }
        
        ksort($order_cols);
      }
      
      if(count($order_cols))
      {
        foreach($order_cols as $one)
        {
          $this->AppendTo(parent::VARTYPE_ORDERBY, $one);
        }
      }
      
    } // end of orderby;
    
    /*
     * INCLUDE/EXCLUDE ITEMS
     */
    if( !empty($params['include_items']) || !empty($params['exclude_items']) )
    {
      if( !empty($params['include_items']) )
      {
        $array = explode(',', $params['include_items']);
        $str = '(';
      }
      
      if( !empty($params['exclude_items']) )
      {
        $array = explode(',', $params['exclude_items']);
        $str = 'NOT (';
      }
      
      $count = 0;
      
      foreach ($array as $alias)
      {
        if($count > 0) { $str .= ' OR '; }
        
        // this is tricky: depends on alias never being numeric... may need an alternative
        $str .=  is_numeric($alias) ? ' A.item_id = \'' . $alias . '\'' : ' A.alias = \'' . $alias . '\'';
        $count++;
      }
      
      $str .= ')';
      
      $this->AppendTo(parent::VARTYPE_WHERE, $str);
      
    } // end of include items;
    
    /*
     * INCLUDE/EXCLUDE CATEGORY
     */
    if(!empty($params['category']) || !empty($params['exclude_category']))
    {
      if(!empty($params['category']))
      {
        $array = explode(',', $params['category']);
        $str = '(';
      }
      
      if(!empty($params['exclude_category']))
      {
        $array = explode(',', $params['exclude_category']);
        $str = '(B.category_alias IS NULL OR NOT (' ;
      }
      
      $count = 0;
      foreach ($array as $cat)
      {
        if ($count > 0) { $str .= ' OR '; }
        
        $str .= " B.category_alias = '" . $cat . "'";
        
        if ((isset($params['subcategory']) && $params['subcategory']) || $mod->GetPreference('subcategory'))
        {
          $this->_get_subcategories($str, $cat);
        }
        
        $count++;
      }
      
      $str .= ')';
      
      if(!empty($params['exclude_category']))
      {
        $str .= ')';
      }
      
      $this->AppendTo(parent::VARTYPE_WHERE, $str);
      
    } // end of category;
    
    /*
     * SEARCH
     */
    if(!empty($params['search']))
    {
      $str      = $params['search'];
      $operator = $params['srchop'] ?? 'LIKE';
      $operator = strtoupper( trim($operator) );
      $operator = in_array($operator, $operators) ? $operator : '=';
      
      $this->AppendTo(
        parent::VARTYPE_WHERE,
        '(A.title ' . $operator . ' ? OR A.item_id IN (SELECT C.item_id FROM '
        . $this->_mod_alias() . '_fieldval C WHERE C.value ' . $operator . ' ?))'
      );
      
      if($operator === 'LIKE')
      {
        $this->AppendTo(parent::VARTYPE_QPARAMS, '%'.trim($str).'%');
        $this->AppendTo(parent::VARTYPE_QPARAMS, '%'.trim($str).'%');
      }
      else
      {
        $this->AppendTo(parent::VARTYPE_QPARAMS, trim($str));
        $this->AppendTo(parent::VARTYPE_QPARAMS, trim($str));
      }
      
    } // end of search
    
    /*
     * FILTER: MONTH & YEAR
     */
    
    # old method deprecated
    $oldfilterused = FALSE;
    
    if(
      !empty($params['filter_month'])
      || !empty($params['filter_year'])
    )
    {
      $oldfilterused = TRUE;
      $year = !empty($params['filter_year']) ? (int)$params['filter_year'] : date('Y');
      
      $start_month = !empty($params['filter_month']) ? (int)$params['filter_month'] : 1;
      $end_month = !empty($params['filter_month']) ? (int)$params['filter_month'] : 12;
      
      $start_day = 1;
      $end_day = !empty($params['filter_month']) ? date( 't', mktime(0, 0, 0, $start_month, $start_day, $year) ) : 31;
      
      $timestamp1 = mktime(0, 0, 0, $start_month, $start_day, $year);
      $timestamp1 = $db->DbTimeStamp($timestamp1);
      
      $timestamp2 = mktime(23, 59, 0, $end_month, $end_day, $year);
      $timestamp2 = $db->DbTimeStamp($timestamp2);
      
      $this->AppendTo(parent::VARTYPE_WHERE, "(A.create_time BETWEEN $timestamp1 AND $timestamp2)");
      
    } // end of filter_year
    
    /*
     * FILTER: MONTH & YEAR -> NEW METHOD
     */
    
    if(!$oldfilterused) # this check will be removed with the deprecated code above removal
    {
      if(
        !empty($params['xf_startday'])
        || !empty($params['xf_startmonth'])
        || !empty($params['xf_startyear'])
        || !empty($params['xf_endday'])
        || !empty($params['xf_endmonth'])
        || !empty($params['xf_endyear'])
      )
      {
        $start_year = !empty($params['xf_startyear']) ? (int)$params['xf_startyear'] : date('Y');
        $end_year = !empty($params['xf_endyear']) ? (int)$params['xf_endyear'] : date('Y');
        
        $start_month = !empty($params['xf_startmonth']) ? (int)$params['xf_startmonth'] :  date('m');
        $end_month = !empty($params['xf_endmonth']) ? (int)$params['xf_endmonth'] : date('m');
        
        $start_day = !empty($params['xf_startday']) ? (int)$params['xf_startday'] :  date('d');
        $end_day = !empty($params['xf_endday']) ? (int)$params['xf_endday'] : date('d');
        
        $starttime = mktime(0, 0, 0, $start_month, $start_day, $start_year);
        $timestamp1 = $db->DbTimeStamp($starttime);
        
        $endtime = mktime(23, 59, 59, $end_month, $end_day, $end_year);
        $timestamp2 = $db->DbTimeStamp($endtime);
        
        $this->AppendTo(parent::VARTYPE_WHERE, "(A.create_time BETWEEN $timestamp1 AND $timestamp2)");
      }
    }
    
    /*
     * TIME CONTROL
     */
    if(!isset($params['showall']))
    {
      $this->AppendTo(
        parent::VARTYPE_WHERE,
        '(start_time IS NULL OR TIMESTAMPDIFF(DAY, CURDATE(), start_time) <= 0)
                      AND (end_time IS NULL OR TIMESTAMPDIFF(DAY, end_time, CURDATE()) <= 0)'
      );
    }
    
    /*
     * SEARCH_*
     * Old method: deprecated
     */
    $oldsearchused = FALSE;
    $search_clause = "A.item_id IN
							       (SELECT C.item_id FROM "
                     . $this->_mod_alias() . "_fieldval C, "
                     . $this->_mod_alias() . "_fielddef D
                      WHERE C.fielddef_id = D.fielddef_id
                      AND D.alias = ?";
    
    $fielddefs     = $mod->GetFieldDefs();
    
    foreach($fielddefs as $fielddef)
    {
      if( !empty($params['search_' . $fielddef->GetAlias()]) )
      {
        $oldsearchused = TRUE;
        $thisparam = $params['search_' . $fielddef->GetAlias()];
        $this->AppendTo(parent::VARTYPE_QPARAMS, $fielddef->GetAlias());
        
        $thisor = array();
        
        foreach((array)$thisparam as $thisvalue)
        {
          $thisor[] = 'C.value = ?';
          $this->AppendTo(parent::VARTYPE_QPARAMS, $thisvalue);
        }
        
        $this->AppendTo(
          parent::VARTYPE_WHERE,
          $search_clause
          . ' AND '
          . implode(' OR ', $thisor) . ')'
        );
      }
    }
    
    /*
     * xs_* replaces SEARCH_**
     *
     * extra params to do with ranges
     * xsrstart_
     * xsrend_
     * xsrmode_
     */
    if(!$oldsearchused) # this check will be removed with the deprecated code above removal
    {
      $modes = array('inc', 'exc');
      
      // handle alias and or title
  
      $search_cols = ['title', 'alias'];
  
      foreach($search_cols as $one_col)
      {
        $search_clause = 'A.item_id IN
            (SELECT item_id FROM ' . cms_db_prefix() . 'module_' . $mod->_GetModuleAlias() . '_item
                WHERE ';
        
        if( !empty($params['xsrstart_' . $one_col]) || !empty($params['xsrend_' . $one_col]) )
        {
          $range_start = $params['xsrstart_' . $one_col] ?? NULL;
          $range_end   = $params['xsrend_' . $one_col] ?? NULL;
          $thismode    = $params['xsrmode_' . $one_col] ?? 'inc';
          $thismode    = in_array($thismode, $operators, TRUE) ? $modes : 'inc';
          $_i          = 'xsio_' . $one_col;
          $thisio      = isset($params[$_i]) ? strtolower($params[$_i]) : 'i';
          
          if($thismode === 'inc')
          {
            if( !is_null($range_start) &&  !is_null($range_end) )
            {
              $not = ($thisio === 'o') ? : '';
              $where_str = $one_col . ' ' .  $not . ' BETWEEN ? AND ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_start);
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_end);
            }
            else if(!is_null($range_start))
            {
              $op = ($thisio === 'i') ? '>=' : '<';
              $where_str = $one_col . ' ' . $op . ' ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_start);
            }
            else if(!is_null($range_end))
            {
              $op = ($thisio === 'i') ? '<=' : '>';
              $where_str = $one_col . ' ' . $op . ' ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_end);
            }
          }
          else if($thismode === 'exc')
          {
            if( !is_null($range_start) &&  !is_null($range_end) )
            {
              $not = ($thisio === 'o') ? : '';
      
              if($not)
              {
                $where_str = 'NOT ( ' . $one_col . ' > ? AND  ' . $one_col . ' < ?)';
              }
              else
              {
                $where_str = $one_col . ' > ? AND ' . $one_col . ' < ?';
              }
      
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_start);
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_end);
            }
            else if(!is_null($range_start))
            {
              $op = ($thisio === 'i') ? '>' : '<=';
              $where_str = $one_col . ' ' . $op . ' ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_start);
            }
            else if(!is_null($range_end))
            {
              $op = ($thisio === 'i') ? '<' : '>=';
              $where_str = $one_col . ' ' . $op . ' ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_end);
            }
          }
  
          $this->AppendTo(parent::VARTYPE_WHERE, $search_clause . $where_str .  ')');
        }
        else // no ranges
        {
          $thisoperator = $params['xso_' . $one_col] ?? 'LIKE';
          $thisoperator = strtoupper(trim($thisoperator));
          $thisoperator = in_array($thisoperator, $operators) ? $thisoperator : '=';
          
          if(!empty($params['xs_' . $one_col]))
          {
            $thisparam = $params['xs_' . $one_col];
            $where_str = $one_col . ' ' . $thisoperator . ' ?';
  
            if($thisoperator === 'LIKE')
            {
              $this->AppendTo(parent::VARTYPE_QPARAMS, '%' . trim($thisparam) . '%');
            }
            else
            {
              $this->AppendTo(parent::VARTYPE_QPARAMS, trim($thisparam));
            }
  
            $this->AppendTo(parent::VARTYPE_WHERE, $search_clause . $where_str .  ')');
          }
        }
      }
  
      // handle fielddefs
      $search_clause = "A.item_id IN
							       (SELECT C.item_id FROM "
                       . $this->_mod_alias() . "_fieldval C, "
                       . $this->_mod_alias() . "_fielddef D
                      WHERE C.fielddef_id = D.fielddef_id
                      AND D.alias = ?";
      
      $fielddefs = $mod->GetFieldDefs();
      
      foreach($fielddefs as $fielddef)
      {
        $s   = 'xsrstart_' . $fielddef->GetAlias();
        $e   = 'xsrend_' . $fielddef->GetAlias();
        $m   = 'xsrmode_' . $fielddef->GetAlias();
        $io  = 'xsio_' . $fielddef->GetAlias();
        
        if( !empty($params[$s]) || !empty($params[$e]) )
        {
          $this->AppendTo( parent::VARTYPE_QPARAMS, $fielddef->GetAlias() );
          $thisor      = [];
          $range_start = $params[$s] ?? NULL;
          $range_end   = $params[$e] ?? NULL;
          $thismode    = $params[$m] ?? 'inc';
          $thismode    = in_array($thismode, $operators, FALSE) ? $modes : 'inc';
          $thisio      = isset($params[$io]) ? strtolower($params[$io]) : 'i';
          
          if($thismode === 'inc')
          {
            if( !is_null($range_start) &&  !is_null($range_end) )
            {
              $not = ($thisio === 'o') ? : '';
              $thisor[] = 'C.value ' . $not . ' BETWEEN ? AND ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_start);
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_end);
            }
            else if(!is_null($range_start))
            {
              $op = ($thisio === 'i') ? '>=' : '<';
              $thisor[] = 'C.value ' . $op . ' ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_start);
            }
            else if(!is_null($range_end))
            {
              $op = ($thisio === 'i') ? '<=' : '>';
              $thisor[] = 'C.value ' . $op . ' ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_end);
            }
          }
          else if($thismode === 'exc')
          {
            if( !is_null($range_start) &&  !is_null($range_end) )
            {
              $not = ($thisio === 'o') ? : '';
              
              if($not)
              {
                $thisor[] = 'NOT (C.value > ? AND C.value < ?)';
              }
              else
              {
                $thisor[] = 'C.value > ? AND C.value < ?';
              }
              
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_start);
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_end);
            }
            else if(!is_null($range_start))
            {
              $op = ($thisio === 'i') ? '>' : '<=';
              $thisor[] = 'C.value ' . $op . ' ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_start);
            }
            else if(!is_null($range_end))
            {
              $op = ($thisio === 'i') ? '<' : '>=';
              $thisor[] = 'C.value ' . $op . ' ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $range_end);
            }
          }
          
          $this->AppendTo(
            parent::VARTYPE_WHERE,
            $search_clause
            . ' AND '
            . implode(' OR ', $thisor) . ')'
          );
          
        }
        else
        {
          
          if( !empty($params['xs_' . $fielddef->GetAlias()]) )
          {
            $this->AppendTo( parent::VARTYPE_QPARAMS, $fielddef->GetAlias() );
            $thisor       = [];
            $thisparam    = $params['xs_' . $fielddef->GetAlias()];
            $thisoperator = $params['xso_' . $fielddef->GetAlias()] ?? '=';
            $thisoperator = strtoupper(trim($thisoperator));
            $thisoperator = in_array($thisoperator, $operators) ? $thisoperator : '=';
  
            foreach( (array)$thisparam as $thisvalue )
            {
              $thisor[] = 'C.value ' . $thisoperator . ' ?';
              $this->AppendTo(parent::VARTYPE_QPARAMS, $thisvalue);
            }
    
            $this->AppendTo(parent::VARTYPE_WHERE, $search_clause . ' AND ' . implode(' OR ', $thisor) . ')');
          }
        }
      }
    }
  }
  
  /**
   * @throws \LISE\Exception
   * @throws \Exception
   */
  protected function _query() : void
  {
    $db          = $this->GetDb();
    $mod         = $this->GetModuleInstance();
    $params      = $this->GetParams();
    //$order_cols  = []; # not used here?
    //$custom_cols = []; # not used here?
  
    $this->_append_internal();
    
    // Init query
    $this->query = 'SELECT A.* FROM '
                   . $this->_mod_alias()
                   . '_item A LEFT JOIN '
                   . $this->_mod_alias()
                   . '_item_categories IB ON A.item_id = IB.item_id LEFT JOIN '
                   . $this->_mod_alias()
                   . '_category B	ON IB.category_id = B.category_id ';
    
    // Merge everything to one query
    if( count($this->joins) )
    {
      $this->query .= implode(' ', $this->joins);
    }
    
    if(count($this->where))
    {
      $this->query .= ' WHERE ' . implode(' AND ', $this->where);
    }
    
    $this->query .= ' GROUP BY A.item_id ';
    
    if(count($this->orderby))
    {
      $this->query .= ' ORDER BY ' . implode(', ', $this->orderby);
    }
    else
    {
      $this->query .= ' ORDER BY A.position ' . $mod->GetPreference('sortorder');
    }
    
    // Init params necessary to execution
    $pagenumber = $this->GetPageNumber();
    $pagelimit  = $this->GetPageLimit();
    
    # final filter (TODO: revisit... it should never be 0 or null getting here)
    $pagelimit = $pagelimit < 1 ? 100000 : $pagelimit;
    
    $startelement = ($pagenumber - 1) * $pagelimit;
    
    $res = $db->GetArray($this->query, $this->qparams);
    
    if( $res !== FALSE && is_array($res) )
    {
      $this->totalcount = count($res);
    }
    else
    {
      $this->totalcount = 0;
    }
    
    if(isset($params['start']))
    {
      $this->totalcount -= (int)$params['start'];
      $startelement     += (int)$params['start'];
    }
    
    $this->pagecount = (int)($this->totalcount / $pagelimit);
    
    if( 0 !== ($this->totalcount % $pagelimit) ) { $this->pagecount++; }
    
    $this->resultset = $db->SelectLimit($this->query, $pagelimit, $startelement, $this->qparams);
    
    # still in tests - not working as expected yet!
//    $q = new Query();
//    $this->resultset = $q->SQL($this->query)
//                          ->Set($this->qparams)
//                          ->Run($pagelimit, $startelement);
  }
  
  #---------------------
  # Class methods
  #---------------------
  
  /**
   * @param $param
   * @param $valid_cols
   *
   * @return array|array[]
   */
  private static function explode_orderby($param, $valid_cols) : array
  {
    $order_cols  = [];
    $custom_cols = [];
    $index       = 0;
    
    foreach(explode(',', $param) as $col)
    {
      $col       = trim($col);
      $col_parts = explode('|', $col);
  
      // column name
      $col_name  = $col_parts[0];
      $col_order = 'ASC';
  
      // order column ascending or descending
      if(isset($col_parts[1]))
      {
        $col_order = (in_array($col_parts[1], ['ASC', 'DESC']) ? $col_parts[1] : 'ASC');
      }
  
      $col_order = (in_array($col_order, ['ASC', 'DESC']) ? $col_order : 'ASC');
  
      if(isset($valid_cols[$col_name]))
      {
        $order_cols[$index] = $valid_cols[$col_name] . ' ' . $col_order;
      }
      else if(startswith($col_name, 'custom_'))
      {
        $custom_name = substr($col_name, 7);
        $obj         = new stdClass;
        $obj->name   = $custom_name;
        $obj->order  = $col_order;
    
        $custom_cols[$index] = $obj;
      }
  
      $index++;
    }
  
    return [$order_cols, $custom_cols];
  }
  
  /**
   * @param $str
   * @param $alias
   *
   * @return bool
   * @throws \Exception
   */
  private function _get_subcategories(&$str, $alias) : bool
  {
    $db = $this->GetDb();
    
    $query = "SELECT category_id FROM "
             . $this->_mod_alias() . "_category WHERE category_alias = ?";
    $subcat = $db->GetOne($query, array($alias));
    
    if(!$subcat) { return FALSE; }
    
    $str .= " OR B.parent_id = '" . $subcat . "'";
    
    $query = "SELECT category_alias FROM "
             . $this->_mod_alias() . "_category WHERE parent_id = ?";
    $dbr = $db->Execute($query, array($subcat));
    
    while($dbr && !$dbr->EOF)
    {
      $this->_get_subcategories($str, $dbr->fields['category_alias']);
      $dbr->MoveNext();
    }
    
    if($dbr) { $dbr->Close(); }
    
    return TRUE;
  }
  
} // end of class

?>