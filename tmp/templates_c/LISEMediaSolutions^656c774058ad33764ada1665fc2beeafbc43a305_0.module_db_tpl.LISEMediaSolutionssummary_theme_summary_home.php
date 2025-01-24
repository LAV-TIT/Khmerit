<?php
/* Smarty version 4.5.2, created on 2025-01-12 19:02:49
  from 'module_db_tpl:LISEMediaSolutions;summary_theme_summary_home' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6783af69621973_04903450',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '656c774058ad33764ada1665fc2beeafbc43a305' => 
    array (
      0 => 'module_db_tpl:LISEMediaSolutions;summary_theme_summary_home',
      1 => 1736683279,
      2 => 'module_db_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6783af69621973_04903450 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),2=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
if (smarty_modifier_count($_smarty_tpl->tpl_vars['items']->value) > 0) {?>
       <?php $_smarty_tpl->_assignInScope('n', 1);?>
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
       
	<div class="<?php if ($_smarty_tpl->tpl_vars['n']->value == 1) {?>col-sm-12 col-lg-6 col-xxl-6 <?php } else { ?>
	col-sm-6 col-lg-3
	<?php }?> px-md-2">
           <div class="post_item mb-4 w-100" 
           style="background: url(uploads<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['item']->value->banner_photo,'\\','/');?>
);
           background-position: center;
          background-size: cover;
          background-repeat: no-repeat;
           ">
                 
             
              <div class="post_body">
                  <div class="post_hover pt-3 px-3">
                        <h5 class="post_title">
                      <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
">
                          <?php ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,50,"...");
$_prefixVariable2=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,"...");
$_prefixVariable3=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>$_prefixVariable2,'kh_txt'=>$_prefixVariable3),$_smarty_tpl ) );?>

                      </a>
                  </h5>
                  <p>
                    
                  </p>
                  <div class="post_foot m-3">
                      <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" class="btns btns_go px-3 text-center rounded text-nowrap">
                          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"Read More",'kh_txt'=>"អានបន្ថែម"),$_smarty_tpl ) );?>
 <i class="fa-solid fa-arrow-right"></i>
                      </a>
                      
                      <button class="rounded px-2 text-end text-nowrap" 
                        data-url="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" 
                        data-title="<?php ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,'...');
$_prefixVariable4=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,'...');
$_prefixVariable5=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>" ".$_prefixVariable4,'kh_txt'=>$_prefixVariable5),$_smarty_tpl ) );?>
"
                        onclick="Share(this)">
                          <i class="fa-solid fa-share"></i>
                          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"Shere",'kh_txt'=>"ចែករំលែក"),$_smarty_tpl ) );?>

                      </button>
                  </div>
                  </div>
              </div>
          </div>
      
       </div>
	<?php $_smarty_tpl->_assignInScope('n', $_smarty_tpl->tpl_vars['n']->value+1);?>
	<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	
<?php }
}
}
