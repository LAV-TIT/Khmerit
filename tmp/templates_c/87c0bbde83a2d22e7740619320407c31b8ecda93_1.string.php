<?php
/* Smarty version 4.5.2, created on 2025-01-12 13:00:42
  from '87c0bbde83a2d22e7740619320407c31b8ecda93' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67835a8ac3ca24_63692536',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87c0bbde83a2d22e7740619320407c31b8ecda93' => 
    array (
      0 => '87c0bbde83a2d22e7740619320407c31b8ecda93',
      1 => true,
      2 => 'string',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67835a8ac3ca24_63692536 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.cms_textarea.php','function'=>'smarty_function_cms_textarea',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
if (!empty($_smarty_tpl->tpl_vars['description']->value)) {?>
        <?php echo $_smarty_tpl->tpl_vars['description']->value;?>
<br>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['is_sub_field']->value) {?>      
    <?php if (is_null($_smarty_tpl->tpl_vars['sub_row_number']->value)) {?>        <textarea id="" name="" class="<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
" cols="<?php echo $_smarty_tpl->tpl_vars['cols']->value;?>
" rows="<?php echo $_smarty_tpl->tpl_vars['rows']->value;?>
" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" data-field-name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['wysiwyg']->value) {?>style="display:none;"<?php }?>></textarea>

    <?php } else { ?>    
        <?php echo smarty_function_cms_textarea(array('id'=>$_smarty_tpl->tpl_vars['subFieldId']->value,'name'=>$_smarty_tpl->tpl_vars['subFieldName']->value,'enablewysiwyg'=>$_smarty_tpl->tpl_vars['wysiwyg']->value,'rows'=>$_smarty_tpl->tpl_vars['rows']->value,'cols'=>$_smarty_tpl->tpl_vars['cols']->value,'value'=>$_smarty_tpl->tpl_vars['value']->value,'class'=>$_smarty_tpl->tpl_vars['class']->value),$_smarty_tpl);?>


    <?php }?>

<?php } elseif (!$_smarty_tpl->tpl_vars['repeater']->value && !$_smarty_tpl->tpl_vars['use_json_format']->value) {?>
        <?php echo smarty_function_cms_textarea(array('name'=>$_smarty_tpl->tpl_vars['block_name']->value,'enablewysiwyg'=>$_smarty_tpl->tpl_vars['wysiwyg']->value,'rows'=>$_smarty_tpl->tpl_vars['rows']->value,'cols'=>$_smarty_tpl->tpl_vars['cols']->value,'value'=>$_smarty_tpl->tpl_vars['value']->value,'class'=>'wysiwyg'),$_smarty_tpl);?>


<?php } elseif (!$_smarty_tpl->tpl_vars['repeater']->value && $_smarty_tpl->tpl_vars['use_json_format']->value) {?>
        <?php echo smarty_function_cms_textarea(array('name'=>((string)$_smarty_tpl->tpl_vars['block_name']->value)."[]",'enablewysiwyg'=>$_smarty_tpl->tpl_vars['wysiwyg']->value,'rows'=>$_smarty_tpl->tpl_vars['rows']->value,'cols'=>$_smarty_tpl->tpl_vars['cols']->value,'value'=>$_smarty_tpl->tpl_vars['values']->value[0],'class'=>$_smarty_tpl->tpl_vars['class']->value),$_smarty_tpl);?>


<?php } else { ?>    <?php if (empty($_smarty_tpl->tpl_vars['assign']->value) && !((isset($_smarty_tpl->tpl_vars['field_alias_used']->value)) && $_smarty_tpl->tpl_vars['field_alias_used']->value == 'input_repeater')) {?>
        <div class="pagewarning">
            <?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('error_assign_required');?>

        </div><br>
    <?php }?>
        
        <div id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" class="ecb_repeater sortable <?php if ($_smarty_tpl->tpl_vars['wysiwyg']->value) {?>wysiwyg<?php }?>" data-block-name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
" data-highest-row="<?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['values']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['max_blocks']->value > 0) {?>data-max-blocks="<?php echo $_smarty_tpl->tpl_vars['max_blocks']->value;?>
"<?php }?> data-repeater-add="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater-add">

            <div class="repeater-wrapper-template sortable-item" style="display:none;">
                <div class="left-panel handle">
                    <span class="ecb2-icon-grip-dots-vertical-solid"></span>
                </div>
                <textarea id="" name="" class="repeater-field wysiwyg" cols="<?php echo $_smarty_tpl->tpl_vars['cols']->value;?>
" rows="<?php echo $_smarty_tpl->tpl_vars['rows']->value;?>
" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" style="display:none;"></textarea>
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
$__foreach_value_8_saved = $_smarty_tpl->tpl_vars['value'];
?>
            <div class="repeater-wrapper sortable-item">
                <div class="left-panel handle">
                    <span class="ecb2-icon-grip-dots-vertical-solid"></span>
                </div>
                <?php echo smarty_function_cms_textarea(array('id'=>((string)$_smarty_tpl->tpl_vars['block_name']->value)."_r_".((string)$_smarty_tpl->tpl_vars['value']->iteration),'name'=>((string)$_smarty_tpl->tpl_vars['block_name']->value)."[r_".((string)$_smarty_tpl->tpl_vars['value']->iteration)."]",'class'=>'repeater-field wysiwyg','enablewysiwyg'=>$_smarty_tpl->tpl_vars['wysiwyg']->value,'rows'=>$_smarty_tpl->tpl_vars['rows']->value,'cols'=>$_smarty_tpl->tpl_vars['cols']->value,'value'=>$_smarty_tpl->tpl_vars['value']->value,'addtext'=>"data-repeater=\"#".((string)$_smarty_tpl->tpl_vars['block_name']->value)."-repeater\""),$_smarty_tpl);?>

                <div class="right-panel">
                    <button class="ecb2-repeater-remove ecb2-btn ecb2-btn-default ecb2-icon-only" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('remove_line');?>
" role="button" aria-disabled="false"><span class="ecb2-icon-trash-can-regular"></span></button>
                </div>
            </div>
        <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_8_saved;
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
