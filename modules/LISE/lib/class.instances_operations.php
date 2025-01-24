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
namespace LISE;
final class instances_operations
{
  private static array $_instances       = [];
  private static array $_instances_names = [];
  
  /**
   * @throws \Exception
   */
  private static function _load_instances() : void
  {
    if( empty(self::$_instances) )
    {
      $db = \cmsms()->GetDb();
      $query = 'SELECT * FROM ' . cms_db_prefix() . 'module_lise_instances ORDER BY module_id';
      $dbr = $db->GetAll($query);
      
      foreach($dbr as $one)
      {
        self::$_instances_names[ $one['module_id'] ] = $one['module_name'];
        self::$_instances[ $one['module_id'] ] =  new \stdClass();
        self::$_instances[ $one['module_id'] ]->module_id = $one['module_id'];
        self::$_instances[ $one['module_id'] ]->module_name = $one['module_name'];
        self::$_instances[ $one['module_id'] ]->module_mode = isset($one['module_mode']) ? $one['module_mode'] : \LISE::MODE_LIST;
      }
    }
  }
  
  /**
   * @return array
   * @throws \Exception
   */
  public static function GetInstancesNamesListArray() : array
  {
    self::_load_instances();
    return self::$_instances_names;
  }
  
  /**
   * @param null $mode
   *
   * @return array
   * @throws \Exception
   */
  public static function ListModules($mode = NULL) : array
  {
    # NULL is all instances otherwise $mode must be valid
    if(NULL != $mode && !\in_array($mode, \LISE::$modes, FALSE) )
    {
      throw new \RuntimeException('Invalid LISE operation mode');
    }
    
    self::_load_instances();
    
    if(NULL != $mode)
    {
      $r = [];
      foreach(self::$_instances as $one)
      {
        if($one->module_mode == $mode)
        {
          $r[$one->module_id] = $one;
        }
        
        if( $mode == \LISE::MODE_LIST && NULL == $one->module_mode)
        {
          $r[$one->module_id] = $one;
        }
      }
      
      return $r;
    }
    
    return self::$_instances;
  }
  
}
?>
