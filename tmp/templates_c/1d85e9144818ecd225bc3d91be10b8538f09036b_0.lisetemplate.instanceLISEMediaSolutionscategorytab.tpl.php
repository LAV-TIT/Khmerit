<?php
/* Smarty version 4.5.2, created on 2025-01-12 00:36:38
  from 'lisetemplate:instance;LISEMediaSolutions;categorytab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782ac263d7b03_52799213',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d85e9144818ecd225bc3d91be10b8538f09036b' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;categorytab.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6782ac263d7b03_52799213 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\function.cycle.php','function'=>'smarty_function_cycle',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.repeat.php','function'=>'smarty_function_repeat',),));
if (count($_smarty_tpl->tpl_vars['items']->value) > 0) {?>
  <table id="sortable_category" cellspacing="0" class="pagetable">
    <thead>
      <tr>
        <th><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('category');?>
</th>
        <th><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('alias');?>
</th>
        <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon">&nbsp;</th>
        <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon">&nbsp;</th>
        <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon">&nbsp;</th>
        <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('select_all');?>
" class="pageicon no-sort"><input id="check_all_category" type="checkbox" /></th>
      </tr>
    </thead>
    <tbody class="content" width="100%">
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'entry');
$_smarty_tpl->tpl_vars['entry']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['entry']->value) {
$_smarty_tpl->tpl_vars['entry']->do_else = false;
?>
    <?php echo smarty_function_cycle(array('values'=>"row1,row2",'assign'=>'rowclass'),$_smarty_tpl);?>

      <tr id="category_<?php echo $_smarty_tpl->tpl_vars['entry']->value->category_id;?>
" class="<?php echo $_smarty_tpl->tpl_vars['rowclass']->value;?>
">
        <td><?php echo smarty_function_repeat(array('string'=>'>&nbsp;','times'=>$_smarty_tpl->tpl_vars['entry']->value->depth-1),$_smarty_tpl);
echo $_smarty_tpl->tpl_vars['entry']->value->name;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['entry']->value->alias;?>
</td>
        <td class="init-ajax-toggle approve-category"><?php echo $_smarty_tpl->tpl_vars['entry']->value->approve;?>
</td>
        <td><?php echo $_smarty_tpl->tpl_vars['entry']->value->editlink;?>
</td>
        <td class="init-ajax-delete"><?php echo $_smarty_tpl->tpl_vars['entry']->value->delete;?>
</td>
        <td class="category-mass-action"><?php echo $_smarty_tpl->tpl_vars['entry']->value->select;?>
</td>
      </tr>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
  </table>
  <div class="pageoptions" style="float:right;">
    <select id="lise_category_mass_action">
      <option value=""><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('select_one');?>
</option>
      <option value="delete">Delete</option>
      <option value="approve">Toggle active</option>
    </select>
  </div>
<?php }?>

<div class="pageoptions"><?php echo $_smarty_tpl->tpl_vars['addlink']->value;
if ((isset($_smarty_tpl->tpl_vars['reorderlink']->value))) {?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['reorderlink']->value;
}?></div><?php }
}
