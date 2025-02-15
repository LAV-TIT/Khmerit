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

if(isset($params['message']))
{
	echo $this->ShowMessage($this->ModLang($params['message']));
}

//if (isset($params['errors']) && count($params['errors'])) // there is a bug it CMSMS core... :(
// it messes with arrays in the $params array
// quick hack
if( isset($params['errors']) )
{
  $errors = explode('|', $params['errors']);
	echo $this->ShowErrors($errors);
}

if(!empty($params['active_tab']))
{
  $tab = $params['active_tab'];
}
else
{
  $tab = 'instancestab';
}

echo $this->StartTabHeaders();
echo $this->SetTabHeader('instancestab', $this->ModLang('instances'), ($tab == 'instancestab'));
echo $this->SetTabHeader('fielddefstab', $this->ModLang('fielddefs'), ($tab == 'fielddefstab'));
echo $this->SetTabHeader('maintenancetab', $this->ModLang('maintenance'), ($tab == 'maintenancetab'));
echo $this->SetTabHeader('optionstab', $this->ModLang('options'), ($tab == 'optionstab'));
echo $this->EndTabHeaders();

echo $this->StartTabContent();

echo $this->StartTab('instancestab', $params);
include dirname(__FILE__) . '/tabcontent.admin_instancestab.php';
echo $this->EndTab();

echo $this->StartTab('fielddefstab', $params);
include dirname(__FILE__) . '/tabcontent.admin_fielddefstab.php';
echo $this->EndTab();

echo $this->StartTab('maintenancetab', $params);
include dirname(__FILE__) . '/tabcontent.admin_maintenancetab.php';
echo $this->EndTab();

echo $this->StartTab('optionstab', $params);
include dirname(__FILE__) . '/tabcontent.admin_optionstab.php';
echo $this->EndTab();
    
echo $this->EndTabContent();

?>