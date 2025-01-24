<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:38
  from 'module_file_tpl:AceSyntax;ace_bottom.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828aa2d47459_86996048',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f0c16c5f0a37f48d48408653c24e581e4f6cb6e' => 
    array (
      0 => 'module_file_tpl:AceSyntax;ace_bottom.tpl',
      1 => 1732714756,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828aa2d47459_86996048 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="ace-ui-toolbar-bottom cf"><div class="ace-ui-bottom-left ace-left cf"><div class="ace-editor-cursor ace-editor-info-bottom ace-left" id="(ti)_ace-editor-cursor">&nbsp;</div><div class="ace-info-divider">&nbsp;</div><div class="ace-editor-cursor ace-editor-info-bottom ace-left" id="(ti)_ace-editor-linenum"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('total_lines');?>
: <span>&nbsp;</span></div><div class="ace-info-divider">&nbsp;</div><div class="ace-editor-token ace-editor-info-bottom ace-left" id="(ti)_ace-editor-token"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('current_token');?>
: <span>&nbsp;</span></div></div><div class="ace-ui-bottom-right ace-right cf"><ul class="ace-option-menu"><li><a aria-hidden="true" data-icon="&#xe010;" id="ace-editor-modes" class="ace-tooltip ace-tooltip-top-left ace-icon ace-option-icon ace-toggle-menu" href="#" data-tip="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('syntax_mode');?>
 "><span class="visuallyhidden"><?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('syntax_mode');?>
</span></a><ul id="(ti)_modes" class="ace-list cf"><?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mod']->value->AceGetModes(), 'value');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
$__foreach_value_0_saved = $_smarty_tpl->tpl_vars['value'];
?><li data-ace-mode="<?php echo $_smarty_tpl->tpl_vars['value']->key;?>
"<?php if ((isset($_smarty_tpl->tpl_vars['mode']->value)) && !empty($_smarty_tpl->tpl_vars['mode']->value) && $_smarty_tpl->tpl_vars['mode']->value == $_smarty_tpl->tpl_vars['value']->key) {?> class="ace-selected"<?php }?>><i class="ace-icon-checkmark-circle"></i> <?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</li><?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?></ul></li></ul></div></div><?php }
}
