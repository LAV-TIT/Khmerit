<?php
/* Smarty version 4.5.2, created on 2025-01-12 17:04:42
  from 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;thumbnail;input.CoreFilePicker.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_678393baa24b27_83396892',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8f6205183ae0561512bbb88cba22e11719570e7b' => 
    array (
      0 => 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;thumbnail;input.CoreFilePicker.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678393baa24b27_83396892 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\plugins\\function.cms_filepicker.php','function'=>'smarty_function_cms_filepicker',),));
?>
<div class="pageoverflow">
	<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetName();
if ($_smarty_tpl->tpl_vars['fielddef']->value->IsRequired()) {?>*<?php }?>:</p>
	<p class="pageinput">
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetDesc()) {?>(<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetDesc();?>
)<br /><?php }?>
    <?php echo smarty_function_cms_filepicker(array('name'=>((string)$_smarty_tpl->tpl_vars['actionid']->value)."customfield[".((string)$_smarty_tpl->tpl_vars['fielddef']->value->GetId())."]",'profile'=>$_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('profiles'),'value'=>$_smarty_tpl->tpl_vars['fielddef']->value->GetValue(),'required'=>$_smarty_tpl->tpl_vars['fielddef']->value->IsRequired()),$_smarty_tpl);?>

	</p>
</div><?php }
}
