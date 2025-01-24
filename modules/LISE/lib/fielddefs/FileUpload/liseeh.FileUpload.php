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
class liseeh_FileUpload extends LISEEventHandlerBase
{

	private static $_img_types = array('gif', 'jpg', 'jpeg', 'png');

	// Copied from JMFilePicker

	public static final function HandleFileResizing($source, $output, $new_width, $new_height, $keep_aspectratio = true, $allow_upscaling = false, $quality = 100, $clean_path = true) {
                
                if(@ini_get("upload_tmp_dir") && !startswith($source, @ini_get("upload_tmp_dir")) && $clean_path) { $source = self::CleanPath(str_replace(basename($source),'',$source)).basename($source); }
                
                if($clean_path) { $output = self::CleanPath(str_replace(basename($output),'',$output)).basename($output); }
                
                $img_data = @getimagesize($source);
                
                if (!$img_data) { return false; }
                              
                switch($img_data['mime']) {
                        case 'image/jpeg':
                                $orig_image = @imagecreatefromjpeg($source);
                                break;
                        case 'image/gif' :
                                $orig_image = @imagecreatefromgif($source);
                                break;
                        case 'image/png' :
                                $orig_image = @imagecreatefrompng($source);
                                break;
                        default:
                                return false;
                }
                
                if(!$orig_image)
                        return false;
             
                $orig_width  = @imagesx($orig_image);
                $orig_height = @imagesy($orig_image);
                
                $aspectratio = $orig_width / $orig_height;
                
                $new_width  = floor($new_width);
                $new_height = floor($new_height);
                
                if($new_width <= 0 && $new_height > 0) {
                        $new_width = $orig_width;
                        if($new_height > $orig_height && !$allow_upscaling) { $new_height = $orig_height; }
                        if($keep_aspectratio) { $new_width = floor($new_height * $aspectratio); }
                }
                else if($new_height <= 0 && $new_width > 0) {
                        $new_height = $orig_height;
                        if($new_width > $orig_width && !$allow_upscaling) { $new_width = $orig_width; }
                        if($keep_aspectratio) { $new_height = floor($new_width / $aspectratio); }
                }
                else if($new_height > 0 && $new_width > 0) {
                        if($new_width > $orig_width && !$allow_upscaling) { $new_width = $orig_width; }
                        if($new_height > $orig_height && !$allow_upscaling) { $new_height = $orig_height; }
                        $new_aspectratio = $new_width / $new_height;
                        if($keep_aspectratio) {
                                if($aspectratio > 1 && $new_aspectratio < 1) { 
                                        $_tmp = floor($new_width / $aspectratio);
                                        if($_tmp > 0 && $_tmp <= $new_height) {  $new_height = $_tmp; }
                                }
                                else if($aspectratio < 1 && $new_aspectratio > 1) {
                                        $_tmp = floor($new_height * $aspectratio);
                                        if($_tmp > 0 && $_tmp <= $new_width) { $new_width = $_tmp; }
                                } else {
                                        if($new_aspectratio < $aspectratio) {
                                                $_tmp = floor($new_width / $aspectratio);
                                                if($_tmp > 0 && $_tmp <= $new_height) { $new_height = $_tmp; }
                                        } else if($new_aspectratio > $aspectratio) {
                                                $_tmp = floor($new_height * $aspectratio);
                                                if($_tmp > 0 && $_tmp <= $new_width) { $new_width = $_tmp; }
                                        }
                                }
                        }
                } else {
                        $new_height = $orig_height;
                        $new_width  = $orig_width;
                }
                
                if($new_width < 1) {$new_width = 1; }
                if($new_height < 1) { $new_height = 1; }
                
                $new_image = @imagecreatetruecolor(floor($new_width), floor($new_height));
                
                if($img_data['mime'] == 'image/gif') {
                        @imagetruecolortopalette($new_image, true, 256);
                        @imagealphablending($new_image, false);
                        @imagesavealpha($new_image,true);
                        $transparent = @imagecolorallocatealpha($new_image, 255, 255, 255, 127);
                        @imagefilledrectangle($new_image, 0, 0, $new_width, $new_height, $transparent);
                        @imagecolortransparent($new_image, $transparent);
                } else if ($img_data['mime'] == 'image/png') {
                        @imagecolortransparent($new_image, @imagecolorallocate($new_image, 0, 0, 0));   
                        @imagealphablending($new_image, false);
                        $color = @imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                        @imagefill($new_image, 0, 0, $color);
                        @imagesavealpha($new_image, true);
                }
                
                @imagecopyresampled($new_image, $orig_image, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);
                
                @imagedestroy($orig_image);
                
                switch($img_data['mime']) {
                        case 'image/jpeg': 
                                $result = @imagejpeg($new_image, $output, $quality);break;
                        case 'image/gif' : 
                                $result = @imagegif($new_image, $output);break;
                        case 'image/png' : 
                                $result = @imagepng($new_image, $output);break;
                        default: 
                                $result = false;
                }
                
                @imagedestroy($new_image);
                
                return $result;
        }
	
