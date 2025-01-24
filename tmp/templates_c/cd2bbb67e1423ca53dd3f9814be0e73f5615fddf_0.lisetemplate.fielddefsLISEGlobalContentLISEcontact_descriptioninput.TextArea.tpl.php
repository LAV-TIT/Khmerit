<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:35:23
  from 'lisetemplate:fielddefs;LISEGlobalContent:LISE;contact_description;input.TextArea.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828fbbe489e1_05927150',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd2bbb67e1423ca53dd3f9814be0e73f5615fddf' => 
    array (
      0 => 'lisetemplate:fielddefs;LISEGlobalContent:LISE;contact_description;input.TextArea.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828fbbe489e1_05927150 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pageoverflow">
	<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetName();
if ($_smarty_tpl->tpl_vars['fielddef']->value->IsRequired()) {?>*<?php }?>:</p>
	<p class="pageinput">
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetDesc()) {?>(<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetDesc();?>
)<br /><?php }?>
		<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetInput($_smarty_tpl->tpl_vars['actionid']->value);?>

	</p>
</div><?php }
}
