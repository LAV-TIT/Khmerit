<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:38:40
  from 'tpl_body:43' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837f902517f1_39374266',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '73a10caf1808904b78af53dd32c70e944d04358b' => 
    array (
      0 => 'tpl_body:43',
      1 => '1736671108',
      2 => 'tpl_body',
    ),
  ),
  'includes' => 
  array (
    'cms_template:Menu_Manager' => 1,
    'cms_template:Banner_Image' => 1,
    'cms_template:Form_Control' => 1,
    'cms_template:Footer' => 1,
  ),
),false)) {
function content_67837f902517f1_39374266 (Smarty_Internal_Template $_smarty_tpl) {
?><body>
      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'textinput','block'=>'title_kh','label'=>'Title KH','size'=>40,'max_length'=>100,'assign'=>"title_kh"),$_smarty_tpl ) );?>

         <?php CMS_Content_Block::smarty_internal_fetch_contentblock(array('module'=>"ECB2",'field'=>"textarea",'label'=>"Expect Text",'block'=>"expect",'wysiwyg'=>1,'rows'=>3,'cols'=>100,'assign'=>"expect"),$_smarty_tpl); ?>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Banner Image",'block'=>'banner_img','assign'=>"banner_img"),$_smarty_tpl ) );?>

         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Second Image",'block'=>'second_img','assign'=>"second_img"),$_smarty_tpl ) );?>

      
	<?php $_smarty_tpl->_subTemplateRender('cms_template:Menu_Manager', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	<?php $_smarty_tpl->_subTemplateRender('cms_template:Banner_Image', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	<section class="section pb-4 pb-md-5">
            <div class="container">
                 <div class="row justify-content-center">
                       <div class="col-sm-12 col-md-12 col-lg-7 mb-4"> 
                            <div class="text-center">
                                   <p style="font-size: 14px;color: var(--darkgreen);">
                                   <strong>Get In Touch</strong>
                                  </p>
                                  <h2 class="h2 mb-3 head_title">Contact Us</h2>
                                  <?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['contact_description'];?>

                                  <div class="footer_item text-start my-3 my-md-5">
                                    <ul>
                                        <li class="mb-3 d-flex gap-3">
                                               <i style="font-size: 22px;color: var(--darkgreen);" class="fa-solid fa-address-book">
                                                     
                                               </i>
                                           <p class="mb-0">
                                            <?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['footer_text'];?>

                                           </p>
                                        </li>
                                        <li  class="mb-3">
                
                                           <a class="link" href="mailto:<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['email'];?>
">
                                                <i class="fa-solid fa-envelope"></i>
                                                <?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['email'];?>

                                            </a>
                                        </li>
                                        <li class="mb-3">
                                            <a class="link" href="tel:<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['phone_number'];?>
">
                                                <?php if ($_smarty_tpl->tpl_vars['LISEGlobalContent']->value['phone_number'] != '') {?>
                                                <i class="fa-solid fa-phone"></i>
                                                <?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['phone_number'];?>

                                                <?php }?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                       <div class="col-sm-12 col-md-12 col-lg-8">
                             <?php $_smarty_tpl->_subTemplateRender('cms_template:Form_Control', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                       </div>
                 </div>
                 <?php CMS_Content_Block::smarty_internal_fetch_contentblock(array(),$_smarty_tpl); ?>
            </div>
      </section>
	
    <?php $_smarty_tpl->_subTemplateRender('cms_template:Footer', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="./assets/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./assets/aos-master/dist/aos.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/sweetalert2@11"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="./assets/js/main.js"><?php echo '</script'; ?>
>
</body>

</html><?php }
}
