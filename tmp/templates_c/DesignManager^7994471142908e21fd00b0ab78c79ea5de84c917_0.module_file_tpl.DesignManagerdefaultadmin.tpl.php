<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:34
  from 'module_file_tpl:DesignManager;defaultadmin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a9ec3d506_27106262',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7994471142908e21fd00b0ab78c79ea5de84c917' => 
    array (
      0 => 'module_file_tpl:DesignManager;defaultadmin.tpl',
      1 => 1732710206,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
    'module_file_tpl:DesignManager;admin_defaultadmin_templates.tpl' => 1,
    'module_file_tpl:DesignManager;admin_defaultadmin_stylesheets.tpl' => 1,
    'module_file_tpl:DesignManager;admin_defaultadmin_designs.tpl' => 1,
    'module_file_tpl:DesignManager;admin_defaultadmin_types.tpl' => 1,
    'module_file_tpl:DesignManager;admin_defaultadmin_categories.tpl' => 1,
  ),
),false)) {
function content_67828a9ec3d506_27106262 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\plugins\\function.tab_header.php','function'=>'smarty_function_tab_header',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\plugins\\function.tab_start.php','function'=>'smarty_function_tab_start',),2=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\plugins\\function.tab_end.php','function'=>'smarty_function_tab_end',),));
echo '<script'; ?>
 type="text/javascript">
$(document).ready(function(){
  $('img.viewhelp').click(function(){
    var n = $(this).attr('name');
    $('#'+n).dialog();
  });

  $(document).on('click','#clearlocks,#cssclearlocks',function(ev){
     var url = $(this).attr('href');
     ev.preventDefault();
     cms_confirm('<?php echo strtr((string)$_smarty_tpl->tpl_vars['mod']->value->Lang('confirm_clearlocks'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
').done(function(){
       window.location = url;
     })
  });
});
<?php echo '</script'; ?>
>

<?php echo smarty_function_tab_header(array('name'=>'templates','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_templates')),$_smarty_tpl);?>


<?php if ($_smarty_tpl->tpl_vars['manage_stylesheets']->value) {?>
	<?php echo smarty_function_tab_header(array('name'=>'stylesheets','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_stylesheets')),$_smarty_tpl);?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['manage_designs']->value) {?>
	<?php echo smarty_function_tab_header(array('name'=>'designs','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_designs')),$_smarty_tpl);?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['manage_templates']->value) {?>
	<?php echo smarty_function_tab_header(array('name'=>'types','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_templatetypes')),$_smarty_tpl);?>

	<?php echo smarty_function_tab_header(array('name'=>'categories','label'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_categories')),$_smarty_tpl);?>

<?php }?>

<?php echo smarty_function_tab_start(array('name'=>'templates'),$_smarty_tpl);?>

<?php $_smarty_tpl->_subTemplateRender('module_file_tpl:DesignManager;admin_defaultadmin_templates.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 8, false);
?>

<?php if ($_smarty_tpl->tpl_vars['manage_stylesheets']->value) {?>
	<?php echo smarty_function_tab_start(array('name'=>'stylesheets'),$_smarty_tpl);?>

	<?php $_smarty_tpl->_subTemplateRender('module_file_tpl:DesignManager;admin_defaultadmin_stylesheets.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 8, false);
}?>

<?php if ($_smarty_tpl->tpl_vars['manage_designs']->value) {?>
	<?php echo smarty_function_tab_start(array('name'=>'designs'),$_smarty_tpl);?>

	<?php $_smarty_tpl->_subTemplateRender('module_file_tpl:DesignManager;admin_defaultadmin_designs.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 8, false);
}?>

<?php if ($_smarty_tpl->tpl_vars['manage_templates']->value) {?>
	<?php echo smarty_function_tab_start(array('name'=>'types'),$_smarty_tpl);?>

	<?php $_smarty_tpl->_subTemplateRender('module_file_tpl:DesignManager;admin_defaultadmin_types.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 8, false);
?>
	<?php echo smarty_function_tab_start(array('name'=>'categories'),$_smarty_tpl);?>

	<?php $_smarty_tpl->_subTemplateRender('module_file_tpl:DesignManager;admin_defaultadmin_categories.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 8, false);
}?>

<?php echo smarty_function_tab_end(array(),$_smarty_tpl);
}
}
