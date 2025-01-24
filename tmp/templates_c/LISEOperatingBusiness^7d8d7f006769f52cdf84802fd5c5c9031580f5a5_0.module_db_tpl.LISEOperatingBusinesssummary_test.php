<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:32:00
  from 'module_db_tpl:LISEOperatingBusiness;summary_test' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837e00f33ad6_35641515',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d8d7f006769f52cdf84802fd5c5c9031580f5a5' => 
    array (
      0 => 'module_db_tpl:LISEOperatingBusiness;summary_test',
      1 => 1735121070,
      2 => 'module_db_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67837e00f33ad6_35641515 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="row">
    <div class="col-lg-7">
         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEOperatingBusiness'][0], array( array('summarytemplate'=>"get_one_default",'pagelimit'=>"1"),$_smarty_tpl ) );?>
   
    </div>
    <div class="col-lg-5">
        <div class="row bg-white sticky">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEOperatingBusiness'][0], array( array('summarytemplate'=>"theme_other",'action'=>"category"),$_smarty_tpl ) );?>

        </div>
        <div class="row"> 
          
                                    <?php $_smarty_tpl->_assignInScope('selected_type', '');?>
                  <?php $_smarty_tpl->_assignInScope('selected_district', '');?>
                  
                  <?php if ((isset($_GET['types'])) && $_GET['types'] != '') {?>
                      <?php $_smarty_tpl->_assignInScope('selected_type', $_GET['types']);?>
                  <?php }?>
                  
                  <?php if ((isset($_GET['district'])) && $_GET['district'] != '') {?>
                      <?php $_smarty_tpl->_assignInScope('selected_district', $_GET['district']);?>
                  <?php }?>
                  
                                    
                  <!--Type: <?php echo (($tmp = $_smarty_tpl->tpl_vars['selected_type']->value ?? null)===null||$tmp==='' ? "None" ?? null : $tmp);?>
<br>-->
                  <!--District: <?php echo (($tmp = $_smarty_tpl->tpl_vars['selected_district']->value ?? null)===null||$tmp==='' ? "None" ?? null : $tmp);?>
<br>-->
                  
                                    
                  <?php if ($_smarty_tpl->tpl_vars['selected_type']->value == '' && $_smarty_tpl->tpl_vars['selected_district']->value == '') {?>
                      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEOperatingBusiness'][0], array( array('summarytemplate'=>"theme_other"),$_smarty_tpl ) );?>

                     
        
                  <?php } elseif ($_smarty_tpl->tpl_vars['selected_type']->value !== '' && empty($_smarty_tpl->tpl_vars['selected_district']->value)) {?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEOperatingBusiness'][0], array( array('summarytemplate'=>"theme_other",'category'=>((string)$_smarty_tpl->tpl_vars['selected_type']->value)),$_smarty_tpl ) );?>

                    
                        
                  <?php } elseif (!empty($_smarty_tpl->tpl_vars['selected_type']->value) && !empty($_smarty_tpl->tpl_vars['selected_district']->value)) {?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEOperatingBusiness'][0], array( array('summarytemplate'=>"theme_other",'category'=>((string)$_smarty_tpl->tpl_vars['selected_type']->value).",".((string)$_smarty_tpl->tpl_vars['selected_district']->value)),$_smarty_tpl ) );?>

                  
                   <?php } elseif ($_smarty_tpl->tpl_vars['selected_type']->value == ((string)$_smarty_tpl->tpl_vars['selected_type']->value) && $_smarty_tpl->tpl_vars['selected_district']->value == ((string)$_smarty_tpl->tpl_vars['selected_district']->value)) {?>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEOperatingBusiness'][0], array( array('summarytemplate'=>"theme_other",'category'=>((string)$_smarty_tpl->tpl_vars['selected_district']->value)),$_smarty_tpl ) );?>

                    
                  <?php } else { ?>
                     No Found
                     <?php echo $_smarty_tpl->tpl_vars['selected_type']->value;?>
 =="<?php echo $_smarty_tpl->tpl_vars['selected_type']->value;?>
" 
                   && <?php echo $_smarty_tpl->tpl_vars['selected_type']->value;?>
 =="<?php echo $_smarty_tpl->tpl_vars['selected_district']->value;?>
" 
                   && <?php echo $_smarty_tpl->tpl_vars['selected_district']->value;?>
 =="<?php echo $_smarty_tpl->tpl_vars['selected_district']->value;?>
"
                  <?php }?>

        </div>
    </div>
</div><?php }
}
