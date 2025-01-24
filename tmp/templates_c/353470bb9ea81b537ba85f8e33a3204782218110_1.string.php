<?php
/* Smarty version 4.5.2, created on 2025-01-12 13:00:41
  from '353470bb9ea81b537ba85f8e33a3204782218110' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67835a89bdd6c1_56648881',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '353470bb9ea81b537ba85f8e33a3204782218110' => 
    array (
      0 => '353470bb9ea81b537ba85f8e33a3204782218110',
      1 => true,
      2 => 'string',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67835a89bdd6c1_56648881 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\plugins\\function.cms_filepicker.php','function'=>'smarty_function_cms_filepicker',),));
if (!empty($_smarty_tpl->tpl_vars['description']->value)) {?>
        <?php echo $_smarty_tpl->tpl_vars['description']->value;?>
<br>
<?php }?>

    <div class="ecb_file_picker<?php if ($_smarty_tpl->tpl_vars['preview']->value) {?> preview<?php }?> <?php if (empty($_smarty_tpl->tpl_vars['value']->value)) {?>empty<?php } elseif (!empty($_smarty_tpl->tpl_vars['thumbnail_url']->value)) {?>thumbnail<?php } else { ?>file-icon<?php }?>"><?php if ($_smarty_tpl->tpl_vars['is_sub_field']->value) {?>
    <?php if (is_null($_smarty_tpl->tpl_vars['sub_row_number']->value)) {?>        <input type="text" name="" value="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" class="repeater-field ecb2-file-picker-template" data-repeater="#<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
-repeater" data-field-name="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
" data-cmsfp-instance="" data-fp-profile="<?php echo $_smarty_tpl->tpl_vars['profile_sig']->value;?>
" data-lang-clear="<?php echo $_smarty_tpl->tpl_vars['lang_clear']->value;?>
" size="80"/>

    <?php } else { ?>        <?php echo smarty_function_cms_filepicker(array('id'=>$_smarty_tpl->tpl_vars['subFieldId']->value,'name'=>$_smarty_tpl->tpl_vars['subFieldName']->value,'value'=>$_smarty_tpl->tpl_vars['value']->value,'profile'=>$_smarty_tpl->tpl_vars['profile']->value,'top'=>$_smarty_tpl->tpl_vars['top']->value,'type'=>$_smarty_tpl->tpl_vars['type']->value),$_smarty_tpl);?>


    <?php }?>

<?php } else { ?>
        <?php echo smarty_function_cms_filepicker(array('name'=>$_smarty_tpl->tpl_vars['block_name']->value,'value'=>$_smarty_tpl->tpl_vars['value']->value,'profile'=>$_smarty_tpl->tpl_vars['profile']->value,'top'=>$_smarty_tpl->tpl_vars['top']->value,'type'=>$_smarty_tpl->tpl_vars['type']->value),$_smarty_tpl);?>


<?php }?>

<?php if ($_smarty_tpl->tpl_vars['preview']->value) {?>
        <img class="ecb_file_picker_preview" src="<?php if (!empty($_smarty_tpl->tpl_vars['thumbnail_url']->value)) {
echo $_smarty_tpl->tpl_vars['thumbnail_url']->value;?>
?<?php echo time();
}?>" alt="<?php echo $_smarty_tpl->tpl_vars['block_name']->value;?>
" data-ajax-url="<?php echo $_smarty_tpl->tpl_vars['ajax_url']->value;?>
" data-top-dir="<?php echo $_smarty_tpl->tpl_vars['top_dir']->value;?>
" data-thumbnail-width="<?php echo $_smarty_tpl->tpl_vars['thumbnail_width']->value;?>
" data-thumbnail-height="<?php echo $_smarty_tpl->tpl_vars['thumbnail_height']->value;?>
">
        <div class="ecb_file_picker_file_icon"><span class="ecb2-icon-file-o"></span></div>
        <div class="ecb_file_picker_title"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</div>
<?php }?>
    </div><?php }
}
