<?php
/* Smarty version 4.5.2, created on 2025-01-12 00:46:08
  from 'module_file_tpl:CMSContentManager;admin_bulk_delete.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782ae60f22823_05514431',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '766bc2ecaff800f694244595680a1e5c18b9d379' => 
    array (
      0 => 'module_file_tpl:CMSContentManager;admin_bulk_delete.tpl',
      1 => 1732710204,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6782ae60f22823_05514431 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.form_start.php','function'=>'smarty_function_form_start',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.form_end.php','function'=>'smarty_function_form_end',),));
?>
<h3><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_bulk_delete_content');?>
:</h3>
<h4><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_bulk_delete_content2');?>
:</h4>

<?php echo smarty_function_form_start(array('multicontent'=>$_smarty_tpl->tpl_vars['multicontent']->value),$_smarty_tpl);?>

<div class="pageoverflow">
	<ul>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['displaydata']->value, 'rec');
$_smarty_tpl->tpl_vars['rec']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['rec']->value) {
$_smarty_tpl->tpl_vars['rec']->do_else = false;
?>
		<li>(<?php echo $_smarty_tpl->tpl_vars['rec']->value['id'];?>
) : <?php echo $_smarty_tpl->tpl_vars['rec']->value['name'];?>
 <em>(<?php echo $_smarty_tpl->tpl_vars['rec']->value['alias'];?>
)</em></li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ul>
</div>

<div class="pageoverflow">
	<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_confirm_operation');?>
:</p>
	<p class="pageinput">
		<input type="checkbox" id="confirm1" value="1" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
confirm1">
		&nbsp; <label for="confirm1"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_confirm1');?>
</label>
		<br/>
		<input type="checkbox" id="confirm2" value="1" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
confirm2">
		&nbsp; <label for="confirm2"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_confirm2');?>
</label></p>
</div>

<div class="pageoverflow">
	<p class="pagetext"></p>
	<p class="pageinput">
		<input type="submit" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
submit" value="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('submit');?>
"/>
		<input type="submit" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
cancel" value="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('cancel');?>
"/>
	</p>
</div>
<?php echo smarty_function_form_end(array(),$_smarty_tpl);
}
}
