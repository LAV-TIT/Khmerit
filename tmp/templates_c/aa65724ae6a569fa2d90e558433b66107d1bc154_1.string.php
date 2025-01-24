<?php
/* Smarty version 4.5.2, created on 2025-01-12 13:00:42
  from 'aa65724ae6a569fa2d90e558433b66107d1bc154' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67835a8a282eb8_30386322',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aa65724ae6a569fa2d90e558433b66107d1bc154' => 
    array (
      0 => 'aa65724ae6a569fa2d90e558433b66107d1bc154',
      1 => true,
      2 => 'string',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67835a8a282eb8_30386322 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
if (!empty($_smarty_tpl->tpl_vars['description']->value)) {?>
    <?php echo $_smarty_tpl->tpl_vars['description']->value;?>
<br>
<?php }?>

<?php if (empty($_smarty_tpl->tpl_vars['assign']->value)) {?>
    <div class="pagewarning">
        <?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('error_assign_required');?>

    </div><br>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['layout']->value != 'table') {?>
    <div id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" class="ecb_repeater <?php echo $_smarty_tpl->tpl_vars['layout']->value;?>
-layout sortable" data-block-name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
" data-highest-row="<?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['values']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['max_blocks']->value > 0) {?>data-max-blocks="<?php echo $_smarty_tpl->tpl_vars['max_blocks']->value;?>
"<?php }?> data-repeater-add="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater-add">

        <div class="repeater-wrapper-template sortable-item" style="display:none;">
            <div class="left-panel handle">
                <span class="ecb2-icon-grip-dots-vertical-solid"></span>
            </div>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_fields']->value, 'field_def');
$_smarty_tpl->tpl_vars['field_def']->iteration = 0;
$_smarty_tpl->tpl_vars['field_def']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field_def']->value) {
$_smarty_tpl->tpl_vars['field_def']->do_else = false;
$_smarty_tpl->tpl_vars['field_def']->iteration++;
$__foreach_field_def_1_saved = $_smarty_tpl->tpl_vars['field_def'];
?>
            <div class="sub-field sub-field-<?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_type();?>
">
                <label class="sub_field_label"><?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_field_label();?>
</label>
                <?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_content_block_input();?>

            </div>
        <?php
$_smarty_tpl->tpl_vars['field_def'] = $__foreach_field_def_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <div class="right-panel controls">
                <button class="ecb2-repeater-remove ecb2-btn ecb2-btn-default ecb2-icon-only" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('remove_line');?>
" role="button" aria-disabled="false"><span class="ecb2-icon-trash-can-regular"></span></button>
            </div>
        </div>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['values']->value, 'fields', false, 'row');
$_smarty_tpl->tpl_vars['fields']->iteration = 0;
$_smarty_tpl->tpl_vars['fields']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value => $_smarty_tpl->tpl_vars['fields']->value) {
$_smarty_tpl->tpl_vars['fields']->do_else = false;
$_smarty_tpl->tpl_vars['fields']->iteration++;
$__foreach_fields_2_saved = $_smarty_tpl->tpl_vars['fields'];
?>
        <div class="repeater-wrapper sortable-item">
            <div class="left-panel handle">
                <span class="ecb2-icon-grip-dots-vertical-solid"></span>
            </div>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_fields']->value, 'field_def');
$_smarty_tpl->tpl_vars['field_def']->iteration = 0;
$_smarty_tpl->tpl_vars['field_def']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field_def']->value) {
$_smarty_tpl->tpl_vars['field_def']->do_else = false;
$_smarty_tpl->tpl_vars['field_def']->iteration++;
$__foreach_field_def_3_saved = $_smarty_tpl->tpl_vars['field_def'];
?>
            <div class="sub-field row<?php echo $_smarty_tpl->tpl_vars['fields']->iteration;?>
 col<?php echo $_smarty_tpl->tpl_vars['field_def']->iteration;?>
 sub-field-<?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_type();?>
">
                <label class="sub_field_label"><?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_field_label();?>
:</label>
                <?php echo $_smarty_tpl->tpl_vars['field_def']->value->set_sub_field_value($_smarty_tpl->tpl_vars['fields']->value,$_smarty_tpl->tpl_vars['row']->value);?>

                <?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_content_block_input();?>

            </div>
        <?php
$_smarty_tpl->tpl_vars['field_def'] = $__foreach_field_def_3_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            <div class="right-panel controls">
                <button class="ecb2-repeater-remove ecb2-btn ecb2-btn-default ecb2-icon-only" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('remove_line');?>
" role="button" aria-disabled="false"><span class="ecb2-icon-trash-can-regular"></span></button>
            </div>
        </div>
    <?php
$_smarty_tpl->tpl_vars['fields'] = $__foreach_fields_2_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    </div>        


<?php } else { ?>    <div class="table-responsive">
        <table id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" class="ecb_repeater sortable <?php echo $_smarty_tpl->tpl_vars['layout']->value;?>
-layout" data-block-name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
" data-highest-row="<?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['values']->value);?>
" <?php if ($_smarty_tpl->tpl_vars['max_blocks']->value > 0) {?>data-max-blocks="<?php echo $_smarty_tpl->tpl_vars['max_blocks']->value;?>
"<?php }?> data-repeater-add="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater-add">
            <thead>
                <tr class="repeater-wrapper-header">
                    <th class="left-panel"></th>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_fields']->value, 'field_def');
$_smarty_tpl->tpl_vars['field_def']->iteration = 0;
$_smarty_tpl->tpl_vars['field_def']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field_def']->value) {
$_smarty_tpl->tpl_vars['field_def']->do_else = false;
$_smarty_tpl->tpl_vars['field_def']->iteration++;
$__foreach_field_def_4_saved = $_smarty_tpl->tpl_vars['field_def'];
?>
                    <th class="sub-field-heading sub-field-heading-<?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_type();?>
 col<?php echo $_smarty_tpl->tpl_vars['field_def']->iteration;?>
" data-heading-for=".col<?php echo $_smarty_tpl->tpl_vars['field_def']->iteration;?>
">
                        <?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_field_label();?>

                    </th>
                <?php
$_smarty_tpl->tpl_vars['field_def'] = $__foreach_field_def_4_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <th class="right-panel"></th>
                </tr>
            </thead>

            <tbody class="">
                <tr class="repeater-wrapper-template sortable-item" style="display:none;">
                    <td class="left-panel handle">
                        <span class="ecb2-icon-grip-dots-vertical-solid"></span>
                    </td>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_fields']->value, 'field_def');
$_smarty_tpl->tpl_vars['field_def']->iteration = 0;
$_smarty_tpl->tpl_vars['field_def']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field_def']->value) {
$_smarty_tpl->tpl_vars['field_def']->do_else = false;
$_smarty_tpl->tpl_vars['field_def']->iteration++;
$__foreach_field_def_5_saved = $_smarty_tpl->tpl_vars['field_def'];
?>
                    <td class="sub-field sub-field-<?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_type();?>
">
                        <?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_content_block_input();?>

                    </td>
                <?php
$_smarty_tpl->tpl_vars['field_def'] = $__foreach_field_def_5_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <td class="right-panel controls">
                        <button class="ecb2-repeater-remove ecb2-btn ecb2-btn-default ecb2-icon-only" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('remove_line');?>
" role="button" aria-disabled="false"><span class="ecb2-icon-trash-can-regular"></span></button>
                    </td>
                </tr>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['values']->value, 'fields', false, 'row');
$_smarty_tpl->tpl_vars['fields']->iteration = 0;
$_smarty_tpl->tpl_vars['fields']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value => $_smarty_tpl->tpl_vars['fields']->value) {
$_smarty_tpl->tpl_vars['fields']->do_else = false;
$_smarty_tpl->tpl_vars['fields']->iteration++;
$__foreach_fields_6_saved = $_smarty_tpl->tpl_vars['fields'];
?>
                <tr class="repeater-wrapper sortable-item">
                    <td class="left-panel handle">
                        <span class="ecb2-icon-grip-dots-vertical-solid"></span>
                    </td>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sub_fields']->value, 'field_def');
$_smarty_tpl->tpl_vars['field_def']->iteration = 0;
$_smarty_tpl->tpl_vars['field_def']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field_def']->value) {
$_smarty_tpl->tpl_vars['field_def']->do_else = false;
$_smarty_tpl->tpl_vars['field_def']->iteration++;
$__foreach_field_def_7_saved = $_smarty_tpl->tpl_vars['field_def'];
?>
                    <td class="sub-field row<?php echo $_smarty_tpl->tpl_vars['fields']->iteration;?>
 col<?php echo $_smarty_tpl->tpl_vars['field_def']->iteration;?>
 sub-field-<?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_type();?>
">
                        <?php echo $_smarty_tpl->tpl_vars['field_def']->value->set_sub_field_value($_smarty_tpl->tpl_vars['fields']->value,$_smarty_tpl->tpl_vars['row']->value);?>

                        <?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_content_block_input();?>

                    </td>
                <?php
$_smarty_tpl->tpl_vars['field_def'] = $__foreach_field_def_7_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                    <td class="right-panel controls">
                        <button class="ecb2-repeater-remove ecb2-btn ecb2-btn-default ecb2-icon-only" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('remove_line');?>
" role="button" aria-disabled="false"><span class="ecb2-icon-trash-can-regular"></span></button>
                    </td>
                </tr>
            <?php
$_smarty_tpl->tpl_vars['fields'] = $__foreach_fields_6_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>      
    </div>

<?php }?>

    <div class="ecb_repeater_footer">
        <button id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater-add" class="ecb2-repeater-add ecb2-btn ecb2-btn-default" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('add_line');?>
" role="button" <?php if (!empty($_smarty_tpl->tpl_vars['max_blocks']->value) && smarty_modifier_count($_smarty_tpl->tpl_vars['values']->value) >= $_smarty_tpl->tpl_vars['max_blocks']->value) {?> disabled aria-disabled="true"<?php } else { ?>aria-disabled="false"<?php }?>><span class="ecb2-icon-plus"></span>&nbsp;&nbsp;<?php echo $_smarty_tpl->tpl_vars['mod']->value->Lang('add_item');?>
</button>
    </div>

<?php }
}
