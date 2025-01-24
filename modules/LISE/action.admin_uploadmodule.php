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
use \LISE\Error as Error;
if( !defined('CMS_VERSION') ) exit;

$fieldName = 'm1_filename';

#---------------------
# Submit
#---------------------

if (isset($params['upload'])) 
{
	$errors = array();
  
  if (!isset ($_FILES[$fieldName]) || !isset ($_FILES)
    || !is_array ($_FILES[$fieldName]) || !$_FILES[$fieldName]['name'])
    {
      $errors[] = 'error no xml file';
    }
    else
    {
      // normalize the file variable
      $file = $_FILES[$fieldName];
      
      if( !isset($file['tmp_name']) || trim($file['tmp_name']) == '' ) 
      {
        $errors[] = 'error no xml file';
      }
    }
  
    $instancename = trim($params['instancename']);
    
    if( !empty($instancename) )
    {
      if(preg_match('/[^0-9a-zA-Z]/', $instancename))
      {
        $errors[] = $this->ModLang('module_name_invalid');
      }
      
      # enforce LISE prefix
      if(!startswith($instancename, 'LISE') ) $instancename = 'LISE' . $instancename;
    }
    
    if( count($errors) )
    {
      $errors = implode('|', $errors);
      $params = array('errors' => $errors,'active_tab' => 'instancestab');
      $this->Redirect($id, 'defaultadmin', '', $params);
    }
    
    
    $xmlstr = file_get_contents($file['tmp_name']);
    $importer = new LISEInstanceImporter($xmlstr, $instancename);
    
    try
    {
      $module_fullname = $importer->Run();
    }
    catch(Exception $e)
    {
      switch( $e->getCode() )
      {
        case Error::CREATE_DIR_ERROR:
          $errors[] = 'Couldn\'t create a directory named ' . $instancename;
        break;
        
        default:
          $errors[] = $e->getMessage();
      }
    }
    
    if( count($errors) )
    {
      $errors = implode('|', $errors);
      $params = array('errors' => $errors,'active_tab' => 'instancestab');
      $this->Redirect($id, 'defaultadmin', '', $params);
    }
}

$params = array('message' => 'modulecopied','active_tab' => 'instancestab');

$this->Redirect($id, 'defaultadmin', '', $params);
?>