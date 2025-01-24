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
use Smarty_Internal_Template;

final class SmartyPlugins
{
  # keep track of ids in a single request
  static protected $_ace_id_count = 0;
  
  # global page reset data
  static protected $_reset_data = [];
  
  # valid params
  const VALPRMS = [
                    'divid',
                    'mode',
                    'theme',
                    'width',
                    'height',
                    'htmlentities'
                  ];
  
  /**
   * Register our plugins on our own
   *
   * @throws \SmartyException
   */
  static public function register()
  {
    $smarty = cms_utils::get_smarty();
    $smarty->registerPlugin( 'block', 'ace_code', '\AceSyntax\SmartyPlugins::_code_block' );
    $smarty->registerPlugin( 'function', 'ace_page_reset', '\AceSyntax\SmartyPlugins::_page_reset' );
  }
  
  /**
   * implements {ace_page_reset}
   * for it to have an effect
   * it needs to be on top of the template or page
   * recommended for the 'Smarty data or logic that is specific to this page' block
   * @param $params
   * @param $smarty
   */
  static public function _page_reset($params, $smarty)
  {
    foreach(self::VALPRMS as $one)
    {
      if( isset($params[$one]) ) self::$_reset_data[$one] = $params[$one];
    }
  }
  
  /**
   * The main block plugin
   * doesn't expect any content or params
   * but parameters can be set on each block
   * or via the {ace_page_reset} globally
   * for the duration of the request
   *
   * @param                           $params
   * @param                           $content
   * @param \Smarty_Internal_Template $template
   * @param                           $repeat
   *
   * @return string
   * @throws \SmartyException
   */
	static public function _code_block($params, $content, Smarty_Internal_Template $template, &$repeat)
  {
    if(!$repeat)
    {
      foreach(self::VALPRMS as $one)
      {
        if( !isset($params[$one]) )  $params[$one] =  isset(self::$_reset_data[$one]) ? self::$_reset_data[$one] : NULL;
      }
  
      $mod = cms_utils::get_module('AceSyntax');
  
      $divid = isset($params['divid']) ? $params['divid'] . '-' : 'ace-code-';
  
      $block = array(
        'divid'        => $divid . self::$_ace_id_count++,
        'mode'         => isset($params['mode']) ? $params['mode'] : $mod->GetPreference('frontend_syntaxarea_mode'),
        'theme'        => isset($params['theme']) ? $params['theme'] : $mod->GetPreference('frontend_syntaxarea_theme'),
        'width'        => isset($params['width']) ? $params['width'] : $mod->GetPreference('frontend_width'),
        'height'       => isset($params['height']) ? $params['height'] : $mod->GetPreference('frontend_height'),
        'fontsize'     => $mod->GetPreference('frontend_fontsize'),
        'auto_height'  => $mod->GetPreference('frontend_auto_height', '1'),
        'width_units'  => $mod->GetPreference('frontend_width_units', 'px'),
        'height_units' => $mod->GetPreference('frontend_height_units', 'px'),
        'content'      => ''
      );
  
      if( isset($content) )
      {
        $block['content'] = isset($params['htmlentities']) ? htmlentities($content) : $content;
      }
  
      $template->assign('ace_block', $block);
  
      return $template->fetch('module_file_tpl:' . $mod->GetName() . ';' . 'ace_code.tpl');
    }
	}
}
?>