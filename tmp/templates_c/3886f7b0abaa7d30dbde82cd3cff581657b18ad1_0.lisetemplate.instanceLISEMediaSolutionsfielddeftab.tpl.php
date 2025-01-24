<?php
/* Smarty version 4.5.2, created on 2025-01-12 00:36:38
  from 'lisetemplate:instance;LISEMediaSolutions;fielddeftab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782ac266e8fd7_97473422',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3886f7b0abaa7d30dbde82cd3cff581657b18ad1' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;fielddeftab.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6782ac266e8fd7_97473422 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\function.cycle.php','function'=>'smarty_function_cycle',),));
if (count($_smarty_tpl->tpl_vars['items']->value) > 0) {?>
  <div class="pageoptions"><?php echo $_smarty_tpl->tpl_vars['addlink']->value;?>
</div>
  <table id="sortable_fielddef" cellspacing="0" class="pagetable">
    <thead>
        <tr>
            <th><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('fielddef');?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('alias');?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('fielddef_type');?>
</th>
            <th><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('required');?>
</th>
            <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon">&nbsp;</th>
            <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon">&nbsp;</th>
            <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('select_all');?>
" class="pageicon"><input id="check_all_fielddef" type="checkbox" /></th>
        </tr>
    </thead>
    <tbody class="content">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'fielddef');
$_smarty_tpl->tpl_vars['fielddef']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fielddef']->value) {
$_smarty_tpl->tpl_vars['fielddef']->do_else = false;
?>
          <?php echo smarty_function_cycle(array('values'=>"row1,row2",'assign'=>'rowclass'),$_smarty_tpl);?>

        <tr id="fielddef_<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetId();?>
" class="<?php echo $_smarty_tpl->tpl_vars['rowclass']->value;?>
" style="cursor: move;">
                  <td><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetName();?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetAlias();?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetFriendlyType();?>
</td>
                  <td class="init-ajax-toggle"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetRequired();?>
</td>
                  <td><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->editlink;?>
</td>
                  <td class="init-ajax-delete"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->deletelink;?>
</td>
                  <td class="fielddef-mass-action"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->select;?>
</td>
              </tr>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
  </table>
  <div class="pageoptions" style="float:right;">
    <select id="lise_fielddef_mass_action">
      <option value=""><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('select_one');?>
</option>
      <option value="delete">Delete</option>
      <option value="require">Toggle require</option>
    </select>
  </div>
  <div class="pageoptions" style="float:right;"><?php echo $_smarty_tpl->tpl_vars['submitorder']->value;?>
</div>
<?php }?>

<div class="pageoptions"><?php echo $_smarty_tpl->tpl_vars['addlink']->value;?>
</div><?php }
}
