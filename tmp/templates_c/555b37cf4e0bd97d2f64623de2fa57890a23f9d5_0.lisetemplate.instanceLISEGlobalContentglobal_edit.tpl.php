<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:35:23
  from 'lisetemplate:instance;LISEGlobalContent;global_edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828fbb0dd9e0_58265345',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '555b37cf4e0bd97d2f64623de2fa57890a23f9d5' => 
    array (
      0 => 'lisetemplate:instance;LISEGlobalContent;global_edit.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828fbb0dd9e0_58265345 (Smarty_Internal_Template $_smarty_tpl) {
echo $_smarty_tpl->tpl_vars['startform']->value;?>

  <div class="pageoverflow">
    <p class="pageinput">
      <input name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
apply" class="lise_apply" value="<?php echo lang('apply');?>
" type="submit" />
    </p>
  </div>
  <!-- start tab -->
  <div id="page_tabs">
    <div id="edititem">
      <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'lang' ][ 0 ], array( 'settings' ));?>

    </div>
      <?php if ((((($tmp = $_smarty_tpl->tpl_vars['itemObject']->value ?? null)===null||$tmp==='' ? array() ?? null : $tmp) !== null ))) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['itemObject']->value->fielddefs, 'fielddef');
$_smarty_tpl->tpl_vars['fielddef']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fielddef']->value) {
$_smarty_tpl->tpl_vars['fielddef']->do_else = false;
?>
          <?php if ($_smarty_tpl->tpl_vars['fielddef']->value->type === 'Tabs') {?>
            <?php echo $_smarty_tpl->tpl_vars['fielddef']->value->displayTabHeader();?>

          <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      <?php }?>
  </div>
  <!-- end tab //-->
  <!-- start content -->
  <div id="page_content">
    <div id="edititem_result"></div>
    <div id="edititem_c">
      <?php if ((((($tmp = $_smarty_tpl->tpl_vars['itemObject']->value ?? null)===null||$tmp==='' ? array() ?? null : $tmp) !== null ))) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['itemObject']->value->fielddefs, 'fielddef');
$_smarty_tpl->tpl_vars['fielddef']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fielddef']->value) {
$_smarty_tpl->tpl_vars['fielddef']->do_else = false;
?>
          <?php echo $_smarty_tpl->tpl_vars['fielddef']->value->RenderInput($_smarty_tpl->tpl_vars['actionid']->value,$_smarty_tpl->tpl_vars['returnid']->value);?>

        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      <?php }?>

    </div>
  </div>

  <div class="pageoverflow">
    <p class="pagetext">&nbsp;</p>
    <p class="pageinput">
      <input name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
apply" class="lise_apply" value="<?php echo lang('apply');?>
" type="submit" />
    </p>
  </div>
<?php echo $_smarty_tpl->tpl_vars['endform']->value;?>


<?php }
}
