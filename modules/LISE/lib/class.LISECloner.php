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


class LISECloner 
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
  private $oldmodname;
  
	private static $_invalid = array('.', '..');

	#---------------------
	# Magic methods
	#---------------------		
		
	public function __construct($oldmodname = NULL, $newmodename = NULL) 
	{
    if( empty($oldmodname) ) throw new \LISE\Exception('Error in ' . __CLASS__ . ' constructor: invalid parameter!');
    if( empty($newmodename) ) throw new \LISE\Exception('Error in ' . __CLASS__ . ' constructor: invalid parameter!');
    
    if( !startswith($oldmodname, self::MOD_PREFIX) )
    {
      $oldmodname = self::MOD_PREFIX . $oldmodname;
    }
    
    if( !startswith($newmodename, self::MOD_PREFIX) )
    {
      $newmodename = self::MOD_PREFIX . $newmodename;
    }

    $newmodename = self::_make_valid_modname($newmodename); 
    $this->oldmodname = $oldmodname;
    $this->modname = $newmodename;
    $this->src = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . $this->oldmodname;;
    $this->dst = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . $this->modname;
	}

  #---------------------
  # Set/Get
  #---------------------		

  public function SetModule($name)
  {
	  $this->modname = $name;
  }

  public function SetDuplicate($name)
  {
    $this->dup = $name;
  }
    
  public function SetSource($name)
  {
	  $this->src = $name;
  }

  public function SetDestination($name)
  {
	  $this->dst = $name;
  }	

  #---------------------
  # Runner
  #---------------------
	
	public function Run()
	{
    # 1st copy the original
    $this->CopyRecursive($this->src, $this->dst);
		$this->Rename();
    $this->FixModulefile();
    # now we install new
    $modops = cmsms()->GetModuleOperations();
    $modops->InstallModule($this->modname);
    # clone the rest of the data
		$this->CopyDataBase();
    $this->CopyTemplates();
    $this->CopyPreferences();
    # now we have a new LISE Module
		return $this->modname;
	}
		
	#---------------------
	# File handling methods
	#---------------------		

	private function CopyRecursive($src, $dst)
	{
		$dir = opendir($src); // <- Throw exception on failure?
		@mkdir($dst); // <- Throw exception on failure?
		
		while(false !== ( $file = readdir($dir)) ) 
    {
		
			if (in_array($file, self::$_invalid)) continue; // <- Skip stuff we never allow to copy

			if ( is_dir($src . DIRECTORY_SEPARATOR . $file) ) 
      { 
				$this->CopyRecursive($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file); 
			} 
			else 
      { 
				@copy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file); // <- Throw exception on failure?
			} 
		} 
		
		closedir($dir); 
	}
	
	private function Rename()
	{
    $old = cms_join_path($this->dst, $this->oldmodname . '.module.php');
    $new = cms_join_path($this->dst, $this->modname . '.module.php') ;
    
		@rename($old, $new); // <- Throw exception on failure?
	}
	
	private function FixModulefile()
	{
    $filename = $this->dst . DIRECTORY_SEPARATOR . $this->modname .'.module.php';
    
    // Replacements
    $_contents = file_get_contents($filename); // <- Throw exception on failure?
    $_contents = str_replace($this->oldmodname, $this->modname, $_contents);
    
    // Write file
    $fh = @fopen($filename, 'w');
    if(!$fh) throw new \LISE\Exception('Error: ' . __CLASS__ . ' - ' . __METHOD__ . ' -> failed to open ' . $filename, \LISE\Error::DISCRETE );
    
    try
    {
      if( !fwrite($fh, $_contents) ) throw new \LISE\Exception('Error: ' . __CLASS__ . ' - ' . __METHOD__ . ' -> failed to write to ' . $filename, \LISE\Error::DISCRETE );
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
     $old_mod_prefix = cms_db_prefix() . 'module_' . strtolower($this->oldmodname) . '_';
     $table_list = array(
                          'item',
                          'category',
                          'item_categories',
                          'fielddef',
                          'fielddef_opts',
                          'fieldval'                          
                        );
                        
     $db = cmsms()->GetDb();
     
     foreach($table_list as $one)
     {
       $nt = $mod_prefix . $one; 
       $ot= $old_mod_prefix . $one;
       
       $q = 'DROP TABLE IF EXISTS ' . $nt;
       $r = $db->Execute($q);
       
       if(!$r) throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() , \LISE\Error::DISCRETE_DB );
   
       $q = 'CREATE TABLE IF NOT EXISTS ' . $nt . ' LIKE ' . $ot; 
       $r = $db->Execute($q);
       
       if(!$r) throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() , \LISE\Error::DISCRETE_DB );
       //if(!$r) throw new Exception( $db->ErrorMsg() );
          
       $q = 'INSERT ' . $nt . ' SELECT * FROM ' . $ot; 
       $r = $db->Execute($q);
       
       if(!$r) throw new \LISE\Exception($db->ErrorNo() . ' - ' . $db->ErrorMsg() , \LISE\Error::DISCRETE_DB );
     }
  }
  
  private function CopyPreferences()
  {
    
    $prefs = array(
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
                    'reindex_search'
                  );
                  
    $template_prefs = array(
                              '_default_summary_template',
                              '_default_detail_template',
                              '_default_search_template',
                              '_default_category_template',
                              '_default_archive_template'
                            );
    
    $newmod = ModuleOperations::get_instance()->get_module_instance($this->modname, NULL, TRUE);
    $oldmod = ModuleOperations::get_instance()->get_module_instance($this->oldmodname, NULL, TRUE);
    
    foreach($prefs as $pref)
    {
      if($pref == 'friendlyname')
      {
        $newmod->SetPreference($pref, $oldmod->GetPreference($pref, '') . '*' );
        continue;
      }
      
      $newmod->SetPreference($pref, $oldmod->GetPreference($pref, '') );
    }
        
    foreach($template_prefs as $pref)
    {     
      $newmod->SetPreference($this->modname . $pref, $oldmod->GetPreference($this->modname . $pref, '') );
    }

  }
  
  private function CopyTemplates()
  {
    
    $newmod = ModuleOperations::get_instance()->get_module_instance($this->modname, NULL, TRUE);
    $oldmod = ModuleOperations::get_instance()->get_module_instance($this->oldmodname, NULL, TRUE);

    
    $templates = $newmod->ListTemplates();
    
    foreach($templates as $one) $newmod->DeleteTemplate($one);
    
    $templates = $oldmod->ListTemplates();
    
    foreach($templates as $one)
    {
      $newmod->SetTemplate( $one, $oldmod->GetTemplate($one) );
    }
     
  }
  
  private function UpgradeFromBase()
  {
    $db = cmsms()->GetDb();
    $dict = NewDataDictionary($db);
    $sqlarray = $dict->AddColumnSQL(cms_db_prefix() . 'module_' . $this->modname . '_fielddef', 'template C(255)');
    $dict->ExecuteSQLArray($sqlarray);
  }
  
  /**
   * carefull: no error checking
   *
   * @param mixed $fn
   *
   * @return bool
   */
  private function _is_valid_filename($fn)
  {
    $test = cms_join_path(
                            dirname( dirname( dirname(__FILE__) ) ),
                            $fn
                          );
                          
     return !is_dir($test);
  }
  
  private function _make_valid_modname($name)
  {
    $cnt = 0;
    $test = $name;
    while(!self::_is_valid_filename($test))
    {
      $test = $name . ++$cnt;
    }
    
    return $test;
    
  }
	
} // end of class