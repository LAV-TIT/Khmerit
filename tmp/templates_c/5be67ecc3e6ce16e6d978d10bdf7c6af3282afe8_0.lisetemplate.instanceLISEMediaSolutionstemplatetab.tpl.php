<?php
/* Smarty version 4.5.2, created on 2025-01-12 00:36:38
  from 'lisetemplate:instance;LISEMediaSolutions;templatetab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782ac26b5de28_98744110',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5be67ecc3e6ce16e6d978d10bdf7c6af3282afe8' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;templatetab.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6782ac26b5de28_98744110 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\function.cycle.php','function'=>'smarty_function_cycle',),));
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'templates', false, 'section');
$_smarty_tpl->tpl_vars['templates']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['section']->value => $_smarty_tpl->tpl_vars['templates']->value) {
$_smarty_tpl->tpl_vars['templates']->do_else = false;
?>

	<fieldset>
		<?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'default', 'section_lang', null);
echo $_smarty_tpl->tpl_vars['section']->value;?>
templates<?php $_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
		<legend><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang($_smarty_tpl->tpl_vars['section_lang']->value);?>
</legend>

		<?php if (count($_smarty_tpl->tpl_vars['templates']->value) > 0) {?>
		<table cellspacing="0" class="pagetable">
			<thead>
				<tr>
					<th><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('template');?>
</th>				
					<th class="pageicon"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'default' ));?>
</th>
					<th class="pageicon">&nbsp;</th>
					<th class="pageicon">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['templates']->value, 'entry');
$_smarty_tpl->tpl_vars['entry']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->do_else = false;
?>
				<tr class="<?php echo smarty_function_cycle(array('values'=>'row1,row2','name'=>'summary'),$_smarty_tpl);?>
">
					<td><?php echo $_smarty_tpl->tpl_vars['entry']->value->link;?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['entry']->value->default;?>
</td>
					<td><?php echo $_smarty_tpl->tpl_vars['entry']->value->edit;?>
</td>
					<td class="init-ajax-delete"><?php echo (($tmp = $_smarty_tpl->tpl_vars['entry']->value->delete ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</td>
				</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</tbody>
		</table>
		<?php }?>

		<div class="pageoptions"><?php echo $_smarty_tpl->tpl_vars['addlinks']->value[$_smarty_tpl->tpl_vars['section']->value];?>
</div>
	</fieldset>	
	
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