	#---------------------
	# Variables
	#---------------------	

	private $_data;

	#---------------------
	# Magic methods
	#---------------------		
	
	public function __construct(LISEFielddefBase &$field)
	{
		parent::__construct($field);
	}
	
	#---------------------
	# Overwritable events
	#---------------------	
	
	public function OnItemDelete(LISE &$mod)
	{
		// Delete file
		$path = cms_join_path($this->GetImagePath(), $this->GetValue());
		@unlink($path);		
	}
	
	public function ItemSavePreProcess(&$errors, &$params) 
	{			
		// Check if we need delete
		if (isset($params['delete_customfield'][$this->GetId()])) {
				
			if($params['delete_customfield'][$this->GetId()] == 'delete') {
			
				// Delete file
				$path = cms_join_path($this->GetImagePath(), $this->GetValue());
				@unlink($path);
				
				// Reset value
				$this->SetValue();
			}
		}
		else // Apply new value
    {
			// Fill _data from $_FILES
      if( isset($_FILES['m1_customfield']) )
      {
        //$id is statically part of key, not ideal.
        $files = self::_diverse_array($_FILES['m1_customfield']);
      }

      if(isset($files[$this->GetId()]))
        $this->_data = $files[$this->GetId()]; // <- My assumption is that $_FILES contains correct structure and therefore array is complete. Am i wrong? 1 + 1 = 2!

      // Check that _data is valid
      if(isset($this->_data) && $this->_data['error'] === 0) 
      {  
        // Validate errors
        if(strpos($this->GetOptionValue('allowed'), lisefd_FileUpload::_ext($this->_data['name'])) === FALSE) 
        {
          $errors[] = $this->ModLang('error_bad_extension') . ' (' . $this->GetName() . ')';
        }        

				
				// Set Value from _data
				if(empty($errors)) 
        {
					$this->SetValue($this->_data['name']);
				}			
			}
		}
						
		parent::ItemSavePreProcess($errors, $params);
	}	
	
	public function ItemSavePostProcess(&$errors, &$params) 
	{
		// Move file to correct place, nothing else.
		if(isset($this->_data) && $this->_data['error'] === 0) {
		
			// Get file path
			$path = $this->GetImagePath();
			
			// Assure directory exists
			if(!is_dir($path))
				@mkdir($path, 0777, true);

			// Merge filename into path
			$path = cms_join_path($path, $this->GetValue());


			// Check if we need image and if extension of filename is actually image.
			if( ($this->GetOptionValue('image') == "1") && (in_array(self::_ext($this->GetValue()), self::$_img_types)) && ($this->GetOptionValue('resize') == "1") ) {
				// Execute resize and move.
				if(!$this->HandleFileResizing($this->_data['tmp_name'], $path, $this->GetOptionValue('maxwidth'),  $this->GetOptionValue('maxheight'), $this->GetOptionValue('aspectratio'), $this->GetOptionValue('upscale'), $this->GetOptionValue('quality'), false)) {
					$errors[] = $this->ModLang('error_file_permissions');
				}
			} else {
				// Execute move.
				if(!move_uploaded_file($this->_data['tmp_name'], $path)) {
					$errors[] = $this->ModLang('error_file_permissions');
				}
			}
		}
	}

	#---------------------
	# Private methods
	#---------------------	
	
	private static function _diverse_array($vector) 
  {
		$result = array();
    
    if( is_array($vector) )
    {
		  foreach($vector as $key1 => $value1)
      {
			  foreach($value1 as $key2 => $value2) 
        {
				  $result[$key2][$key1] = $value2;
			  }
		  }
    }
    
		return $result;
	} 	
	
} // end of class

?>