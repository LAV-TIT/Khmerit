<?php
#-------------------------------------------------------------------------
# LISE - List It Special Edition
# Version 1.2.2
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

/**
 * This class defines a new template resource
 * and is basically based on the core own
 * CMSModuleFileTemplateResource and CMS_Fixed_Resource_Custom
 * CMS_Fixed_Resource_Custom fixes some weird stuff in smarty
 * but as these are internal core classes, we just copy the code
 * and adapt it to our needs
 *
 * Jo Morg
 */
class LISETemplateResource extends Smarty_Resource_Custom
{
  /**
   * a fix to resolve an issue with smarty (TODO revisit as it may not be needed anymore - JM)
   *
   * @param \Smarty_Template_Source        $source
   * @param \Smarty_Internal_Template|NULL $_template
   *
   * @throws \LISE\Exception
   */
  public function populate(Smarty_Template_Source $source, Smarty_Internal_Template $_template = null)
  {
    $source->filepath = $source->type . ':' . $source->name;
    $source->uid = sha1($source->type . ':' . $source->name);
    
    $mtime = $this->fetchTimestamp($source->name);
    
    if ($mtime !== null)
    {
      $source->timestamp = $mtime;
    }
    else
    {
      $this->fetch($source->name, $content, $timestamp);
      $source->timestamp = isset($timestamp) ? $timestamp : false;
      if( isset($content) ) $source->content = $content;
    }
    
    $source->exists = !!$source->timestamp;
  }
  
  /**
   * Our mechanism to deal with the templates
   * for the instances
   *
   * @param string $name
   * @param string $source
   * @param int    $mtime
   *
   * @throws \LISE\Exception
   */
  public function fetch($name, &$source, &$mtime)
  {
    $source = null;
    $mtime  = null;
    $params = explode(';', $name);
    $config = cmsms()->GetConfig();
    $files  = [];
  
    /**
     * the params are exploded from the $name by ';' separator
     * which means that 0 is the subtype
     * hence the total is always one more than the listed below
     *
     * $params
     * 0 : resource subtype:
     *                        - instance
     *                        - fielddefs
     */
    switch ($params[0])
    {
      case 'instance':
        /**
         * $params
         *          1: instance name
         *          2: template name
         * total: 3
         */
          if(3 !== count($params)) { throw new \LISE\Exception('invalid LISE template resource: ' . $params[0]); }
                                                                                                                  # priorities
          $files[] = cms_join_path($config['assets_path'], 'module_custom', $params[1], 'templates', $params[2]); # p 1
          $files[] = cms_join_path($config['root_path'], 'module_custom', $params[1], 'templates', $params[2]);   # p 2 ## deprecated
          $files[] = cms_join_path($config['root_path'], 'modules',$params[1], 'templates', $params[2]);          # p 3
          $files[] = cms_join_path(LISE_TEMPLATE_PATH, $params[2]);                                               # p 4
        break;
      
      case 'fielddefs':
        /**
         * $params
         *          1: caller:originator
         *          2: field alias
         *          3: template filename
         * total: 4
         */
  
          if( 4 !== count($params) ) { throw new \LISE\Exception('invalid LISE template resource: ' . $params[0]); }
          
          $type = explode('.', $params[3])[1];
          $param2 = explode(':',  $params[1]);
          $caller_name = $param2[0];
          $caller_path = cms_utils::get_module($caller_name)->GetModulePath();
          $originator_path = cms_utils::get_module($param2[1])->GetModulePath();
                                                                                                                                       # priorities
          #  assets module custom: assets/module_custom/<$caller_name>/fielddefs/<field_alias>/<template_name>
          $files[] = cms_join_path($config['assets_path'], 'module_custom', $caller_name, 'fielddefs', $params[2], $params[3]);        # p1
          
          # root module custom (deprecated): <root>/module_custom/<$caller_name>/fielddefs/<field_alias>/<template_name>
          $files[] = cms_join_path($config['root_path'], 'module_custom', $caller_name, 'fielddefs', $params[2], $params[3]);          # p2 ## deprecated
      
          # the custom instance: <root>/modules/<$caller_name>/templates/fielddefs/<field_alias>/<template_name>
          $files[] = cms_join_path($caller_path, 'templates', 'fielddefs', $params[2], $params[3]);                                    # p3
          
          # the originator path (either LISE or a 3rd party module):
          # LISE typical structure:  <root>/modules/<originator>/lib/fielddefs/<field_type>/<template_name>
          $files[] = cms_join_path($originator_path, 'lib', 'fielddefs', $type, $params[3]);                                           # p4
          
          # 3rd party short structure:  <root>/modules/<originator>/lise_fielddefs/<field_type>/<template_name>
          $files[] = cms_join_path($originator_path, 'lise_fielddefs', $type, $params[3]);                                             # p5
      break;
      
      default:
        throw new \LISE\Exception('invalid LISE template resource: ' . $params[0]);
    }
    

    foreach( $files as $one )
    {
      if( file_exists($one) )
      {
        $source = @file_get_contents($one);
        $mtime = @filemtime($one);
        return;
      }
    }
  }
} // end of class
?>