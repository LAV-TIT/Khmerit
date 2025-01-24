<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:35:24
  from 'lisetemplate:fielddefs;LISEGlobalContent:LISE;facebook_link;input.TextInput.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828fbc0808d8_10764739',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '072191ff644e7f8cb34fdae7abe05e9840964ae8' => 
    array (
      0 => 'lisetemplate:fielddefs;LISEGlobalContent:LISE;facebook_link;input.TextInput.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828fbc0808d8_10764739 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pageoverflow">
	<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetName();
if ($_smarty_tpl->tpl_vars['fielddef']->value->IsRequired()) {?>*<?php }?>:</p>
	<p class="pageinput">
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetDesc()) {?>(<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetDesc();?>
)<br /><?php }?>
		<input type="text" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
]" value="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetValue();?>
" size="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('size');?>
" maxlength="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('max_length');?>
" />
	</p>
</div><?php }
}
