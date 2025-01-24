<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:15
  from 'module_db_tpl:LISEMediaSolutions;summary_theme_summary_slide' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a8b457bd0_90289243',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf20a51117ae03216834100d235f856e7db7d1fd' => 
    array (
      0 => 'module_db_tpl:LISEMediaSolutions;summary_theme_summary_slide',
      1 => 1736600002,
      2 => 'module_db_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a8b457bd0_90289243 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),2=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),3=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>


<div class="swiper get_id_slide">
      <div class="swiper-wrapper">
      <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['items']->value) > 0) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
          <div class="swiper-slide " data-aos="fade" 
                  data-aos-delay="50" data-aos-duration="500" data-aos-easing="ease-in-out">
                 <div class="border-0 p-0 item_blog mb-4">
                          <figure class="rounded-top overflow-hidden w-100">
                              <a title="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,"...");?>
" href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
">
                                  <img src="uploads<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['item']->value->banner_photo,'\\','/');?>
" class="h-100 w-100" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>
"
                                      style="object-fit: cover;">
                              </a>
                          </figure>
                         
                          <div class="blog_body rounded-bottom border p-3">
                              <h5 class="blog_title">
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
                                  <small>
                                      <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->date,"%B, %d, %Y");?>

                                  </small>
                              </p>
                              <div class="blog_foot">
                                  <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" class="btns btns_go text-center rounded w-100 text-nowrap">
                                      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"Read More",'kh_txt'=>"អានបន្ថែម"),$_smarty_tpl ) );?>
 <i class="fa-solid fa-arrow-right"></i>
                                  </a>
                                  
                                  <button class="rounded w-75 text-end text-nowrap" 
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
        
       <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
       <?php }?>
      </div>
      <div class="swiper-pagination"></div>
</div>

<?php }
}
