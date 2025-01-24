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

if(!is_object(cmsms())) exit;

if(!$this->CheckPermission('Modify Site Preferences'))
{
  echo $this->ShowErrors(
                          $this->Lang(
                                        'needpermission',
                                        array('Modify Site Preferences')
                                      )
                        );
  
  return;
}


$this->SetPreference('frontend_auto_height',        isset($params['frontend_auto_height']) ? 1 : 0);
$this->SetPreference('frontend_fontsize',           $params['frontend_fontsize']);
$this->SetPreference('frontend_height',             $params['frontend_height']);
$this->SetPreference('frontend_height_units',       $params['frontend_height_units']);
$this->SetPreference('frontend_syntaxarea_mode',    $params['frontend_syntaxarea_mode']);
$this->SetPreference('frontend_syntaxarea_theme',   $params['frontend_syntaxarea_theme']);
$this->SetPreference('frontend_width',              $params['frontend_width']);
$this->SetPreference('frontend_width_units',        $params['frontend_width_units']);

// redirect to tab
$params = array(
	'module_message' => $this->Lang('settingssaved')
);

$this->RedirectToAdminTab('settings_frontend', $params, 'admin_settings');

#
# EOF
#