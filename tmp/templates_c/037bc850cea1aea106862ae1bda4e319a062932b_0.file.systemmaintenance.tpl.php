<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:01
  from 'D:\xampp\htdocs\WEB\khmerit\admin\templates\systemmaintenance.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a7d7ed509_27854946',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '037bc850cea1aea106862ae1bda4e319a062932b' => 
    array (
      0 => 'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\templates\\systemmaintenance.tpl',
      1 => 1732710190,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a7d7ed509_27854946 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="pagecontainer">

<?php echo $_smarty_tpl->tpl_vars['theme']->value->StartTabHeaders();?>

	<?php echo $_smarty_tpl->tpl_vars['theme']->value->SetTabHeader('content',lang('sysmaintab_content'),(isset($_smarty_tpl->tpl_vars['active_content']->value)));?>

	<?php echo $_smarty_tpl->tpl_vars['theme']->value->SetTabHeader('database',lang('sysmaintab_database'),(isset($_smarty_tpl->tpl_vars['active_database']->value)));?>

	<?php if ((isset($_smarty_tpl->tpl_vars['changelog']->value))) {?>
		<?php echo $_smarty_tpl->tpl_vars['theme']->value->SetTabHeader('changelog',lang('sysmaintab_changelog'),(isset($_smarty_tpl->tpl_vars['active_changelog']->value)));?>

	<?php }
echo $_smarty_tpl->tpl_vars['theme']->value->EndTabHeaders();?>


<?php echo $_smarty_tpl->tpl_vars['theme']->value->StartTabContent();?>


	<?php echo $_smarty_tpl->tpl_vars['theme']->value->StartTab('content');?>

		<form action="<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
" method="post">
			<fieldset>
				<legend><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_cache_status' ));?>
&nbsp;</legend>
				<div class="pageoverflow">
					<p class="pagetext"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'clearcache' ));?>
:</p>
					<p class="pageinput">
						<input class="pagebutton" type="submit" name="clearcache" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'clear' ));?>
"/>
					</p>
				</div>
			</fieldset>
		</form>

		<fieldset>
			<legend><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_content_status' ));?>
&nbsp;</legend>
			<form action="<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
" method="post">
				<?php echo $_smarty_tpl->tpl_vars['pagecount']->value;?>
 <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_pagesfound' ));?>


				<div class="pageoverflow">
					<p class="pagetext"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_updatehierarchy' ));?>
:</p>
					<p class="pageinput">
						<input class="pagebutton" type="submit" name="updatehierarchy" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_update' ));?>
"/>
					</p>
				</div>
			</form>

			<form action="<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
" method="post">
				<div class="pageoverflow">
					<p class="pagetext"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_updateurls' ));?>
:</p>
					<p class="pageinput">
						<input class="pagebutton" type="submit" name="updateurls" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_update' ));?>
"/>
					</p>
				</div>
			</form>

			<?php if ($_smarty_tpl->tpl_vars['withoutaliascount']->value != "0") {?>
				<form action="<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
" method="post" onsubmit="return confirm('<?php echo strtr((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_confirmfixaliases' )), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
')" >
					<div class="pageoverflow">
						<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['withoutaliascount']->value;?>
 <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_pagesmissinalias' ));?>
:</p>
						<p class="pageinput">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagesmissingalias']->value, 'page');
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
?>
								 <?php echo $_smarty_tpl->tpl_vars['page']->value['content_name'];?>
<br/>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							<br />
							<input class="pagebutton" type="submit" name="addaliases" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_fixaliases' ));?>
"/>
						</p>
					</div>
				</form>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['invalidtypescount']->value != "0") {?>
				<form action="<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
" method="post" onsubmit="return confirm('<?php echo strtr((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_confirmfixtypes' )), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
')" >
					<div class="pageoverflow">
						<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['invalidtypescount']->value;?>
 <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_pagesinvalidtypes' ));?>
:</p>
						<p class="pageinput">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pageswithinvalidtype']->value, 'page');
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
?>
								<?php echo $_smarty_tpl->tpl_vars['page']->value['content_name'];?>
 <em>(<?php echo $_smarty_tpl->tpl_vars['page']->value['content_alias'];?>
) - <?php echo $_smarty_tpl->tpl_vars['page']->value['type'];?>
</em><br/>
							<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
							<br />
							<input class="pagebutton" type="submit" name="fixtypes" value="<?php echo strtr((string)call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_fixtypes' )), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
"/>
						</p>
					</div>
				</form>
			<?php }?>

			<?php if ($_smarty_tpl->tpl_vars['invalidtypescount']->value == "0" && $_smarty_tpl->tpl_vars['withoutaliascount']->value == '') {?>
				<p class='green'><strong><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_nocontenterrors' ));?>
</strong></p>
			<?php }?>

		</fieldset>
	<?php echo $_smarty_tpl->tpl_vars['theme']->value->EndTab();?>


	<?php echo $_smarty_tpl->tpl_vars['theme']->value->StartTab('database');?>

		<form action="<?php echo $_smarty_tpl->tpl_vars['formurl']->value;?>
" method="post">
			<fieldset>
				<legend><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_database_status' ));?>
:&nbsp;</legend>
				<p><?php echo $_smarty_tpl->tpl_vars['tablecount']->value;?>
 <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_tablesfound',$_smarty_tpl->tpl_vars['nonseqcount']->value ));?>
</p>

				<?php if ($_smarty_tpl->tpl_vars['errorcount']->value == 0) {?>
					<p class='green'><strong><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_nostr_errors' ));?>
</strong></p>
				<?php } else { ?>
					<p class='red'><strong><?php echo $_smarty_tpl->tpl_vars['errorcount']->value;?>
 <?php if ($_smarty_tpl->tpl_vars['errorcount']->value > 1) {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_str_errors' ));
} else {
echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_str_error' ));
}?>:  <?php echo $_smarty_tpl->tpl_vars['errortables']->value;?>
</strong></p>
				<?php }?>

				<div class="pageoverflow">
					<p class="pagetext"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_optimizetables' ));?>
:</p>
					<p class="pageinput">
						<input class="pagebutton" type="submit" name="optimizeall" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_optimize' ));?>
"/>
					</p>
				</div>
				<div class="pageoverflow">
					<p class="pagetext"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_repairtables' ));?>
:</p>
					<p class="pageinput">
						<input class="pagebutton" type="submit" name="repairall" value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'sysmain_repair' ));?>
"/>
					</p>
				</div>
			</fieldset>
		</form>
	<?php echo $_smarty_tpl->tpl_vars['theme']->value->EndTab();?>


	<?php if ((isset($_smarty_tpl->tpl_vars['changelog']->value))) {?>
		<?php echo $_smarty_tpl->tpl_vars['theme']->value->StartTab('changelog');?>

			<p class='file'><?php echo $_smarty_tpl->tpl_vars['changelogfilename']->value;?>
</p>
			<div class="changelog"><?php echo $_smarty_tpl->tpl_vars['changelog']->value;?>
</div>
		<?php echo $_smarty_tpl->tpl_vars['theme']->value->EndTab();?>

	<?php }?>

<?php echo $_smarty_tpl->tpl_vars['theme']->value->EndTabContent();?>


</div><?php }
}
