<?php
/* Smarty version 4.5.2, created on 2025-01-12 19:02:49
  from 'tpl_body:30' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6783af69236980_39343841',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e929a2c9d74a66a5213b8a066517df683c2aaaa4' => 
    array (
      0 => 'tpl_body:30',
      1 => '1736683353',
      2 => 'tpl_body',
    ),
  ),
  'includes' => 
  array (
    'cms_template:Menu_Manager' => 1,
    'cms_template:Footer' => 1,
  ),
),false)) {
function content_6783af69236980_39343841 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),));
?>

<body><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'textinput','block'=>'title_kh','label'=>'Title KH','size'=>40,'max_length'=>100,'assign'=>"title_kh"),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'gallery','block'=>'banner_slider','label'=>'Banner Slide','assign'=>'banner_slider','sub1_field'=>'textinput','sub1_name'=>'title','sub1_label'=>'Title','sub1_size'=>50,'sub1_max_length'=>50,'sub2_field'=>'textinput','sub2_name'=>'link','sub2_label'=>'link','sub2_size'=>50,'sub3_field'=>'textinput','sub3_name'=>'btntext','sub3_label'=>'Button text','sub3_size'=>50,'sub3_max_length'=>50,'sub4_field'=>'textarea','sub4_name'=>'description','sub4_label'=>'Description','sub4_max_length'=>100),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'gallery','block'=>'img_our_team','label'=>'Images Our Teams','assign'=>'img_our_team','sub1_field'=>'textinput','sub1_name'=>'link','sub1_label'=>'Link','sub1_size'=>50),$_smarty_tpl ) );
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Image 2",'block'=>'img2','assign'=>"img2"),$_smarty_tpl ) );
$_smarty_tpl->_subTemplateRender('cms_template:Menu_Manager', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?><section class="banner"><div class="swiper banner_slider"><div class="swiper-wrapper"><?php if (!empty($_smarty_tpl->tpl_vars['banner_slider']->value->sub_fields)) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['banner_slider']->value->sub_fields, 'sub_field');
$_smarty_tpl->tpl_vars['sub_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sub_field']->value) {
$_smarty_tpl->tpl_vars['sub_field']->do_else = false;
$_smarty_tpl->_assignInScope('mg', ((string)$_smarty_tpl->tpl_vars['sub_field']->value->file_location).((string)$_smarty_tpl->tpl_vars['sub_field']->value->filename));
ob_start();
echo smarty_modifier_replace($_smarty_tpl->tpl_vars['sub_field']->value->file_location,'\\','/');
$_prefixVariable1=ob_get_clean();
$_smarty_tpl->_assignInScope('mg', $_prefixVariable1.((string)$_smarty_tpl->tpl_vars['sub_field']->value->filename));?><div data-hash="slide1" class="swiper-slide" style="background:linear-gradient(90deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),url(<?php echo smarty_function_root_url(array(),$_smarty_tpl);
echo $_smarty_tpl->tpl_vars['mg']->value;?>
);background-position: center;background-repeat: no-repeat;background-size: cover;"><div class="banner_content"><h1 class="h1" data-aos="fade-down-right" data-aos-delay="50" data-aos-duration="1000" data-aos-easing="ease-in-out"><?php echo $_smarty_tpl->tpl_vars['sub_field']->value->title;?>
</h1><div class="read_text"><p><?php echo $_smarty_tpl->tpl_vars['sub_field']->value->description;?>
</p><?php if (!empty($_smarty_tpl->tpl_vars['sub_field']->value->btntext)) {?><a href="<?php echo $_smarty_tpl->tpl_vars['sub_field']->value->link;?>
" class="btns_go p-3"><?php echo $_smarty_tpl->tpl_vars['sub_field']->value->btntext;?>
<i class="ms-1 icon fa-solid fa-arrow-right-long"></i></a><?php }?></div></div></div><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?></div><div class="btn_banner swiper-button-next"></div><div class="btn_banner swiper-button-prev"></div><div class="swiper-pagination"></div></div></section><section><div class="container-fluid mt-5 px-md-5"><h2 class="h2 mb-4"><?php echo Navigator::function_plugin(array('template'=>"get_title",'items'=>"technology"),$_smarty_tpl);?>
</h2><div class="row news mb-5"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEMediaSolutions'][0], array( array('summarytemplate'=>"theme_summary_home",'pagelimit'=>"3",'category'=>"technology",'detailpage'=>"technology",'xf_startyear'=>"2024",'xf_endyear'=>"2025",'orderby'=>'item_id|DESC'),$_smarty_tpl ) );?>
</div><div class="row news"><div class="col-lg-10"><div class="row"><div class="wrapp_slide position-relative"><div class="slide_title position-relative"><h2 class="h2"><?php echo Navigator::function_plugin(array('template'=>"get_title",'items'=>"media"),$_smarty_tpl);?>
</h2><div class="btn_slides h-100"><div class="btn_slide swiper-button-prev"></div><div class="btn_slide swiper-button-next"></div></div></div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEMediaSolutions'][0], array( array('summarytemplate'=>"theme_summary_slide",'pagelimit'=>'','category'=>"technology",'detailpage'=>"technology",'xf_startyear'=>"2024",'xf_endyear'=>"2025",'orderby'=>'item_id|DESC'),$_smarty_tpl ) );?>
</div><p class="pt-4 mb-5 text-center"><a href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/technology.php?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
"class="return-link btns py-2 px-3 text-center rounded"style="min-width: 130px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"See More",'kh_txt'=>"មើលច្រើនទៀត"),$_smarty_tpl ) );?>
<i class="ms-2 fa-solid fa-arrow-right"></i></a></p></div><div class="row"><div class="wrapp_slide position-relative"><div class="slide_title position-relative"><h2 class="h2"><?php echo Navigator::function_plugin(array('template'=>"get_title",'items'=>"coding"),$_smarty_tpl);?>
</h2><div class="btn_slides h-100"><div class="btn_slide swiper-button-prev"></div><div class="btn_slide swiper-button-next"></div></div></div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEMediaSolutions'][0], array( array('summarytemplate'=>"theme_summary_slide",'pagelimit'=>'','category'=>"technology",'detailpage'=>"technology",'xf_startyear'=>"2024",'xf_endyear'=>"2025",'orderby'=>'item_id|DESC'),$_smarty_tpl ) );?>
</div><p class="pt-4 mb-5 text-center"><a href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/technology.php?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
"class="return-link btns py-2 px-3 text-center rounded"style="min-width: 130px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"See More",'kh_txt'=>"មើលច្រើនទៀត"),$_smarty_tpl ) );?>
<i class="ms-2 fa-solid fa-arrow-right"></i></a></p></div></div><div class="col-lg-2"><div class="row position-sticky" style="top: 80px;"><div class="col-sm-6 col-md-12"><img style="margin-bottom: 15px;" src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf" width="100%" /></div><div class="col-sm-6 col-md-12"><img style="margin-bottom: 15px;" src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf" width="100%" /></div><div class="col-sm-6 col-md-12"><img src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf" width="100%" /></div></div></div></div></div></section><?php CMS_Content_Block::smarty_internal_fetch_contentblock(array(),$_smarty_tpl);
$_smarty_tpl->_subTemplateRender('cms_template:Footer', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"><?php echo '</script'; ?>
><?php echo '<script'; ?>
 src="./assets/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
><?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"><?php echo '</script'; ?>
><?php echo '<script'; ?>
 src="./assets/aos-master/dist/aos.js"><?php echo '</script'; ?>
><?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/sweetalert2@11"><?php echo '</script'; ?>
><?php echo '<script'; ?>
 src="./assets/js/main.js"><?php echo '</script'; ?>
></body></html><?php }
}
