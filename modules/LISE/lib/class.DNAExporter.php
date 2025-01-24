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

/**
 * Class DNAExporter
 *
 * @package LISE
 */
final class DNAExporter
{
  #---------------------
  # Constants
  #---------------------
  
  /**
   *
   */
  public const MOD_PREFIX = 'LISE';
  #internal version
  /**
   *
   */
  public const XML_VERSION = '1.1';

  #---------------------
  # Attributes
  #---------------------
  
  /**
   * @var string
   */
  private $modname;
  /**
   * @var
   */
  private $_data;
  /**
   * @var
   */
  private $_prefs;
  /**
   * @var
   */
  private $_template_prefs;
  /**
   * @var
   */
  private $_xml;
  
  /**
   * @var string[]
   */
  private static $_invalid = ['.', '..'];

	#---------------------
	# Magic methods
	#---------------------		
  
  /**
   * DNAExporter constructor.
   *
   * @param null $modname
   *
   * @throws \LISE\Exception
   */
  public function __construct($modname = NULL)
	{
    if( empty($modname) ) throw new Exception('Error in ' . __CLASS__ . ' constructor: invalid parameter!');
    
    if( !startswith($modname, self::MOD_PREFIX) )
    {
      $modname = self::MOD_PREFIX . $modname;
    }
    
    $this->modname = $modname;
	}

  #---------------------
  # Runner
  #---------------------
  
  /**
   * @throws \Exception
   */
  public function Run() : void
  {
    $this->CopyFromDataBase();
    $this->CopyFromPreferences();
    $this->CopyFromTemplates();
    $this->_build_xml();
    $this->_save();
	}
  
  
  /**
   * TODO: error checks
   *
   * @throws \Exception
   */
  private function CopyFromDataBase() : void
  {
    $mod_prefix = \cms_db_prefix() . 'module_' . strtolower($this->modname) . '_';

    $table_list = [
                    'category',
                    'item_categories',
                    'fielddef',
                    'fielddef_opts'
    ];
    $db = cmsms()->GetDb();
    
    $data = array();
    foreach($table_list as $one)
    {
      $tn = $mod_prefix . $one;
      $q = 'SELECT * FROM ' . $tn;
      $data[$one] = $db->GetArray($q);
    }
    
    $tn =  \cms_db_prefix() . 'module_lise_instances';
    $q = 'SELECT * FROM ' . $tn . ' WHERE module_name=?';
    $data[$this->modname] = $db->GetRow($q, [$this->modname]);
    
    $this->_data['db'] = $data;
  }
  
  /**
   *
   */
  private function CopyFromPreferences() : void
  {
    
    $prefs = [
                'friendlyname',
                'adminsection',
                'moddescription',
                'item_title',
                'sortorder',
                'item_singular',
                'item_plural',
                'display_create_date',
                'item_cols',
                'items_per_page',
                'url_prefix',
                'display_inline',
                'subcategory',
                'urltemplate',
                'detailpage',
                'summarypage',
                'reindex_search',
                'summary_template',
                'detail_template',
                'search_template',
                'category_template',
                'archive_template',
                'display_inline',
                'display_create_date',
                'reindex_search',
                'auto_upgrade',
                'hide_alias',
                'hide_slug',
                'hide_time_control',
                'separate_settings'
    ];
    
    $mod = \ModuleOperations::get_instance()->get_module_instance($this->modname, NULL, TRUE);
    
    foreach($prefs as $pref)
    {
      $this->_data['prefs'][$pref] = $mod->GetPreference($pref, '');
    }

  }
  
  /**
   *
   */
  private function CopyFromTemplates() : void
  {
    $mod = \ModuleOperations::get_instance()->get_module_instance($this->modname, NULL, TRUE);

    $templates = $mod->ListTemplates();
    
    foreach($templates as $one)
    {
      $this->_data['templates'][$one] = $mod->GetTemplate($one); 
    }
     
  }
  
  /**
   *
   */
  private function _save() : void
  {
    $mod = \ModuleOperations::get_instance()->get_module_instance($this->modname, NULL, TRUE);
    $dn =\cms_join_path($mod->GetModulePath(), 'data');
    
    if(@!mkdir($dn) && !is_dir($dn))
    {
      throw new \RuntimeException(sprintf('Directory "%s" was not created', $dn));
    }
    
    $fn = \cms_join_path($dn, 'dna.xml');
    $file = fopen($fn, 'w');
    fwrite($file, $this->_xml);
    fclose($file);
  }
  
  /**
  * pretty simple xml builder, but prone to errors (I think)
  * Will be worked on depending on usability...
  */
  private function _build_xml() : void
  {
    $mod = \ModuleOperations::get_instance()->get_module_instance($this->modname, NULL, TRUE);
    
    $this->_xml  = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $this->_xml .= '<LISEInstanceModule>' . "\n";
    $this->_xml .= ' <XMLVERSION>' . self::XML_VERSION . '</XMLVERSION>' . "\n";
    $this->_xml .= ' <ModuleName>' . $this->modname . '</ModuleName>' . "\n";
    $this->_xml .= ' <Version>' . $mod->GetVersion() . '</Version>' . "\n";
    $this->_xml .= ' <ModuleFriendlyName><![CDATA[' . $mod->GetFriendlyName()  . ']]></ModuleFriendlyName>' . "\n";
    $this->_xml .= ' <Data>' . base64_encode(serialize($this->_data)) . '</Data>' . "\n";
    $this->_xml .= '</LISEInstanceModule>' . "\n";
  }
	
} // end of class