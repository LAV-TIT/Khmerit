<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:32:01
  from 'module_db_tpl:LISEOperatingBusiness;summary_get_one_default' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837e013a0e30_58047644',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4333a231ec20a365e2b1c3c2e939340185fd3fbc' => 
    array (
      0 => 'module_db_tpl:LISEOperatingBusiness;summary_get_one_default',
      1 => 1734599920,
      2 => 'module_db_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67837e013a0e30_58047644 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>

<div class="me-md-4 pt-4 sticky">
   <div class="map wrapp_map bg-light">
     <?php echo $_smarty_tpl->tpl_vars['item']->value->map;?>

   </div>
   <div>
      <h5 class="my-3 data_title ">
           <?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>

      </h5>
      
       <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
" class="pb-2 link_to_page fw-bold">
            View Project <i class="fa-solid fa-arrow-right"></i>
      </a>
   </div>
</div> 
	
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
