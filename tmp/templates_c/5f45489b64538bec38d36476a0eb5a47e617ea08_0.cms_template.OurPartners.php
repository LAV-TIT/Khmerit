<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:15
  from 'cms_template:OurPartners' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a8b805d68_65748606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5f45489b64538bec38d36476a0eb5a47e617ea08' => 
    array (
      0 => 'cms_template:OurPartners',
      1 => '1735983933',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a8b805d68_65748606 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),));
if (!empty($_smarty_tpl->tpl_vars['img_our_team']->value->sub_fields)) {?>
<section class="section">
      <div class="container">
           <div class="row">
                <h2 class="h2 text-center head_title">Our Technology Partners</h2>
                <div id="get_id_slide" class="swiper get_id_slide">
                <div id="our_teams" class="swiper our_teams">
                  <div class="swiper-wrapper">
                      
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['img_our_team']->value->sub_fields, 'sub_field');
$_smarty_tpl->tpl_vars['sub_field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sub_field']->value) {
$_smarty_tpl->tpl_vars['sub_field']->do_else = false;
?>
                        <?php $_smarty_tpl->_assignInScope('mg', ((string)$_smarty_tpl->tpl_vars['sub_field']->value->file_location).((string)$_smarty_tpl->tpl_vars['sub_field']->value->filename));?>
                        <div class="swiper-slide" data-aos="fade-up" data-aos-delay="50"
                                data-aos-duration="1000" data-aos-easing="ease-in-out">
                              <a href="<?php echo $_smarty_tpl->tpl_vars['sub_field']->value->link;?>
" target="_blank">
                                    <img src="<?php echo smarty_function_root_url(array(),$_smarty_tpl);
echo $_smarty_tpl->tpl_vars['mg']->value;?>
" class="slide_img" alt="">
                              </a>
                         </div>
                        
                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                     
                  </div>
                  <div class="swiper-pagination"></div>
              </div>
           </div>
      </div>
</section>
<?php }
}
}
