<?php
/* Smarty version 4.5.2, created on 2025-01-12 17:04:42
  from 'lisetemplate:instance;LISEMediaSolutions;admin_edit_item_buttons.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_678393ba6fe2b8_74061903',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0eddd62fa42117b94aed96b7d91a917dc4753fad' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;admin_edit_item_buttons.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678393ba6fe2b8_74061903 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.cms_action_url.php','function'=>'smarty_cms_function_cms_action_url',),));
?>
<div class="pageoverflow">
  <p class="pageinput">
    <?php $_smarty_tpl->_assignInScope('show_opts', 0);?>
    <?php if ($_smarty_tpl->tpl_vars['previous_id']->value > 0 && (($tmp = $_smarty_tpl->tpl_vars['itemObject']->value->item_id ?? null)===null||$tmp==='' ? -1 ?? null : $tmp) > 0) {
$_smarty_tpl->_assignInScope('show_opts', 1);?>
      <a
        title="<?php echo lang('previous');?>
"
        class="ui-button ui-widget ui-state-default ui-corner-all lise-previous-next edit-previous"
        href="<?php echo smarty_cms_function_cms_action_url(array('action'=>'admin_edititem','item_id'=>$_smarty_tpl->tpl_vars['previous_id']->value),$_smarty_tpl);?>
">
        <span class="ui-icon ui-button-icon-primary ui-icon-triangle-1-w"
              style="position:relative;top:50%;margin-top:-8px"
        ></span>
      </a>
    <?php }?>
    <input name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
cancel" class="lise_cancel" value="<?php echo lang('cancel');?>
" type="submit" />
    <?php if ((($tmp = $_smarty_tpl->tpl_vars['itemObject']->value->item_id ?? null)===null||$tmp==='' ? -1 ?? null : $tmp) > 0) {?>
      <input name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
apply" class="lise_apply" value="<?php echo lang('apply');?>
" type="submit" />
    <?php }?>
    <input name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
save_create" class="lise_save_create" value="<?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('save_create');?>
" type="submit" />
    <input name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
submit" class="lise_submit" value="<?php echo lang('submit');?>
" type="submit" />
  <?php if ($_smarty_tpl->tpl_vars['next_id']->value > 0 && (($tmp = $_smarty_tpl->tpl_vars['itemObject']->value->item_id ?? null)===null||$tmp==='' ? -1 ?? null : $tmp) > 0) {
$_smarty_tpl->_assignInScope('show_opts', 1);?>

     <a
      title="<?php echo lang('next');?>
"
      class="ui-button ui-widget ui-state-default ui-corner-all lise-previous-next edit-next"
      href="<?php echo smarty_cms_function_cms_action_url(array('action'=>'admin_edititem','item_id'=>$_smarty_tpl->tpl_vars['next_id']->value),$_smarty_tpl);?>
">
      <span class="ui-icon ui-icon-triangle-1-e"
            style="position:relative;top:50%;margin-top:-8px"
      ></span>
    </a>

    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['show_opts']->value) {?>
      <a
        title="<?php echo lang('options');?>
"
        class="ui-button ui-widget ui-state-default ui-corner-all lise-editor-options">
      <span class="ui-icon ui-icon-gear"
            style="position:relative;top:50%;margin-top:-8px"
      ></span>
    </a>
    <?php }?>
  </p>
</div><?php }
}
