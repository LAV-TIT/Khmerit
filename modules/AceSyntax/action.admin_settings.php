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


$userid = get_userid();


$active_tab = isset($params['active_tab']) ? $params['active_tab'] : 'settings_frontend';

echo $this->StartTabHeaders();
	if ($this->CheckPermission('Modify Site Preferences'))
	{
		echo $this->SetTabHeader('settings_frontend', $this->Lang('tab_settings_frontend'), ($active_tab == 'settings_frontend'));
	}
echo $this->EndTabHeaders();

echo $this->StartTabContent();
	if ($this->CheckPermission('Modify Site Preferences'))
	{
		echo $this->StartTab('settings_frontend', $params);
			include(dirname(__FILE__) . '/function.admin_prefstab_frontend.php');
		echo $this->EndTab();
	}
echo $this->EndTabContent();

#
# EOF
#