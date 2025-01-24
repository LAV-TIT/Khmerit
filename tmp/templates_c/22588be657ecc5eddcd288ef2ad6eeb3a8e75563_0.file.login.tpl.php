<?php
/* Smarty version 4.5.2, created on 2025-01-12 12:56:31
  from 'D:\xampp\htdocs\WEB\khmerit\admin\themes\OneEleven\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6783598f65be67_29033760',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22588be657ecc5eddcd288ef2ad6eeb3a8e75563' => 
    array (
      0 => 'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\themes\\OneEleven\\templates\\login.tpl',
      1 => 1734451952,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6783598f65be67_29033760 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.sitename.php','function'=>'smarty_function_sitename',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.cms_jquery.php','function'=>'smarty_function_cms_jquery',),2=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),));
?>
<!doctype html>
<html>
	<head>
		<meta charset="<?php echo $_smarty_tpl->tpl_vars['encoding']->value;?>
" />
		<title><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'logintitle' ));?>
 - <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
</title>
		<base href="<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/" />
		<meta name="generator" content="CMS Made Simple - Copyright (C) 2004-2014 - All rights reserved" />
		<meta name="robots" content="noindex, nofollow" />
		<meta name="viewport" content="initial-scale=1.0 maximum-scale=1.0 user-scalable=no" />
		<meta name="HandheldFriendly" content="True"/>
		<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/favicon/cmsms-favicon.ico"/>
		<link rel="stylesheet" href="loginstyle.php" />
		<!-- learn IE html5 -->
		<!--[if lt IE 9]>
		<?php echo '<script'; ?>
 src="http://html5shiv.googlecode.com/svn/trunk/html5.js"><?php echo '</script'; ?>
>
		<![endif]-->
		<?php echo smarty_function_cms_jquery(array('exclude'=>"jquery.ui.nestedSortable-1.3.4.js,jquery.json-2.2.js",'append'=>((string)$_smarty_tpl->tpl_vars['config']->value['admin_url'])."/themes/OneEleven/includes/login.js"),$_smarty_tpl);?>

	</head>
	<body id="login">
		<div id="wrapper">
			<div class="login-container">
				<div class="login-box cf"<?php if ((isset($_smarty_tpl->tpl_vars['error']->value))) {?> id="error"<?php }?>>
					<div class="logo">
						<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/layout/cmsms_login_logo.png" width="180" height="36" alt="CMS Made Simple&trade;" />
					</div>
					<div class="info-wrapper open">
					<aside class="info">
					<h2><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'login_info_title' ));?>
</h2>
						<p><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'login_info' ));?>
</p>
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'login_info_params' ));?>

							<p><strong>(<?php echo $_SERVER['HTTP_HOST'];?>
)</strong></p>
						<p class="warning"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'warn_admin_ipandcookies' ));?>
</p>
					</aside>
					<a href="#" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'open' ));?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'close' ));?>
" class="toggle-info"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'open' ));?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'close' ));?>
</a>
					</div>
					<header>
						<h1><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'logintitle' ));?>
</h1>
					</header>
					<form method="post" action="login.php">
						<fieldset>
                                                        <?php $_smarty_tpl->_assignInScope('usernamefld', 'username');?>
							<?php if ((isset($_GET['forgotpw']))) {
$_smarty_tpl->_assignInScope('usernamefld', 'forgottenusername');
}?>
							<label for="lbusername"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'username' ));?>
</label>
							<input id="lbusername"<?php if (!(isset($_POST['lbusername']))) {?> class="focus"<?php }?> placeholder="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'username' ));?>
" name="<?php echo $_smarty_tpl->tpl_vars['usernamefld']->value;?>
" type="text" size="15" value="" autofocus="autofocus" />
						<?php if ((isset($_GET['forgotpw'])) && !empty($_GET['forgotpw'])) {?>
							<input type="hidden" name="forgotpwform" value="1" />
						<?php }?>
						<?php if (!(isset($_GET['forgotpw'])) && empty($_GET['forgotpw'])) {?>
							<label for="lbpassword"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'password' ));?>
</label>
							<input id="lbpassword"<?php if (!(isset($_POST['lbpassword'])) || (isset($_smarty_tpl->tpl_vars['error']->value))) {?> class="focus"<?php }?> placeholder="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'password' ));?>
" name="password" type="password" size="15" maxlength="100"/>
						<?php }?>
						<?php if ((isset($_smarty_tpl->tpl_vars['changepwhash']->value)) && !empty($_smarty_tpl->tpl_vars['changepwhash']->value)) {?>
							<label for="lbpasswordagain"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'passwordagain' ));?>
</label>
							<input id="lbpasswordagain"  name="passwordagain" type="password" size="15" placeholder="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'passwordagain' ));?>
" maxlength="100" />
							<input type="hidden" name="forgotpwchangeform" value="1" />
							<input type="hidden" name="changepwhash" value="<?php echo $_smarty_tpl->tpl_vars['changepwhash']->value;?>
" />
						<?php }?>
							<input class="btn_login loginsubmit" name="loginsubmit" type="submit" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'submit' ));?>
" />
							<input class="cancel_login loginsubmit" name="logincancel" type="submit" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'cancel' ));?>
" />
						</fieldset>
					</form>
					<?php if ((isset($_GET['forgotpw'])) && !empty($_GET['forgotpw'])) {?>
						<div class="message warning">
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'forgotpwprompt' ));?>

						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['error']->value))) {?>
						<div class="message error">
							<?php echo $_smarty_tpl->tpl_vars['error']->value;?>

						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['warninglogin']->value))) {?>
						<div class="message warning">
							<?php echo $_smarty_tpl->tpl_vars['warninglogin']->value;?>

						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['acceptlogin']->value))) {?>
						<div class="message success">
							<?php echo $_smarty_tpl->tpl_vars['acceptlogin']->value;?>

						</div>
					<?php }?>
					<?php if ((isset($_smarty_tpl->tpl_vars['changepwhash']->value)) && !empty($_smarty_tpl->tpl_vars['changepwhash']->value)) {?>
						<div class="warning message">
							<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'passwordchange' ));?>

						</div>
					<?php }?> <a href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'goto' ));?>
 <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
"> <img class="goback" width="16" height="16" src="<?php echo $_smarty_tpl->tpl_vars['config']->value['admin_url'];?>
/themes/OneEleven/images/layout/goback.png" alt="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'goto' ));?>
 <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
" /> </a>
					<p class="forgotpw">
						<a href="login.php?forgotpw=1"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'lostpw' ));?>
</a>
					</p>
				</div>
				
			</div>
		</div>
	</body>
</html>
<?php }
}
