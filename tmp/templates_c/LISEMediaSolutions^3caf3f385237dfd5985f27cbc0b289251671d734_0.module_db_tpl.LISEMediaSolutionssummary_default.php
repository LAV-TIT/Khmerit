<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:05
  from 'module_db_tpl:LISEMediaSolutions;summary_default' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a8184cf16_83579735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3caf3f385237dfd5985f27cbc0b289251671d734' => 
    array (
      0 => 'module_db_tpl:LISEMediaSolutions;summary_default',
      1 => 1736441494,
      2 => 'module_db_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a8184cf16_83579735 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.explode.php','function'=>'smarty_modifier_explode',),2=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),3=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),4=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
if (smarty_modifier_count($_smarty_tpl->tpl_vars['items']->value) > 0) {?>

<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
      
      <?php if (strstr($_SERVER['REQUEST_URI'],"tag")) {?>
          <?php $_smarty_tpl->_assignInScope('tagwords', smarty_modifier_explode(",",$_smarty_tpl->tpl_vars['item']->value->tags));?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tagwords']->value, 'tag');
$_smarty_tpl->tpl_vars['tag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->do_else = false;
?>
            <?php if (($_GET['tag'] == mb_strtolower((string) $_smarty_tpl->tpl_vars['tag']->value, 'UTF-8'))) {?>
            <?php $_smarty_tpl->_assignInScope('j', ((string)$_smarty_tpl->tpl_vars['item']->value->alias));?>
            
            <div class="col-sm-6 col-lg-4 col-xxl-3 px-md-2" data-aos="fade" 
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
$_prefixVariable4=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,"...");
$_prefixVariable5=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>$_prefixVariable4,'kh_txt'=>$_prefixVariable5),$_smarty_tpl ) );?>

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
$_prefixVariable6=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,'...');
$_prefixVariable7=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>" ".$_prefixVariable6,'kh_txt'=>$_prefixVariable7),$_smarty_tpl ) );?>
"
                                    onclick="Share(this)">
                                      <i class="fa-solid fa-share"></i>
                                      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"Shere",'kh_txt'=>"ចែករំលែក"),$_smarty_tpl ) );?>

                                  </button>
                              </div>
                          </div>
                      </div>
                  
                   </div>
            <?php }?>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      <?php } else { ?>
      
      <div class="col-sm-6 col-lg-4 col-xxl-3 px-md-2" data-aos="fade" 
      data-aos-delay="50" data-aos-duration="500" data-aos-easing="ease-in-out">
          <div class="border-0 p-0 item_blog mb-4">
              <figure class="rounded-top overflow-hidden w-100">
                  <a title="<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60," ...");?>
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
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,50,'...');
$_prefixVariable8=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,'...');
$_prefixVariable9=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>$_prefixVariable8,'kh_txt'=>$_prefixVariable9),$_smarty_tpl ) );?>

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
$_prefixVariable10=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,'...');
$_prefixVariable11=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>" ".$_prefixVariable10,'kh_txt'=>$_prefixVariable11),$_smarty_tpl ) );?>
"
                        onclick="Share(this)">
                          <i class="fa-solid fa-share"></i>
                          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"Shere",'kh_txt'=>"ចែករំលែក"),$_smarty_tpl ) );?>

                      </button>
                  </div>
              </div>
          </div>
      </div>
      
      <?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

<?php }?>

<!--<?php if ($_smarty_tpl->tpl_vars['pagenumber']->value < $_smarty_tpl->tpl_vars['pagecount']->value) {?>-->
<!--   <button id="load-more" data-nexturl="<?php echo $_smarty_tpl->tpl_vars['nexturl']->value;?>
&showtemplate=false&lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" class="btns btns_go text-center rounded w-100 text-nowrap" rel="nofollow">Load More</button>-->
<!--<?php }?>-->

<!--<?php if ($_smarty_tpl->tpl_vars['pagecount']->value > 1) {?>-->
<!--<div class="page-list mt-4 mb-4 mb-md-0">-->
<!--    <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value > 1) {?>-->
<!--    <nav class="prev-col">-->
<!--        <ul>-->
<!--            <li><?php echo $_smarty_tpl->tpl_vars['prevpage']->value;?>
</li>-->
<!--        </ul>-->
<!--    </nav>-->
<!--    <?php } else { ?>-->
<!--    <nav class="prev-col disible">-->
<!--        <ul>-->
<!--            <li>-->
<!--                < Prev</li>-->
<!--        </ul>-->
<!--    </nav>-->
<!--    <?php }?>-->
<!--    <nav class="pages">-->
<!--        <ul class="pagination">-->
<!--            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagelinks']->value, 'page');
$_smarty_tpl->tpl_vars['page']->iteration = 0;
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
$_smarty_tpl->tpl_vars['page']->iteration++;
$__foreach_page_4_saved = $_smarty_tpl->tpl_vars['page'];
?>-->
<!--            <li class="page-item <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value == $_smarty_tpl->tpl_vars['page']->iteration) {?>active<?php }?>"><?php echo $_smarty_tpl->tpl_vars['page']->value->link;?>
</li>-->
<!--            <?php
$_smarty_tpl->tpl_vars['page'] = $__foreach_page_4_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>-->
<!--        </ul>-->
<!--    </nav>-->
<!--    <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value < $_smarty_tpl->tpl_vars['pagecount']->value) {?> <nav class="next-col">-->
<!--        <ul>-->
<!--            <li><?php echo $_smarty_tpl->tpl_vars['nextpage']->value;?>
</li>-->
<!--        </ul>-->
<!--        </nav>-->
<!--        <?php } else { ?>-->
<!--        <nav class="next-col disible">-->
<!--            <ul>-->
<!--                <li>Next ></li>-->
<!--            </ul>-->
<!--        </nav>-->
<!--        <?php }?>-->
<!--</div>-->
<!--<?php }?>--><?php }
}
