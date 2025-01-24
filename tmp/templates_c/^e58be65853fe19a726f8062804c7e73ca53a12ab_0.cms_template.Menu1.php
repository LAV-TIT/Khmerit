<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:04
  from 'cms_template:Menu1' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a80dc7477_54910256',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e58be65853fe19a726f8062804c7e73ca53a12ab' => 
    array (
      0 => 'cms_template:Menu1',
      1 => '1735987711',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a80dc7477_54910256 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'Nav_menu' => 
  array (
    'compiled_filepath' => 'D:\\xampp\\htdocs\\WEB\\khmerit\\tmp\\templates_c\\^e58be65853fe19a726f8062804c7e73ca53a12ab_0.cms_template.Menu1.php',
    'uid' => 'e58be65853fe19a726f8062804c7e73ca53a12ab',
    'call_name' => 'smarty_template_function_Nav_menu_119467090067828a80ae2241_55715514',
  ),
));
?>

<?php if ((isset($_smarty_tpl->tpl_vars['nodes']->value))) {
$_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'Nav_menu', array('data'=>$_smarty_tpl->tpl_vars['nodes']->value,'depth'=>0), true);?>

<?php }
}
/* smarty_template_function_Nav_menu_119467090067828a80ae2241_55715514 */
if (!function_exists('smarty_template_function_Nav_menu_119467090067828a80ae2241_55715514')) {
function smarty_template_function_Nav_menu_119467090067828a80ae2241_55715514(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('depth'=>1), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

<?php if ($_smarty_tpl->tpl_vars['depth']->value == 0) {?><ul class="navbar-nav ms-lg-5"><?php } else { ?><ul class="dropdown-menu"><?php }
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'node', true);
$_smarty_tpl->tpl_vars['node']->iteration = 0;
$_smarty_tpl->tpl_vars['node']->index = -1;
$_smarty_tpl->tpl_vars['node']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['node']->value) {
$_smarty_tpl->tpl_vars['node']->do_else = false;
$_smarty_tpl->tpl_vars['node']->iteration++;
$_smarty_tpl->tpl_vars['node']->index++;
$_smarty_tpl->tpl_vars['node']->first = !$_smarty_tpl->tpl_vars['node']->index;
$_smarty_tpl->tpl_vars['node']->last = $_smarty_tpl->tpl_vars['node']->iteration === $_smarty_tpl->tpl_vars['node']->total;
$__foreach_node_0_saved = $_smarty_tpl->tpl_vars['node'];
ob_start();
echo $_smarty_tpl->tpl_vars['node']->value->alias;
$_prefixVariable1 = ob_get_clean();
$_smarty_tpl->assign("title_kh",cgsimple::get_page_content($_prefixVariable1,"title_kh"));
$_smarty_tpl->_assignInScope('liclass', ('menudepth').($_smarty_tpl->tpl_vars['depth']->value));
$_smarty_tpl->_assignInScope('aclass', '');
if ($_smarty_tpl->tpl_vars['node']->first && $_smarty_tpl->tpl_vars['node']->total > 1) {
$_smarty_tpl->_assignInScope('liclass', ($_smarty_tpl->tpl_vars['liclass']->value).(' first_child'));
}
if ($_smarty_tpl->tpl_vars['node']->last && $_smarty_tpl->tpl_vars['node']->total > 1) {
$_smarty_tpl->_assignInScope('liclass', ($_smarty_tpl->tpl_vars['liclass']->value).(' last_child'));
}
if ($_smarty_tpl->tpl_vars['node']->value->current) {
$_smarty_tpl->_assignInScope('liclass', ($_smarty_tpl->tpl_vars['liclass']->value).(' menuactive'));
$_smarty_tpl->_assignInScope('aclass', ($_smarty_tpl->tpl_vars['aclass']->value).(' menuactive'));
}
if ($_smarty_tpl->tpl_vars['node']->value->parent) {
$_smarty_tpl->_assignInScope('liclass', ($_smarty_tpl->tpl_vars['liclass']->value).(' menuactive menuparent'));
$_smarty_tpl->_assignInScope('aclass', ($_smarty_tpl->tpl_vars['aclass']->value).(' menuactive menuparent'));
}
if ($_smarty_tpl->tpl_vars['node']->value->children) {
$_smarty_tpl->_assignInScope('liclass', ($_smarty_tpl->tpl_vars['liclass']->value).(' dropdown'));
$_smarty_tpl->_assignInScope('aclass', ($_smarty_tpl->tpl_vars['aclass']->value).(' dropdown-toggle'));
}
if ($_smarty_tpl->tpl_vars['node']->value->type == 'sectionheader') {?><li class='sectionheader <?php echo $_smarty_tpl->tpl_vars['liclass']->value;?>
'><span><?php echo $_smarty_tpl->tpl_vars['node']->value->menutext;?>
</span><?php if ((isset($_smarty_tpl->tpl_vars['node']->value->children))) {
$_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'Nav_menu', array('data'=>$_smarty_tpl->tpl_vars['node']->value->children,'depth'=>$_smarty_tpl->tpl_vars['depth']->value+1), true);
}?></li><?php } elseif ($_smarty_tpl->tpl_vars['node']->value->type == 'separator') {?><li class='separator <?php echo $_smarty_tpl->tpl_vars['liclass']->value;?>
'><hr class='separator'/></li><?php } else { ?><li class="nav-item <?php echo $_smarty_tpl->tpl_vars['liclass']->value;?>
"><!--$node->url}?lang=get_lang}--><a class="nav-link <?php echo $_smarty_tpl->tpl_vars['aclass']->value;
if ($_smarty_tpl->tpl_vars['node']->value->extra1) {?> justify-content-start<?php }?>"href="<?php echo $_smarty_tpl->tpl_vars['node']->value->url;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
"<?php if ($_smarty_tpl->tpl_vars['node']->value->target != '') {?>target="<?php echo $_smarty_tpl->tpl_vars['node']->value->target;?>
"<?php }
if ((isset($_smarty_tpl->tpl_vars['node']->value->children))) {?>role="button" data-bs-toggle="dropdown" aria-expanded="false"<?php }?>><?php echo $_smarty_tpl->tpl_vars['node']->value->extra1;?>
<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('kh_txt'=>((string)$_smarty_tpl->tpl_vars['title_kh']->value),'en_txt'=>((string)$_smarty_tpl->tpl_vars['node']->value->menutext)),$_smarty_tpl ) );?>
</span></a><?php if ((isset($_smarty_tpl->tpl_vars['node']->value->children))) {
$_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'Nav_menu', array('data'=>$_smarty_tpl->tpl_vars['node']->value->children,'depth'=>$_smarty_tpl->tpl_vars['depth']->value+1), true);
}?></li><?php }
$_smarty_tpl->tpl_vars['node'] = $__foreach_node_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul><?php
}}
/*/ smarty_template_function_Nav_menu_119467090067828a80ae2241_55715514 */
}
