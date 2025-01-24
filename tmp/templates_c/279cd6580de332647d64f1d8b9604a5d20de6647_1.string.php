<?php
/* Smarty version 4.5.2, created on 2025-01-12 13:00:41
  from '279cd6580de332647d64f1d8b9604a5d20de6647' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67835a894558f7_78011414',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '279cd6580de332647d64f1d8b9604a5d20de6647' => 
    array (
      0 => '279cd6580de332647d64f1d8b9604a5d20de6647',
      1 => true,
      2 => 'string',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67835a894558f7_78011414 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
if (!empty($_smarty_tpl->tpl_vars['description']->value)) {?>
        <?php echo $_smarty_tpl->tpl_vars['description']->value;?>
<br>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['is_sub_field']->value) {?>
    <?php if (is_null($_smarty_tpl->tpl_vars['sub_row_number']->value)) {?>        <input type="text" id="" name="" class="<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
" value="" size="<?php echo $_smarty_tpl->tpl_vars['size']->value;?>
" maxlength="<?php echo $_smarty_tpl->tpl_vars['max_length']->value;?>
" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" data-field-name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
"/>

    <?php } else { ?>    
        <input type="text" id="<?php echo $_smarty_tpl->tpl_vars['subFieldId']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['subFieldName']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value, ENT_QUOTES, 'UTF-8', true);?>
" size="<?php echo $_smarty_tpl->tpl_vars['size']->value;?>
" maxlength="<?php echo $_smarty_tpl->tpl_vars['max_length']->value;?>
"/>

    <?php }?>

<?php } elseif (!$_smarty_tpl->tpl_vars['repeater']->value) {?>
    <?php if (!$_smarty_tpl->tpl_vars['use_json_format']->value) {?>
        <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
" size="<?php echo $_smarty_tpl->tpl_vars['size']->value;?>
" maxlength="<?php echo $_smarty_tpl->tpl_vars['max_length']->value;?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value, ENT_QUOTES, 'UTF-8', true);?>
"/>

    <?php } else { ?>
        <input type="text" name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
[]" size="<?php echo $_smarty_tpl->tpl_vars['size']->value;?>
" maxlength="<?php echo $_smarty_tpl->tpl_vars['max_length']->value;?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['values']->value[0], ENT_QUOTES, 'UTF-8', true);?>
"/>
    <?php }?>

<?php } else { ?>    <?php if (empty($_smarty_tpl->tpl_vars['assign']->value) && $_smarty_tpl->tpl_vars['field_alias_used']->value != 'input_repeater') {?>
        <div class="pagewarning">
            <?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('error_assign_required');?>

        </div><br>
    <?php }?>
        
        <div id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" class="ecb_repeater sortable" data-block-name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
" data-highest-row="<?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['values']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['max_blocks']->value > 0) {?>data-max-blocks="<?php echo $_smarty_tpl->tpl_vars['max_blocks']->value;?>
"<?php }?> data-repeater-add="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater-add">
        
            <div class="repeater-wrapper-template sortable-item" style="display:none;">
                <div class="left-panel handle">
                    <span class="ecb2-icon-grip-dots-vertical-solid"></span>
                </div>
                <input id="" name="" class="repeater-field" size="<?php echo $_smarty_tpl->tpl_vars['size']->value;?>
" maxlength="<?php echo $_smarty_tpl->tpl_vars['max_length']->value;?>
" value="" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater"/>
                <div class="right-panel">
                    <button class="ecb2-repeater-remove ecb2-btn ecb2-btn-default ecb2-icon-only" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('remove_line');?>
" role="button" aria-disabled="false"><span class="ecb2-icon-trash-can-regular"></span></button>
                </div>
            </div>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['values']->value, 'value');
$_smarty_tpl->tpl_vars['value']->iteration = 0;
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
$_smarty_tpl->tpl_vars['value']->iteration++;
$__foreach_value_0_saved = $_smarty_tpl->tpl_vars['value'];
?>
            <div class="repeater-wrapper sortable-item">
                <div class="left-panel handle">
                    <span class="ecb2-icon-grip-dots-vertical-solid"></span>
                </div>
                <input id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
_r_<?php echo $_smarty_tpl->tpl_vars['value']->iteration;?>
" name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
[r_<?php echo $_smarty_tpl->tpl_vars['value']->iteration;?>
]" class="repeater-field" size="<?php echo $_smarty_tpl->tpl_vars['size']->value;?>
" maxlength="<?php echo $_smarty_tpl->tpl_vars['max_length']->value;?>
" value="<?php echo htmlspecialchars((string)$_smarty_tpl->tpl_vars['value']->value, ENT_QUOTES, 'UTF-8', true);?>
" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater"/>
                <div class="right-panel">
                    <button class="ecb2-repeater-remove ecb2-btn ecb2-btn-default ecb2-icon-only" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('remove_line');?>
" role="button" aria-disabled="false"><span class="ecb2-icon-trash-can-regular"></span></button>
                </div>
            </div>
        <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        </div>

        <div class="ecb_repeater_footer">
            <button id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater-add" class="ecb2-repeater-add ecb2-btn ecb2-btn-default" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('add_line');?>
" role="button" <?php if (!empty($_smarty_tpl->tpl_vars['max_blocks']->value) && smarty_modifier_count($_smarty_tpl->tpl_vars['values']->value) >= $_smarty_tpl->tpl_vars['max_blocks']->value) {?> disabled aria-disabled="true"<?php } else { ?>aria-disabled="false"<?php }?>><span class="ecb2-icon-plus"></span>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('add_item');?>
</button>
        </div>

<?php }
}
}
