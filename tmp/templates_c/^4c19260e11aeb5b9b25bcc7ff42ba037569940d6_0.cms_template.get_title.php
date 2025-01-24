<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:29:15
  from 'cms_template:get_title' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837d5b7862d5_05541757',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4c19260e11aeb5b9b25bcc7ff42ba037569940d6' => 
    array (
      0 => 'cms_template:get_title',
      1 => '1736670544',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67837d5b7862d5_05541757 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nodes']->value, 'node');
$_smarty_tpl->tpl_vars['node']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['node']->value) {
$_smarty_tpl->tpl_vars['node']->do_else = false;
if ($_smarty_tpl->tpl_vars['node']->value->current == false) {?>
      <?php ob_start();
echo $_smarty_tpl->tpl_vars['node']->value->alias;
$_prefixVariable2 = ob_get_clean();
$_smarty_tpl->assign("title_kh",cgsimple::get_page_content($_prefixVariable2,"title_kh"));?>
       <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>((string)$_smarty_tpl->tpl_vars['node']->value->menutext),'kh_txt'=>((string)$_smarty_tpl->tpl_vars['title_kh']->value)),$_smarty_tpl ) );?>

<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
