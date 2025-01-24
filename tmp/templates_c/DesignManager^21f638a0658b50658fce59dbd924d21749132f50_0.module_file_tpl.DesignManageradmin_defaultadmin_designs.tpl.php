<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:36
  from 'module_file_tpl:DesignManager;admin_defaultadmin_designs.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828aa0713937_27219053',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '21f638a0658b50658fce59dbd924d21749132f50' => 
    array (
      0 => 'module_file_tpl:DesignManager;admin_defaultadmin_designs.tpl',
      1 => 1732710206,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828aa0713937_27219053 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.cms_action_url.php','function'=>'smarty_cms_function_cms_action_url',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\plugins\\function.admin_icon.php','function'=>'smarty_function_admin_icon',),2=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\function.cycle.php','function'=>'smarty_function_cycle',),));
?>
<div class="row">
  <div class="pageoptions options-menu half">
    <a accesskey="a" href="<?php echo smarty_cms_function_cms_action_url(array('action'=>'admin_edit_design'),$_smarty_tpl);?>
" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('create_design');?>
"><?php echo smarty_function_admin_icon(array('icon'=>'newobject.gif'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('create_design');?>
</a>&nbsp;&nbsp;
    <a accesskey="a" href="<?php echo smarty_cms_function_cms_action_url(array('action'=>'admin_import_design'),$_smarty_tpl);?>
" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('title_import_design');?>
"><?php echo smarty_function_admin_icon(array('icon'=>'import.gif'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('import_design');?>
</a>
  </div>
</div>

<?php if ((isset($_smarty_tpl->tpl_vars['list_designs']->value))) {?>
<table class="pagetable">
  <thead>
    <tr>
      <th width="5%"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_id');?>
</th>
      <th><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_name');?>
</th>
      <th class="pageicon"><span title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('title_designs_default');?>
"><?php echo lang('default');?>
</span></th>
      <th class="pageicon"></th>
      <th class="pageicon"></th>
      <th class="pageicon"></th>
    </tr>
  </thead>
  <tbody>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['list_designs']->value, 'design');
$_smarty_tpl->tpl_vars['design']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['design']->value) {
$_smarty_tpl->tpl_vars['design']->do_else = false;
?>
    <?php echo smarty_function_cycle(array('values'=>"row1,row2",'assign'=>'rowclass'),$_smarty_tpl);?>

    <?php echo smarty_cms_function_cms_action_url(array('action'=>'admin_edit_design','design'=>$_smarty_tpl->tpl_vars['design']->value->get_id(),'assign'=>'edit_url'),$_smarty_tpl);?>

    <?php echo smarty_cms_function_cms_action_url(array('action'=>'admin_delete_design','design'=>$_smarty_tpl->tpl_vars['design']->value->get_id(),'assign'=>'delete_url'),$_smarty_tpl);?>

    <?php echo smarty_cms_function_cms_action_url(array('action'=>'admin_export_design','design'=>$_smarty_tpl->tpl_vars['design']->value->get_id(),'assign'=>'export_url'),$_smarty_tpl);?>

    <tr class="<?php echo $_smarty_tpl->tpl_vars['rowclass']->value;?>
" onmouseover="this.className='<?php echo $_smarty_tpl->tpl_vars['rowclass']->value;?>
hover';" onmouseout="this.className='<?php echo $_smarty_tpl->tpl_vars['rowclass']->value;?>
';">
      <td><a href="<?php echo $_smarty_tpl->tpl_vars['edit_url']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('edit_design');?>
"><?php echo $_smarty_tpl->tpl_vars['design']->value->get_id();?>
</a></td>
      <td><a href="<?php echo $_smarty_tpl->tpl_vars['edit_url']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('edit_design');?>
"><?php echo $_smarty_tpl->tpl_vars['design']->value->get_name();?>
</a></td>
      <td>
        <?php if ($_smarty_tpl->tpl_vars['design']->value->get_default()) {?>
	  <?php echo smarty_function_admin_icon(array('icon'=>'true.gif','title'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_dflt')),$_smarty_tpl);?>

	<?php } else { ?>
	  <a href="<?php echo smarty_cms_function_cms_action_url(array('design_setdflt'=>$_smarty_tpl->tpl_vars['design']->value->get_id()),$_smarty_tpl);?>
"><?php echo smarty_function_admin_icon(array('icon'=>'false.gif','title'=>$_smarty_tpl->tpl_vars['mod']->value->Lang('prompt_setdflt_design')),$_smarty_tpl);?>
</a>
	<?php }?>
      </td>
      <td><a href="<?php echo $_smarty_tpl->tpl_vars['edit_url']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('edit_design');?>
"><?php echo smarty_function_admin_icon(array('icon'=>'edit.gif'),$_smarty_tpl);?>
</a></td>
      <td><a href="<?php echo $_smarty_tpl->tpl_vars['export_url']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('export_design');?>
"><?php echo smarty_function_admin_icon(array('icon'=>'export.gif'),$_smarty_tpl);?>
</a></td>
      <td>
        <?php if (!$_smarty_tpl->tpl_vars['design']->value->get_default()) {?>
          <a href="<?php echo $_smarty_tpl->tpl_vars['delete_url']->value;?>
" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('delete_design');?>
"><?php echo smarty_function_admin_icon(array('icon'=>'delete.gif'),$_smarty_tpl);?>
</a>
	<?php }?>
      </td>
    </tr>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </tbody>
</table>
<?php }
}
}
