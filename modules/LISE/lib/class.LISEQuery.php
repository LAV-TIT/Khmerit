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
use \LISE\ConfigManager as ConfigManager;

/**
 * Class LISEQuery
 * @deprecated
 */
abstract class LISEQuery
{
  #---------------------
  # Constants
  #---------------------
  
  /**
   *
   */
  public const VARTYPE_JOINS = 'joins';
  /**
   *
   */
  public const VARTYPE_WHERE = 'where';
  /**
   *
   */
  public const VARTYPE_ORDERBY = 'orderby';
  /**
   *
   */
  public const VARTYPE_QPARAMS = 'qparams';
  
  #---------------------
  # Attributes
  #---------------------
  
  /**
   * @var array
   */
  private $_params;
  /**
   * @var string
   */
  private $_instance_name;
  
  /**
   * @var array
   */
  protected $joins;
  /**
   * @var array
   */
  protected $where;
  /**
   * @var array
   */
  protected $orderby;
  /**
   * @var array
   */
  protected $qparams;
  
  /**
   * @var
   */
  protected $query;         // Not set
  /**
   * @var
   */
  protected $resultset;     // Not set
  /**
   * @var
   */
  protected $totalcount;    // Not set
  /**
   * @var
   */
  protected $pagecount;     // Not set
  
  #---------------------
  # Magic methods
  #---------------------
  
  /**
   * LISEQuery constructor.
   *
   * @param \LISE $mod
   * @param       $params
   */
  public function __construct(LISE $mod, &$params)
  {
    $this->_instance_name = $mod->GetName();
    $this->_params        = $params;
    $this->joins          = [];
    $this->where          = [];
    $this->orderby        = [];
    $this->qparams        = [];
  }
  
  #---------------------
  # Abstract methods
  #---------------------
  
  /**
   * @return void
   */
  abstract protected function _query() : void ;
  
  #---------------------
  # Utility methods
  #---------------------
  
  /**
   * @return string
   */
  protected function _mod_alias()
  {
    return cms_db_prefix() . 'module_' . $this->GetModuleInstance()->_GetModuleAlias();
  }
  
  /**
   * @return \CMSMS\Database\Connection
   * @throws \Exception
   */
  protected function GetDb() : \CMSMS\Database\Connection
  {
    return \cms_utils::get_db();
  }
  
  /**
   * @return string
   */
  public function GetModuleInstanceName() : string
  {
    return $this->_instance_name;
  }
  
  /**
   * @return \CmsModule
   */
  public function GetModuleInstance() : \CmsModule
  {
    return \cms_utils::get_module($this->_instance_name);
  }
  
  /**
   * @return array
   */
  public function GetParams() : array
  {
    return $this->_params;
  }
  
  /**
   * @param $key
   * @param $value
   */
  public function SetParam($key, $value) : void
  {
    $this->_params[$key] = $value;
  }
  
  /**
   * @param $key
   *
   * @return mixed|null
   */
  public function GetParam($key)
  {
    return $this->_params[$key] ?? NULL;
  }
  
  #---------------------
  # Database methods
  #---------------------
  
  /**
   * @param $var
   * @param $value
   *
   * @return bool
   * @throws \LISE\Exception
   */
  public function AppendTo($var, $value) : bool
  {
    $var = strtolower($var);
    $value = (string)$value;
    
    switch($var) {
      
      case self::VARTYPE_JOINS:
        $this->joins[] = $value;
      break;
      
      case self::VARTYPE_WHERE:
        $this->where[] = $value;
      break;
      
      case self::VARTYPE_ORDERBY:
        $this->orderby[] = $value;
      break;
      
      case self::VARTYPE_QPARAMS:
        $this->qparams[] = $value;
      break;
      
      default:
        throw new \LISE\Exception('Attempt to set unidentified VARTYPE');
    }
    
    return true;
  }
  
  /**
   * @param bool $force_execute
   *
   * @return mixed
   */
  public function Execute($force_execute = false)
  {
    if(!isset($this->resultset) || $force_execute) { $this->_query(); }
    
    return $this->resultset;
  }
  
  /**
   * @return null
   */
  public function TotalCount()
  {
    return $this->totalcount ?? NULL;
  }
  
  /**
   * @return null
   */
  public function GetPageCount()
  {
    return $this->pagecount ?? NULL;
  }
  
  /**
   * @return int|mixed
   */
  public function GetPageLimit()
  {
    if( isset($this->_params['pagelimit']) )
    {
      return (int)$this->_params['pagelimit'];
    }
  
    $config     = ConfigManager::GetConfigInstance(\cms_utils::get_module('LISE'));
    $page_limit = $config['global_LISEQuery_page_limit'] ?? 100000;
    $config     = ConfigManager::GetConfigInstance($this->GetModuleInstance());
    $page_limit = $config['LISEQuery_page_limit'] ?? $page_limit;
    
    return $page_limit;
  }
  
  /**
   * @return int
   */
  public function GetPageNumber() : int
  {
    if( isset($this->_params['pagenumber']) )
    {
      return (int)$this->_params['pagenumber'];
    }
    
    if( isset($this->_params['page']) )
    {
      return (int)$this->_params['page'];
    }
    
    return 1;
  }
  
} // end of class

?>