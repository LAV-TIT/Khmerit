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
class LISEInstanceImporter 
{
  #---------------------
  # Constants
  #---------------------
  
  const MOD_PREFIX          = 'LISE';
  const PLACEHOLDER         = 'PLACE_HOLDER___';
  const VERSION_PLACEHOLDER = 'VERSION___';

  #---------------------
  # Attributes
  #---------------------

  private $src;
  private $dst;
  private $modname;
  private $friendlyname;
  private $_data;
  private $_xml;
  
	private static $_invalid = ['.', '..'];

	#---------------------
	# Magic methods
	#---------------------		
		
	public function __construct($xml = '', $filename = NULL)
	{
    if( empty($xml) ) { throw new \LISE\Exception('Error in ' . __CLASS__ . ' constructor: invalid parameter!'); }
    $this->_xml = $xml;
    $this->_expand_xml();
    
    if( !empty($filename) ) { $this->modname = $filename; }
    
    $this->src = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . 'duplicate';
    $this->dst = dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . $this->modname;
	}

  #---------------------
  # Runner
  #---------------------
  /**
   * @return mixed
   * @throws \LISE\Exception
   */
	public function Run()
	{
    # 1st copy the original
    $this->CopyRecursive($this->src, $this->dst);
		$this->Rename();
    $this->FixModulefile();
    
    # flag module mode
    $_SESSION['_install_module_mode_'] = (int)$this->_data['db'][$this->modname]['module_mode'];
    $_SESSION['_install_module_name'] = $this->modname;
    
    # now we install new
    $modops = ModuleOperations::get_instance();
    $modops->InstallModule($this->modname);
    
    # expand the rest of the data
		$this->CopyDataBase();
    $this->CopyTemplates();
    $this->CopyPreferences();
    
    # now we have a new LISE Module
		return $this->modname;
	}
		
	#---------------------
	# File handling methods
	#---------------------		
  
