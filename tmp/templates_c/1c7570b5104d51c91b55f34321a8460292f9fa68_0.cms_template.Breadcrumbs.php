<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:05
  from 'cms_template:Breadcrumbs' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a816455a1_96760554',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1c7570b5104d51c91b55f34321a8460292f9fa68' => 
    array (
      0 => 'cms_template:Breadcrumbs',
      1 => '1736441371',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a816455a1_96760554 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="breadcrumb mb-3"><?php if ((isset($_smarty_tpl->tpl_vars['starttext']->value))) {
}
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nodelist']->value, 'node', true);
$_smarty_tpl->tpl_vars['node']->iteration = 0;
$_smarty_tpl->tpl_vars['node']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['node']->value) {
$_smarty_tpl->tpl_vars['node']->do_else = false;
$_smarty_tpl->tpl_vars['node']->iteration++;
$_smarty_tpl->tpl_vars['node']->last = $_smarty_tpl->tpl_vars['node']->iteration === $_smarty_tpl->tpl_vars['node']->total;
$__foreach_node_1_saved = $_smarty_tpl->tpl_vars['node'];
ob_start();
echo $_smarty_tpl->tpl_vars['node']->value->alias;
$_prefixVariable3 = ob_get_clean();
$_smarty_tpl->assign("title_kh",cgsimple::get_page_content($_prefixVariable3,"title_kh"));
$_smarty_tpl->_assignInScope('spanclass', 'breadcrumb');
if ($_smarty_tpl->tpl_vars['node']->value->current) {
$_smarty_tpl->_assignInScope('spanclass', ($_smarty_tpl->tpl_vars['spanclass']->value).(' current'));
}?><span class="<?php echo $_smarty_tpl->tpl_vars['spanclass']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['node']->last) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>((string)$_smarty_tpl->tpl_vars['node']->value->menutext),'kh_txt'=>((string)$_smarty_tpl->tpl_vars['title_kh']->value)),$_smarty_tpl ) );
} elseif ($_smarty_tpl->tpl_vars['node']->value->type == 'sectionheader') {
echo $_smarty_tpl->tpl_vars['node']->value->menutext;?>
&nbsp;<?php } else { ?><a href="<?php echo $_smarty_tpl->tpl_vars['node']->value->url;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" title="<?php echo $_smarty_tpl->tpl_vars['node']->value->menutext;?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>((string)$_smarty_tpl->tpl_vars['node']->value->menutext),'kh_txt'=>((string)$_smarty_tpl->tpl_vars['title_kh']->value)),$_smarty_tpl ) );?>
</a><?php }?></span><?php if (!$_smarty_tpl->tpl_vars['node']->last) {?> <i style="font-size: var(--fs-9);" class="fa-solid fa-chevron-right"></i> <?php }
$_smarty_tpl->tpl_vars['node'] = $__foreach_node_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></div><?php }
}
