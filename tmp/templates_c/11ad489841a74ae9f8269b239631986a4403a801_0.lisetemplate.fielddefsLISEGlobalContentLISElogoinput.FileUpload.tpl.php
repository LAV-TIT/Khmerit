<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:35:23
  from 'lisetemplate:fielddefs;LISEGlobalContent:LISE;logo;input.FileUpload.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828fbb5d9826_57417705',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11ad489841a74ae9f8269b239631986a4403a801' => 
    array (
      0 => 'lisetemplate:fielddefs;LISEGlobalContent:LISE;logo;input.FileUpload.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828fbb5d9826_57417705 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pageoverflow">
	<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetName();
if ($_smarty_tpl->tpl_vars['fielddef']->value->IsRequired()) {?>*<?php }?>:</p>
	<p class="pageinput">
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetDesc()) {?>(<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetDesc();?>
)<br /><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->HasValue()) {?><em><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('value');?>
: <?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetValue();?>
</em><br /><?php }?>
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('image')) {
echo $_smarty_tpl->tpl_vars['fielddef']->value->RenderForAdminListing($_smarty_tpl->tpl_vars['actionid']->value,$_smarty_tpl->tpl_vars['returnid']->value);
}?>
		<input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
]" value="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetValue();?>
" />
		<input type="file" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
]" size="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('size');?>
"><?php if (!$_smarty_tpl->tpl_vars['fielddef']->value->IsRequired() && $_smarty_tpl->tpl_vars['fielddef']->value->HasValue()) {?><!--
		--><input type="checkbox" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
delete_customfield[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
]" value="delete" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('delete');?>
" /><?php }?>
	</p>
</div><?php }
}
