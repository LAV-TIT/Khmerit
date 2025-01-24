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
use LISE\api;
class lisefd_LISEInstanceItem extends LISEFielddefBase
{
  
	public function __construct($db_info, $caller_object) 
	{	
		parent::__construct($db_info, $caller_object);
		$this->SetFriendlyType( $this->ModLang( 'fielddef_' . $this->GetType() ) );
	}

	public function RenderInput($id, $returnid)
	{
		$type = $this->GetOptionValue('subtype', 'Dropdown');
		$obj = LISEFielddefOperations::LoadFielddefByType( $type, \cms_utils::get_module($this->caller) );

		if(is_object($obj))
			return $obj->RenderInput($id, $returnid);
			
		return false;
	}

	public function GetOptions()
	{
    $instance = $this->GetOptionValue('instance');
    $identifier = $this->GetOptionValue('identifier', 'item_id');
    $include_flags = $this->GetOptionValue('include_items', 0);
    
    $mod = cmsms()->GetModuleInstance($instance);
    
    if( is_object($mod))
    {
      $this->options = LISEItemOperations::GetIdentifier($mod, $identifier, $include_flags);
    }
    else
    {
      $this->options = [];
    }
    
    return $this->options;
	}

	public function Instances()
	{
    $instances = api::GetInstancesList(LISE::MODE_LIST);
		
		$output = array();
		foreach($instances as $instance) 
    {	
			$output[$instance->module_name] = $instance->module_name;
		}
	
		return $output;
	}
	
	public function IncludeItems()
  {
    $mod = cmsms()->GetModuleInstance(LISE);
    return array(
                  0 => $mod->ModLang('ii_option_include_default'),
                  1 => $mod->ModLang('ii_option_include_only_active'),
                  2 => $mod->ModLang('ii_option_include_only_inactive'),
                  3 => $mod->ModLang('ii_option_include_all')
    );
  }

	public function SubTypes()
	{
    $mod = cmsms()->GetModuleInstance(LISE);
    
    return array(
                  'Dropdown'          => $mod->ModLang('fielddef_Dropdown'),
                  'MultiSelect'       => $mod->ModLang('fielddef_MultiSelect'),
                  'RadioGroup'        => $mod->ModLang('fielddef_RadioGroup'),
                  'CheckboxGroup'     => $mod->ModLang('fielddef_CheckboxGroup'),
                  'JQueryMultiSelect' => $mod->ModLang('fielddef_JQueryMultiSelect')
                );
	}
	
	public function Identifiers()
	{
        return array(
                      'item_id' => 'item_id',
                      'alias'   => 'alias',
                      'title'   => 'title',
                      'key1'    => 'key1',
                      'key2'    => 'key2',
                      'key3'    => 'key3'
                    );
	}	
	
	public function Separator()
	{
		return $this->GetOptionValue('separator');	
	}	
		
} // end of class
?>