<?php
/* Smarty version 4.5.2, created on 2025-01-12 17:04:43
  from 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;tags;input.Tags.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_678393bb6e21a0_04785900',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa51908a9d5939ab366d79c94afd0a98a6c008ed' => 
    array (
      0 => 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;tags;input.Tags.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678393bb6e21a0_04785900 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pageoverflow">
	<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetName();
if ($_smarty_tpl->tpl_vars['fielddef']->value->IsRequired()) {?>*<?php }?>:</p>
	<p class="pageinput">
  <?php echo '<script'; ?>
>
      $(function(){ 
          $("input.tags").tagsInput({
            width:'auto'
          });
      });
  <?php echo '</script'; ?>
>
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetDesc()) {?>(<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetDesc();?>
)<br /><?php }?>
		<input type="text" class='tags' name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
]" value="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetValue();?>
" size="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('size');?>
" maxlength="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('max_length');?>
" />
	</p>
</div><?php }
}
