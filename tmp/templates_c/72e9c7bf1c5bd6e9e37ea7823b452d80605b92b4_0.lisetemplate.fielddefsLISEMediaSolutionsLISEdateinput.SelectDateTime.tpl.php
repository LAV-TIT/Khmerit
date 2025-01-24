<?php
/* Smarty version 4.5.2, created on 2025-01-12 17:04:43
  from 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;date;input.SelectDateTime.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_678393bb40cca0_30323034',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72e9c7bf1c5bd6e9e37ea7823b452d80605b92b4' => 
    array (
      0 => 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;date;input.SelectDateTime.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678393bb40cca0_30323034 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pageoverflow">
	<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetName();
if ($_smarty_tpl->tpl_vars['fielddef']->value->IsRequired()) {?>*<?php }?>:</p>
	<p class="pageinput">
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetDesc()) {?>(<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetDesc();?>
)<br /><?php }?>
		<input type="text" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
]" id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
]" value="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetValue();?>
" size="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('size');?>
" />
	</p>
	
	<?php echo '<script'; ?>
 type="text/javascript">
	jQuery(document).ready(function($) {
		$("#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield\\\[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
\\\]")
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('format_type') == 1) {?> 		.datepicker({
			dateFormat: "<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('date_format');?>
"
		});		
		<?php } elseif ($_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('format_type') == 2) {?> 		.timepicker({
			timeFormat: "<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('time_format');?>
",
			<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('show_seconds')) {?>showSecond: true,<?php }?>
			hourGrid: 4,
			minuteGrid: 10,
			secondGrid: 10			
		});
		<?php } else { ?> 		.datetimepicker({
			dateFormat: "<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('date_format');?>
",
			timeFormat: "<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('time_format');?>
",
			<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('show_seconds')) {?>showSecond: true,<?php }?>
			hourGrid: 4,
			minuteGrid: 10,
			secondGrid: 10
		});		
		<?php }?>
	});
	<?php echo '</script'; ?>
>
	
</div><?php }
}
