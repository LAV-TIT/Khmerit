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

if ( !is_object( cmsms() ) ) exit;

if ( !$this->CheckPermission('Modify Site Preferences') ) {
	echo $this->ShowErrors( $this->Lang('needpermission', array (
		'Modify Site Preferences'
	) ) );
	return;
}


#---------------------
# Init
#---------------------

// font size 
$fonts = array(
	'10px' => '10',
	'11px' => '11',
	'12px' => '12',
	'13px' => '13',
	'14px' => '14',
	'16px' => '16',
	'18px' => '18',
	'20px' => '20',
	'24px' => '24'
);

$units = array(
	'px' => 'px',
	'%' => '%',
	'em' => 'em'
);

// tab sizes
$tab_size = array(
	'2' => '2',
	'4' => '4',
	'6' => '6',
	'8' => '8'
);

// text wrapping
$soft_wrap = array(
	'off' => $this->Lang('off'),
	'40' => $this->Lang('40cols'),
	'80' => $this->Lang('80cols'),
	'100' =>$this->Lang('100cols'),
	'140' => $this->Lang('140cols')
);

// sample content
$syntax_content = '';
$mode_path = cms_join_path($this->GetModulePath(), 'samples', $this->AceGetPreference('mode', 'html') . '.inc');

if ( is_readable($mode_path) ) $syntax_content = @file_get_contents($mode_path);

#---------------------
# Smarty processing
#---------------------

$smarty->assign('fontsizeinput', $fonts);
$smarty->assign('unitsinput', $units);
$smarty->assign('tab_sizeinput', $tab_size);
$smarty->assign('soft_wrapinput', $soft_wrap);

$smarty->assign('submit', $this->CreateInputSubmit($id, 'submit', $this->Lang('savesettings')));

// create test textarea
// deprecated
$smarty->assign('testarea', $this->CreateTextArea(false, $id, $syntax_content, 'testarea', '', '', '', '', '', '', $this->GetName(), cms_userprefs::get_for_user($userid, 'mode', 'theme', 'fontsize', 'full_line', 'highlight_active', 'show_invisibles', 'persisten_hscroll', 'keybinding', 'soft_wrap', 'show_gutter', 'print_margin', 'soft_tab', 'highlight_selected', 'enable_behaviors')));
$smarty->assign('testareacontent', $syntax_content);

echo $this->ProcessTemplate('prefstab_backend.tpl');

#
# EOF
#