<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:32:01
  from 'module_db_tpl:LISEOperatingBusiness;summary_theme_other' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837e01754f38_37332546',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3aa890fdff692a373036e6ef0c9e0da9881be2dd' => 
    array (
      0 => 'module_db_tpl:LISEOperatingBusiness;summary_theme_other',
      1 => 1735121210,
      2 => 'module_db_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67837e01754f38_37332546 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
$_smarty_tpl->_assignInScope('i', 1);?>

<?php $_smarty_tpl->_assignInScope('selected_type', (($tmp = $_GET['types'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp));
$_smarty_tpl->_assignInScope('selected_district', (($tmp = $_GET['district'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp));?>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>

<!-- item -->
<div class="col-12">
      <div class="row mb-3">
            <div class="col-5">
                  <figure class="rounded overflow-hidden w-100">
                         <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
">
                              <img src="uploads/<?php echo $_smarty_tpl->tpl_vars['item']->value->bannerphoto;?>
" class="w-100" 
                              alt="<?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>
" style="height: 100px;object-fit: cover;">
                         </a>
                  </figure>
            </div>
            <div class="col-7 d-flex justify-content-between flex-column">
                <div class="show_map">
                    <a class="map-link" data-id="map<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" data-map='<?php echo $_smarty_tpl->tpl_vars['item']->value->map;?>
' 
                    data-title='<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,"...");?>
' data-url='<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
'>
                        <div class="d-none map_iframe">
                            <?php echo $_smarty_tpl->tpl_vars['item']->value->map;?>

                        </div>
                        <h6 class="title text-green fw-bold">
                            <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,"...");?>

                        </h6>
                    </a>
                    <p class="text-capitalize">
                         <?php echo $_smarty_tpl->tpl_vars['item']->value->district;?>

                          <!--<pre><?php echo print_r($_smarty_tpl->tpl_vars['categories']->value);?>
</pre>-->
                    </p>
                </div>
                <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
" class="pb-2 link_to_page fw-bold">
                    View Project <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
	</div>
	
</div>
<?php $_smarty_tpl->_assignInScope('i', $_smarty_tpl->tpl_vars['i']->value+1);
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<!--============     -->
<?php if ($_smarty_tpl->tpl_vars['pagecount']->value > 1) {?>
    <div class="page-list mt-4 mb-4 mb-md-0">
      <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value > 1) {?>
          <nav class="prev-col">
            <ul>
              <li><?php echo $_smarty_tpl->tpl_vars['prevpage']->value;?>
</li>
            </ul>
          </nav>
      <?php } else { ?>
         <nav class="prev-col disible">
            <ul>
              <li>< Prev</li>
            </ul>
          </nav>
      <?php }?>
      <nav class="pages">
        <ul class="pagination">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagelinks']->value, 'page');
$_smarty_tpl->tpl_vars['page']->iteration = 0;
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
$_smarty_tpl->tpl_vars['page']->iteration++;
$__foreach_page_6_saved = $_smarty_tpl->tpl_vars['page'];
?>
            <li class="page-item <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value == $_smarty_tpl->tpl_vars['page']->iteration) {?>active<?php }?>"><?php echo $_smarty_tpl->tpl_vars['page']->value->link;?>
</li>
        <?php
$_smarty_tpl->tpl_vars['page'] = $__foreach_page_6_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
      </nav>
      <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value < $_smarty_tpl->tpl_vars['pagecount']->value) {?>
          <nav class="next-col">
            <ul>
              <li><?php echo $_smarty_tpl->tpl_vars['nextpage']->value;?>
</li>
            </ul>
          </nav>
      <?php } else { ?>
         <nav class="next-col disible">
            <ul>
              <li>Next ></li>
            </ul>
          </nav>
      <?php }?>
    </div>
<?php }
}
}
