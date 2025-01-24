<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:05
  from 'cms_template:Form_Search' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a8126d278_24276458',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2411f3e216d917606ef5e3822b7f6a2adaf6d8a8' => 
    array (
      0 => 'cms_template:Form_Search',
      1 => '1735987264',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a8126d278_24276458 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['startform']->value;?>

      <input type="text" class="search-input" id="<?php echo $_smarty_tpl->tpl_vars['search_actionid']->value;?>
searchinput" name="<?php echo $_smarty_tpl->tpl_vars['search_actionid']->value;?>
searchinput" size="20" maxlength="80" 
      placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"Search here...",'kh_txt'=>"ស្វែងរក ទីនេះ..."),$_smarty_tpl ) );?>

      "/>
      
      <button class="reset" type="reset">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12">
            </path>
        </svg>
      </button>
      <button type="submit" class="btn-submit" id="btn-submit">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
      <?php if ((isset($_smarty_tpl->tpl_vars['hidden']->value))) {
echo $_smarty_tpl->tpl_vars['hidden']->value;
}
echo $_smarty_tpl->tpl_vars['endform']->value;
}
}
