<?php
/* Smarty version 4.5.2, created on 2025-01-12 17:04:42
  from 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;;input.JQueryMultiSelect.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_678393baeab5e5_75010319',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31e68478a1c5893893be5d61e1b96ccbb3bd4f78' => 
    array (
      0 => 'lisetemplate:fielddefs;LISEMediaSolutions:LISE;;input.JQueryMultiSelect.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678393baeab5e5_75010319 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<div class="pageoverflow">
	<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetName();
if ($_smarty_tpl->tpl_vars['fielddef']->value->IsRequired()) {?>*<?php }?>:</p>
	<p class="pageinput">
		<?php if ($_smarty_tpl->tpl_vars['fielddef']->value->GetDesc()) {?>(<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetDesc();?>
)<br /><?php }?>
    <div class="ms-container">
      <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
]" value="" />
      <select id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield[<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
][]}" size="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('size',5);?>
" multiple>
        <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['fielddef']->value->GetOptions(),'selected'=>$_smarty_tpl->tpl_vars['fielddef']->value->GetValue("array")),$_smarty_tpl);?>

		  </select>
    </div>
	</p>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
  $('#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
customfield<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
').multiSelect();
<?php echo '</script'; ?>
><?php }
}