  /**
   * @param $src
   * @param $dst
   *
   * @return void
   * @throws \LISE\Exception
   */
	private function CopyRecursive($src, $dst)
	{
    $dir = opendir($src);
    if(!$dir)
    {
      throw new \LISE\Exception(
        'Error: ' . __CLASS__ . ' - ' . __METHOD__ . ' -> failed to open directory: ' . $src,
        \LISE\Error::OPEN_DIR_ERROR
      );
    }
    
		if(!mkdir($dst) && !is_dir($dst))
    {
      throw new \LISE\Exception(
        'Error: ' . __CLASS__ . ' - ' . __METHOD__ . ' -> failed to create directory: ' . $dst,
        \LISE\Error::CREATE_DIR_ERROR
      );
    }
    
    try
    {
      while( FALSE !== ( $file = readdir($dir) ) )
      {
        # Skip stuff we never allow to copy
        if( in_array($file, self::$_invalid) ) { continue; }

        if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) 
        { 
          $this->CopyRecursive($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file); 
        } 
        else if( !@copy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file) )
        {
          throw new \LISE\Exception(
            'Error: ' . __CLASS__ . ' - ' . __METHOD__ . ' -> failed to copy: ' . $src . DIRECTORY_SEPARATOR . $file .
            ' to ' . $dst . DIRECTORY_SEPARATOR . $file, \LISE\Error::COPY_FILE_ERROR
          );
        }
      }
    }
    catch(Exception $e)
    {
      # make sure you close the dir and rethrow exception
      closedir($dir);
      throw $e;
    } 
	}
  
  /**
   * @return void
   * @throws \LISE\Exception
   */
	private function Rename()
	{
    $old = cms_join_path($this->dst, self::PLACEHOLDER . '.php');
    $new = cms_join_path($this->dst, $this->modname . '.module.php') ;
    if( !@rename($old, $new ) )
    {
      throw new \LISE\Exception(
        'Error: ' . __CLASS__ . ' - ' . __METHOD__ . ' -> failed to rename: ' . $new, \LISE\Error::DISCRETE
      );
    }
	}
  
  /**
   * @return void
   * @throws \LISE\Exception
   */
	private function FixModulefile()
	{
    $filename = $this->dst . DIRECTORY_SEPARATOR . $this->modname .'.module.php';
    $lise_version = \cms_utils::get_module('LISE')->GetVersion();
    
    // Replacements
    $_contents = file_get_contents($filename); // <- Throw exception on failure?
    $_contents = str_replace([self::PLACEHOLDER, self::VERSION_PLACEHOLDER],
                             [$this->modname, "'" . $lise_version . "'"], $_contents);
    
    // Write file
    $fh = @fopen($filename, 'wb');
    if(!$fh)
    {
      throw new \LISE\Exception(
        'Error: ' . __CLASS__ . ' - ' . __METHOD__ . ' -> failed to open ' . $filename, \LISE\Error::DISCRETE
      );
    }
    
    try
    {
      if( !fwrite($fh, $_contents) )
      {
        throw new \LISE\Exception(
          'Error: ' . __CLASS__ . ' - ' . __METHOD__ . ' -> failed to write to ' . $filename, \LISE\Error::DISCRETE
        );
      }
    }
    catch(Exception $e)
    {
      # make sure you close the file and rethrow exception
      fclose($fh);
      throw $e;
    }
	}
  
  private function CopyDataBase()
  {
     $mod_prefix = cms_db_prefix() . 'module_' . strtolower($this->modname) . '_';

     $table_list = [
                      'item',
                      'category',
                      'item_categories',
                      'fielddef',
                      'fielddef_opts',
                      'fieldval'
                    ];
                        
     $db = cmsms()->GetDb();
     
     foreach($table_list as $one)
     {
       $nt = $mod_prefix . $one;
       
       //$rows = array();
       
       foreach($this->_data['db'][$one] as $row)
       {
         $fields = implode(',', array_keys($row) );
         $phs = implode(',', array_fill(0, count($row), '?') );

         $q = 'INSERT INTO ' . $nt. ' (' . $fields . ') VALUES (' . $phs . ')';
         $r = $db->Execute($q, array_values($row));
         
         if(!$r) throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() , \LISE\Error::DISCRETE_DB );
       }
     }
  }
  
  private function CopyPreferences()
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
                  
    $template_prefs = [
                        'default_summary_template',
                        'default_detail_template',
                        'default_search_template',
                        'default_category_template',
                        'default_archive_template'
                      ];

    $mod = ModuleOperations::get_instance()->get_module_instance($this->modname, NULL, TRUE);
    
    foreach($prefs as $pref)
    {
      $mod->SetPreference($pref, $this->_data['prefs'][$pref]);
    }
  
    # for backward compatibility
    foreach($template_prefs as $pref)
    {
      if( isset( $this->_data['template_prefs'][$pref]) )
      {
        $key = str_replace('default_', '', $pref);
        $this->_data['template_prefs'][$pref] = $mod->SetPreference($key, '');
      }
    
    }

  }
  
  private function CopyTemplates()
  {
    
    $mod = ModuleOperations::get_instance()->get_module_instance($this->modname, NULL, TRUE);
    $templates = $mod->ListTemplates();
    
    foreach($templates as $one) { $mod->DeleteTemplate($one); }
    foreach($this->_data['templates'] as $k => $v) { $mod->SetTemplate($k, $v); }
  }
  
  /**
   * @return void
   * @throws \LISE\Exception
   */
  private function _expand_xml()
  {
    $tmp = simplexml_load_string($this->_xml);
    
    if($tmp)
    {
      if(!isset($tmp->XMLVERSION) || $tmp->XMLVERSION > LISEInstanceExporter::XML_VERSION)
      {
        throw new \LISE\Exception('Error in ' . __CLASS__ . ' invalid XML!');
      }
      
      if(!isset($tmp->ModuleName))
      {
        throw new \LISE\Exception('Error in ' . __CLASS__ . ' invalid XML!');
      }
      
      if(!isset($tmp->Version))
      {
        throw new \LISE\Exception('Error in ' . __CLASS__ . ' invalid XML!');
      }
      
      if(!isset($tmp->ModuleFriendlyName))
      {
        throw new \LISE\Exception('Error in ' . __CLASS__ . ' invalid XML!');
      }
      
      if(!isset($tmp->Data))
      {
        throw new \LISE\Exception('Error in ' . __CLASS__ . ' invalid XML!');
      }
      
      $this->modname      = (string)$tmp->ModuleName;
      $this->friendlyname = (string)$tmp->ModuleFriendlyName;
      $this->_data        = unserialize(base64_decode($tmp->Data));
    }
    else
    {
      throw new \LISE\Exception('Error in ' . __CLASS__ . 'invalid XML!');
    }
  }
	
} // end of class