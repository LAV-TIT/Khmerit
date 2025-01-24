<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:32:01
  from 'module_db_tpl:LISEOperatingBusiness;category_default' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837e014cc784_52115094',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c178fae7948dea32d774b2500e4f39c566aff54b' => 
    array (
      0 => 'module_db_tpl:LISEOperatingBusiness;category_default',
      1 => 1735121065,
      2 => 'module_db_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67837e014cc784_52115094 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),));
$_smarty_tpl->_assignInScope('selected_type', (($tmp = $_GET['types'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp));
$_smarty_tpl->_assignInScope('selected_district', (($tmp = $_GET['district'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp));?>

<div class="col-6">
  <h5 class="mb-3 fw-bold">Type</h5>
  <div class="wrapper">
    <div class="select_wrap">
      <ul id="default_types" class="default_option">
        <li data-value="<?php echo $_smarty_tpl->tpl_vars['selected_type']->value;?>
" class="text-capitalize">
              <?php if ($_smarty_tpl->tpl_vars['selected_type']->value) {
echo smarty_modifier_replace($_smarty_tpl->tpl_vars['selected_type']->value,'-',' ');
} else { ?>Select...<?php }?>
            </li>
      </ul>
      <ul id="select_ul_types" class="select_ul">
        <li data-value="">Select...</li>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
          <?php if ((isset($_smarty_tpl->tpl_vars['category']->value->alias)) && $_smarty_tpl->tpl_vars['category']->value->alias == 'types') {?>
            <?php if ((isset($_smarty_tpl->tpl_vars['category']->value->children)) && smarty_modifier_count($_smarty_tpl->tpl_vars['category']->value->children) > 0) {?>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'child');
$_smarty_tpl->tpl_vars['child']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->do_else = false;
?>
                <?php if (in_array($_smarty_tpl->tpl_vars['child']->value->category_id,$_smarty_tpl->tpl_vars['category']->value->children)) {?>
                  <li data-value="<?php echo $_smarty_tpl->tpl_vars['child']->value->alias;?>
"><?php echo $_smarty_tpl->tpl_vars['child']->value->name;?>
</li>
                <?php }?>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
          <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>
    </div>
  </div>
</div>

<div class="col-6">
  <h5 class="mb-3 fw-bold">District</h5>
  <div class="wrapper">
    <div class="select_wrap">
      <ul id="default_district" class="default_option">
        <li data-value="<?php echo $_smarty_tpl->tpl_vars['selected_district']->value;?>
" class="text-capitalize"><?php if ($_smarty_tpl->tpl_vars['selected_district']->value) {
echo smarty_modifier_replace($_smarty_tpl->tpl_vars['selected_district']->value,'-',' ');
} else { ?>Select...<?php }?></li>
      </ul>
      <ul id="select_ul_district" class="select_ul">
        <li data-value="">Select...</li>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
$_smarty_tpl->tpl_vars['category']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->do_else = false;
?>
          <?php if ((isset($_smarty_tpl->tpl_vars['category']->value->alias)) && $_smarty_tpl->tpl_vars['category']->value->alias == 'district') {?>
            <?php if ((isset($_smarty_tpl->tpl_vars['category']->value->children)) && smarty_modifier_count($_smarty_tpl->tpl_vars['category']->value->children) > 0) {?>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'child');
$_smarty_tpl->tpl_vars['child']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
$_smarty_tpl->tpl_vars['child']->do_else = false;
?>
                <?php if (in_array($_smarty_tpl->tpl_vars['child']->value->category_id,$_smarty_tpl->tpl_vars['category']->value->children)) {?>
                  <li data-value="<?php echo $_smarty_tpl->tpl_vars['child']->value->alias;?>
"><?php echo $_smarty_tpl->tpl_vars['child']->value->name;?>
</li>
                <?php }?>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
          <?php }?>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>
    </div>
  </div>
</div>

<?php }
}
