<?php
/* Smarty version 4.5.2, created on 2025-01-12 13:30:02
  from 'cms_template:Banner_Image' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6783616a09a285_00761879',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4b1dcb2d2979f534440475e9887143518b7a2ebd' => 
    array (
      0 => 'cms_template:Banner_Image',
      1 => '1736594379',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6783616a09a285_00761879 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.title.php','function'=>'smarty_function_title',),));
?>
<div class="banner_image"style="background:linear-gradient(90deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
              url(uploads<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['banner_img']->value,'\\','/');?>
);
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
              <?php if ($_smarty_tpl->tpl_vars['page_alias']->value != "technology") {?>
              background-attachment: fixed;
              <?php }?>
              ">
          
      <div class="container-fluid px-md-5 mb-2">
            <?php echo Navigator::nav_breadcrumbs(array(),$_smarty_tpl);?>

            <h2 class="h2 text-white">
            <?php ob_start();
echo smarty_function_title(array(),$_smarty_tpl);
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>$_prefixVariable1,'kh_txt'=>((string)$_smarty_tpl->tpl_vars['title_kh']->value)),$_smarty_tpl ) );?>

            </h2>
      </div>
 </div><?php }
}
