<?php
/* Smarty version 4.5.2, created on 2025-01-12 17:04:43
  from 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;description;input.TextArea.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_678393bb1fd3b7_98994103',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'caf0f5af240473fbb0755bee70089d4cd9e2d4be' => 
    array (
      0 => 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;description;input.TextArea.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678393bb1fd3b7_98994103 (Smarty_Internal_Template $_smarty_tpl) {
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
