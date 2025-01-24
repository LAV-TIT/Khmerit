<?php
/* Smarty version 4.5.2, created on 2025-01-12 00:36:40
  from 'lisetemplate:instance;LISEMediaSolutions;ajax_quick_search.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782ac287ba6d7_07246039',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2de48f052e3823cc12fcd8250699005b41e7c2aa' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;ajax_quick_search.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6782ac287ba6d7_07246039 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\function.cycle.php','function'=>'smarty_function_cycle',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\modifier.cms_date_format.php','function'=>'smarty_modifier_cms_date_format',),));
?>
<div class="pageshowrows">
  <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value > 1) {?>

    <a href="javascript:void(0)" onclick="on_pagination_click('first', 1)">&lt;&lt;</a>
    <a href="javascript:void(0)" onclick="on_pagination_click('previous', <?php echo $_smarty_tpl->tpl_vars['pagenumber']->value-1;?>
)">&lt;</a>
  <?php }?>
  <?php echo $_smarty_tpl->tpl_vars['pagenumber']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['oftext']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['pagecount']->value;?>

  <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value < $_smarty_tpl->tpl_vars['pagecount']->value) {?>

    <a href="javascript:void(0)" onclick="on_pagination_click('previous', <?php echo $_smarty_tpl->tpl_vars['pagenumber']->value+1;?>
)">&gt;</a>
    <a href="javascript:void(0)" onclick="on_pagination_click('last', <?php echo $_smarty_tpl->tpl_vars['pagecount']->value;?>
)">&gt;&gt;</a>
  <?php }?>
</div>

<?php if (!empty($_smarty_tpl->tpl_vars['items']->value)) {?>
  <table id="sortable_item" data-filter="#item_search" cellspacing="0" class="pagetable <?php echo $_smarty_tpl->tpl_vars['themeObject']->value->themeName;?>
">
    <thead>
      <tr class="top">
        <th data-toggle="true"><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</th>
        <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->alias))) {?><th data-hide="phone,tablet"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('alias');?>
</th><?php }?>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value[0]->fielddefs, 'fielddef');
$_smarty_tpl->tpl_vars['fielddef']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fielddef']->value) {
$_smarty_tpl->tpl_vars['fielddef']->do_else = false;
?>
          <th data-hide="phone.tablet"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value['name'];?>
</th>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->create_time))) {?><th data-hide="phone,tablet" data-type="numeric"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('create_time');?>
</th><?php }?>
        <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->modified_time))) {?><th data-hide="phone,tablet" data-type="numeric"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('modified_time');?>
</th><?php }?>
        <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->start_time))) {?><th data-hide="phone,tablet" data-type="numeric"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('start_time');?>
</th><?php }?>
        <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->end_time))) {?><th data-hide="phone,tablet" data-type="numeric"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('end_time');?>
</th><?php }?>
        <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->approve))) {?><th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon"><span class="lise-hidden"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('toggle_status');?>
</span>&nbsp;</th><?php }?>
        <th data-ignore="highlight" data-hide="phone,tablet" data-sort-ignore="true" data-class="hide-heading" class="pageicon"><span class="lise-hidden"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('copy');?>
</span>&nbsp;</th>
        <th data-ignore="highlight" data-hide="phone,tablet" data-sort-ignore="true" data-class="hide-heading" class="pageicon"><span class="lise-hidden"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('edit');?>
</span>&nbsp;</th>
        <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->delete))) {?><th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon"><span class="lise-hidden"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('delete');?>
</span>&nbsp;</th><?php }?>
        <th data-ignore="highlight" data-hide="phone,tablet" data-sort-ignore="true" data-class="hide-heading"title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('select_all');?>
" class="pageicon no-sort"><span class="lise-hidden"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('select_item');?>
</span><input id="check_all_item" type="checkbox" /></th>
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

        <tr id="item_<?php echo $_smarty_tpl->tpl_vars['entry']->value->item_id;?>
" class="<?php echo $_smarty_tpl->tpl_vars['rowclass']->value;?>
" style="cursor: move;">
          <td><?php echo $_smarty_tpl->tpl_vars['entry']->value->title;?>
</td>
          <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->alias))) {?><td><?php echo $_smarty_tpl->tpl_vars['entry']->value->alias;?>
</td><?php }?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['entry']->value->fielddefs, 'fielddef');
$_smarty_tpl->tpl_vars['fielddef']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fielddef']->value) {
$_smarty_tpl->tpl_vars['fielddef']->do_else = false;
?>
            <?php if ('SelectDateTime' == $_smarty_tpl->tpl_vars['fielddef']->value->GetType()) {?>
              <td data-value="<?php echo $_smarty_tpl->tpl_vars['fielddef']->value->GetOptionValue('unix_datetime_stamp');?>
"><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->RenderForAdminListing($_smarty_tpl->tpl_vars['actionid']->value,$_smarty_tpl->tpl_vars['returnid']->value);?>
</td>
            <?php } else { ?>
              <td><?php echo $_smarty_tpl->tpl_vars['fielddef']->value->RenderForAdminListing($_smarty_tpl->tpl_vars['actionid']->value,$_smarty_tpl->tpl_vars['returnid']->value);?>
</td>
            <?php }?>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->create_time))) {?><td data-value="<?php echo smarty_modifier_cms_date_format($_smarty_tpl->tpl_vars['entry']->value->create_time);?>
"><?php echo $_smarty_tpl->tpl_vars['entry']->value->create_time;?>
</td><?php }?>
          <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->modified_time))) {?><td data-value="<?php echo smarty_modifier_cms_date_format($_smarty_tpl->tpl_vars['entry']->value->modified_time);?>
"><?php echo $_smarty_tpl->tpl_vars['entry']->value->modified_time;?>
</td><?php }?>
          <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->start_time))) {?><td data-value="<?php echo smarty_modifier_cms_date_format($_smarty_tpl->tpl_vars['entry']->value->start_time);?>
"><?php echo $_smarty_tpl->tpl_vars['entry']->value->start_time;?>
</td><?php }?>
          <?php if ((isset($_smarty_tpl->tpl_vars['items']->value[0]->end_time))) {?><td data-value="<?php echo smarty_modifier_cms_date_format($_smarty_tpl->tpl_vars['entry']->value->end_time);?>
"><?php echo $_smarty_tpl->tpl_vars['entry']->value->end_time;?>
</td><?php }?>
          <?php if ((isset($_smarty_tpl->tpl_vars['entry']->value->approve))) {?><td class="init-ajax-toggle approve-item"><?php echo $_smarty_tpl->tpl_vars['entry']->value->approve;?>
</td><?php }?>
          <td><?php echo $_smarty_tpl->tpl_vars['entry']->value->copylink;?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['entry']->value->editlink;?>
</td>
          <?php if ((isset($_smarty_tpl->tpl_vars['entry']->value->delete))) {?><td class="init-ajax-delete"><?php echo $_smarty_tpl->tpl_vars['entry']->value->delete;?>
</td><?php }?>
          <td class="item-mass-action"><?php echo $_smarty_tpl->tpl_vars['entry']->value->select;?>
</td>
        </tr>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
  </table>
<?php } else { ?>
  <div class="pageoverflow"><div class="pagetext">Your query returned no results</div></div>
<?php }?>

<div class="pageshowrows">
  <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value > 1) {?>

    <a href="javascript:void(0)" onclick="on_pagination_click('first', 1)">&lt;&lt;</a>
    <a href="javascript:void(0)" onclick="on_pagination_click('previous', <?php echo $_smarty_tpl->tpl_vars['pagenumber']->value-1;?>
)">&lt;</a>
  <?php }?>
  <?php echo $_smarty_tpl->tpl_vars['pagenumber']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['oftext']->value;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['pagecount']->value;?>

  <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value < $_smarty_tpl->tpl_vars['pagecount']->value) {?>

    <a href="javascript:void(0)" onclick="on_pagination_click('previous', <?php echo $_smarty_tpl->tpl_vars['pagenumber']->value+1;?>
)">&gt;</a>
    <a href="javascript:void(0)" onclick="on_pagination_click('last', <?php echo $_smarty_tpl->tpl_vars['pagecount']->value;?>
)">&gt;&gt;</a>
  <?php }?>
</div>
<?php }
}
