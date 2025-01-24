<?php
#---------------------------------------------------------------------------
# Module: AceSyntax
# Authors: Fernando Morgado (Jo Morg), Rolf Tjassens (cmscanbesimple.org)
#---------------------------------------------------------------------------
# CMS Made Simple - Power for the professional, Simplicity for the end user.
# (c) 2004 - 2011 by Ted Kulp (wishy@cmsmadesimple.org)
# (c) 2011 - 2018 by The CMS Made Simple Development Team
# (c) 2018 - 2019 by The CMS Made Simple Foundation
# This project's homepage is: https://www.cmsmadesimple.org
# The module's homepage is: http://dev.cmsmadesimple.org/projects/acesyntax
#---------------------------------------------------------------------------
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#---------------------------------------------------------------------------

namespace AceSyntax;


use cms_utils;

final class SmartyTools
{
  private static $_inititalized = FALSE;
  private static $_mod;
  
  private static function _initialize()
  {
    if(!self::$_inititalized)
    {
      self::$_mod = cms_utils::get_module('AceSyntax');
      self::$_inititalized = TRUE;
    }
  }
  
  public static function css()
  {
    self::_initialize();
    $string = '<link rel="stylesheet" type="text/css" href="';
    $string .= self::$_mod->GetModuleURLPath();
    $string .= '/lib/css/aceLayout.css" media="screen" />';
    
    return  $string;
  }
  
  public static function js($include_jquery = 0)
  {
    self::_initialize();
    $mod_url = self::$_mod->GetModuleURLPath();
    $jq = '<script
                  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
                  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
                  crossorigin="anonymous"
            ></script>';
    
    $string = (bool)$include_jquery ? $jq : '';
    
    $string .= '<script src="' . $mod_url . '/lib/ace/ace.js"></script>';
    $string .= '<script src="' . $mod_url . '/lib/js/aceInit.js"></script>';
    
    return $string;
  }
}

?>