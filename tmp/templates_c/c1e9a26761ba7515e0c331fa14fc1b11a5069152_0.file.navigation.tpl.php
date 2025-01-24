<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:02
  from 'D:\xampp\htdocs\WEB\khmerit\admin\themes\OneEleven\templates\navigation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a7edda484_10481346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c1e9a26761ba7515e0c331fa14fc1b11a5069152' => 
    array (
      0 => 'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\themes\\OneEleven\\templates\\navigation.tpl',
      1 => 1732710190,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navigation.tpl' => 2,
  ),
),false)) {
function content_67828a7edda484_10481346 (Smarty_Internal_Template $_smarty_tpl) {
if (!(isset($_smarty_tpl->tpl_vars['depth']->value))) {
$_smarty_tpl->_assignInScope('depth', '0');
}
if ($_smarty_tpl->tpl_vars['depth']->value == '0') {?><nav class="navigation" id="oe_menu" role="navigation"><div class="box-shadow">&nbsp;</div><ul<?php if ($_smarty_tpl->tpl_vars['depth']->value == '0') {?> id="oe_pagemenu"<?php }?>><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nav']->value, 'navitem', false, NULL, 'pos', array (
));
$_smarty_tpl->tpl_vars['navitem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['navitem']->value) {
$_smarty_tpl->tpl_vars['navitem']->do_else = false;
?><li class="nav<?php if (!(isset($_smarty_tpl->tpl_vars['navitem']->value['system'])) && ((isset($_smarty_tpl->tpl_vars['navitem']->value['module'])) || (isset($_smarty_tpl->tpl_vars['navitem']->value['firstmodule'])))) {?> module<?php }
if (!empty($_smarty_tpl->tpl_vars['navitem']->value['selected']) || ((isset($_GET['section'])) && $_GET['section'] == mb_strtolower((string) $_smarty_tpl->tpl_vars['navitem']->value['name'], 'UTF-8'))) {?> current<?php }?>"><a href="<?php echo $_smarty_tpl->tpl_vars['navitem']->value['url'];?>
" class="<?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['navitem']->value['name'], 'UTF-8');
if ((isset($_smarty_tpl->tpl_vars['navitem']->value['children']))) {?> parent<?php }?>"<?php if ((isset($_smarty_tpl->tpl_vars['navitem']->value['target']))) {?> target="_blank"<?php }?> title="<?php if (!empty($_smarty_tpl->tpl_vars['navitem']->value['description'])) {
echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['navitem']->value['description']);
} else {
echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['navitem']->value['title']);
}?>" <?php if (substr($_smarty_tpl->tpl_vars['navitem']->value['url'],0,6) == 'logout' && (isset($_smarty_tpl->tpl_vars['is_sitedown']->value))) {?>onclick="return confirm('<?php echo strtr((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'maintenance_warning' )), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
')"<?php }?>><?php echo $_smarty_tpl->tpl_vars['navitem']->value['title'];?>
</a><?php if ($_smarty_tpl->tpl_vars['depth']->value == '0') {?><span class="open-nav" title="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'open' ));?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'close' ));?>
 <?php echo preg_replace('!<[^>]*?>!', ' ', (string) $_smarty_tpl->tpl_vars['navitem']->value['title']);?>
"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'open' ));?>
/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'close' ));?>
 <?php echo $_smarty_tpl->tpl_vars['navitem']->value['title'];?>
</span><?php }
if ((isset($_smarty_tpl->tpl_vars['navitem']->value['children']))) {
if ($_smarty_tpl->tpl_vars['depth']->value == '0') {?><ul><?php }
$_smarty_tpl->_subTemplateRender('file:navigation.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('nav'=>$_smarty_tpl->tpl_vars['navitem']->value['children'],'depth'=>$_smarty_tpl->tpl_vars['depth']->value+1), 0, true);
if ($_smarty_tpl->tpl_vars['depth']->value == '0') {?></ul><?php }
}?></li><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
if ($_smarty_tpl->tpl_vars['depth']->value == '0') {?></ul></nav><?php }
}
}
