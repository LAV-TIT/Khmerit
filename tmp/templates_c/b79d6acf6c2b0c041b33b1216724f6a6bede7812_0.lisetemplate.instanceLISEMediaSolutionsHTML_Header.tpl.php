<?php
/* Smarty version 4.5.2, created on 2025-01-12 00:36:39
  from 'lisetemplate:instance;LISEMediaSolutions;HTML_Header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782ac27743f97_74615792',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b79d6acf6c2b0c041b33b1216724f6a6bede7812' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;HTML_Header.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6782ac27743f97_74615792 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['jqueryui']->value;?>

<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['moduledir']->value;?>
/css/colorbox.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['moduledir']->value;?>
/css/footable.core.min.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['globals_css']->value;?>
lise-globals.css" />
<link type="text/css" rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['moduledir']->value;?>
/css/backend.css" />
<?php echo '<script'; ?>
 type="text/javascript">
<!--
var CMS_ADMIN_DIR = '<?php echo $_smarty_tpl->tpl_vars['admindir']->value;?>
';
var CMS_USER_KEY = '<?php echo $_smarty_tpl->tpl_vars['userkey']->value;?>
';
var MODULE_NAME = '<?php echo $_smarty_tpl->tpl_vars['modulename']->value;?>
';
-->
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['moduledir']->value;?>
/js/footable.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['moduledir']->value;?>
/js/footable.filter.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['moduledir']->value;?>
/js/footable.sort.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['moduledir']->value;?>
/js/jquery.slug.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['moduledir']->value;?>
/js/jquery.colorbox.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['globals_js']->value;?>
lise-globals.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['moduledir']->value;?>
/js/lise.js"><?php echo '</script'; ?>
><?php }
}
