<?php
/* Smarty version 4.5.2, created on 2025-01-12 16:21:07
  from 'cms_template:Form_Search_Results' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67838983b75f77_56430301',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e644fd4c156f14e14899e20d034fe8529f5c0259' => 
    array (
      0 => 'cms_template:Form_Search_Results',
      1 => '1736186278',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67838983b75f77_56430301 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['itemcount']->value > 0) {?>
  <h5>Search Results for 
  <span style="font-size: 15px;">&quot;<?php echo $_smarty_tpl->tpl_vars['phrase']->value;?>
&quot; (<?php echo $_smarty_tpl->tpl_vars['itemcount']->value;?>
 found)</span> 
   </h5>
  <ul>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['results']->value, 'entry');
$_smarty_tpl->tpl_vars['entry']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->do_else = false;
?>
      <li>
         <?php echo $_smarty_tpl->tpl_vars['entry']->value->title;?>
:
          <a href="<?php echo $_smarty_tpl->tpl_vars['entry']->value->url;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
">
                <?php echo $_smarty_tpl->tpl_vars['entry']->value->title;?>
 <?php echo $_smarty_tpl->tpl_vars['entry']->value->urltxt;?>
 (<?php echo $_smarty_tpl->tpl_vars['entry']->value->weight;?>
%)
          </a>
      </li>
      </li>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </ul>
<?php } else { ?>
  <p class="text-danger text-center">
      <strong>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"No results found!",'kh_txt'=>"រកមិនឃើញលទ្ធផលទេ!"),$_smarty_tpl ) );?>

   </strong>
   </p>
<?php }
}
}
