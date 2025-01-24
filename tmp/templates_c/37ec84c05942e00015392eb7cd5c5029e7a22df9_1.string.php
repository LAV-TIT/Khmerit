<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:33:38
  from '37ec84c05942e00015392eb7cd5c5029e7a22df9' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837e62f2eea4_62114721',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '37ec84c05942e00015392eb7cd5c5029e7a22df9' => 
    array (
      0 => '37ec84c05942e00015392eb7cd5c5029e7a22df9',
      1 => true,
      2 => 'string',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67837e62f2eea4_62114721 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\modifier.cms_escape.php','function'=>'smarty_modifier_cms_escape',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
if (!empty($_smarty_tpl->tpl_vars['description']->value)) {?>
        <?php echo $_smarty_tpl->tpl_vars['description']->value;?>
<br>
<?php }?>

<div class="ecb2-dropzone <?php if ($_smarty_tpl->tpl_vars['max_files']->value != 1) {?>sortable<?php }?> dropzone-previews" data-dropzone-url="<?php echo $_smarty_tpl->tpl_vars['action_url']->value;?>
" data-block-name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
" data-location="<?php echo $_smarty_tpl->tpl_vars['location']->value;?>
" data-dropzone-values="<?php echo smarty_modifier_cms_escape($_smarty_tpl->tpl_vars['json_filenames']->value);?>
" data-dropzone-thumbnail-width="<?php echo $_smarty_tpl->tpl_vars['thumbnail_width']->value;?>
" data-dropzone-thumbnail-height="<?php echo $_smarty_tpl->tpl_vars['thumbnail_height']->value;?>
" data-dropzone-thumbnail-prefix="<?php echo $_smarty_tpl->tpl_vars['thumbnail_prefix']->value;?>
"<?php if ($_smarty_tpl->tpl_vars['resize_width']->value) {?> data-dropzone-resize-width="<?php echo $_smarty_tpl->tpl_vars['resize_width']->value;?>
"<?php }
if ($_smarty_tpl->tpl_vars['resize_height']->value) {?> data-dropzone-resize-height="<?php echo $_smarty_tpl->tpl_vars['resize_height']->value;?>
"<?php }
if ($_smarty_tpl->tpl_vars['resize_method']->value) {?> data-dropzone-resize-method="<?php echo $_smarty_tpl->tpl_vars['resize_method']->value;?>
"<?php }
if ($_smarty_tpl->tpl_vars['max_files']->value > 0) {?> data-dropzone-max-files="<?php echo $_smarty_tpl->tpl_vars['max_files']->value;?>
"<?php }?> data-dropzone-max-files-text="<?php echo $_smarty_tpl->tpl_vars['max_files_text']->value;?>
" data-highest-row="<?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['values']->value);?>
">
    <div class="fallback ecb2-fallback">
        <input name="file" type="file" multiple />
    </div>

    <div class="dropzone-preview-template">
        <div class="dz-preview dz-file-preview <?php if ($_smarty_tpl->tpl_vars['thumbnail_width']->value < 104) {?>dz-thumb-sm<?php }?>" style="display:none;" data-row="">
            <input id="" name="" class="dz-input-filename" type="hidden" value=""/>
            <div class="dz-image" style="<?php if ($_smarty_tpl->tpl_vars['thumbnail_width']->value) {?>width:<?php echo $_smarty_tpl->tpl_vars['thumbnail_width']->value;?>
px;<?php }
if ($_smarty_tpl->tpl_vars['thumbnail_height']->value) {?> height:<?php echo $_smarty_tpl->tpl_vars['thumbnail_height']->value;?>
px;<?php }?>">
                <img data-dz-thumbnail="">
            </div>  
            <div class="dz-details">
                <div class="dz-filename"><span data-dz-name></span></div>
                <div class="dz-size" data-dz-size></div>
            </div>
            <div class="dz-handle ecb2-btn ecb2-btn-default"><span class="ecb2-icon-grip-dots-vertical-solid"></span></div>
        <?php if (!empty($_smarty_tpl->tpl_vars['sub_fields']->value)) {?>
            <button class="dz-edit ecb2-btn ecb2-btn-default" title="Edit sub-fields" role="button" aria-disabled="false"><span class="ecb2-icon-pencil"></span></button>
        <?php }?>
            <button class="dz-remove ecb2-btn ecb2-btn-default" data-dz-remove title="Remove image" role="button" aria-disabled="false"><span class="ecb2-icon-trash-can-regular"></span></button>
            <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
            <div class="dz-success-mark"><i class="ecb2-icon-check"></i></div>
            <div class="dz-error-mark"><i class="ecb2-icon-xmark"></i></div>
            <div class="dz-error-message"><span data-dz-errormessage></span></div>
        </div>
    </div>

    <div id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-upload-prompt" class="dz-upload-prompt ecb2-btn ecb2-btn-default" style="<?php if ($_smarty_tpl->tpl_vars['thumbnail_height']->value) {?> height:<?php echo $_smarty_tpl->tpl_vars['thumbnail_height']->value;?>
px;<?php }?>" title="Drop images here or click to upload">
        <span class="ecb2-icon-plus"></span>
        <input id="" name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
[empty]" class="dz-input-filename" type="hidden" value=""/>    </div>
</div>


<div id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-sub-fields" class="ecb2-dz-sub-fields">
    <div class="dz-sub-fields-template" data-sub-field-parent="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-sub-fields">
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
    <div id="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
_r_<?php echo $_smarty_tpl->tpl_vars['row']->value+1;?>
_sub_fields" class="dz-sub-field" data-sub-field-parent="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-sub-fields">
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
        <?php if ($_smarty_tpl->tpl_vars['field_def']->value->is_field_label_visible()) {?>
            <label class="sub_field_label"><?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_field_label();?>
:</label>
        <?php }?>
            <?php echo $_smarty_tpl->tpl_vars['field_def']->value->set_sub_field_value($_smarty_tpl->tpl_vars['fields']->value,$_smarty_tpl->tpl_vars['row']->value+1);?>

            <?php echo $_smarty_tpl->tpl_vars['field_def']->value->get_content_block_input();?>

        </div>
        <?php
$_smarty_tpl->tpl_vars['field_def'] = $__foreach_field_def_3_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </div>
    <?php
$_smarty_tpl->tpl_vars['fields'] = $__foreach_fields_2_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>








<?php }
}
