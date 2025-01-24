<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:27:09
  from 'cms_template:Footer' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837cdd3bfe89_92644995',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3e5873108fd322b3247d0537ee0b3661a9ff3949' => 
    array (
      0 => 'cms_template:Footer',
      1 => '1736670248',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67837cdd3bfe89_92644995 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.sitename.php','function'=>'smarty_function_sitename',),));
?>
<footer class="pb-0">
     <div class="warrp_go_to_top">
             <div class="go_to_top">
                  <a href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/#top" target="_top">
                        <i class="fa-solid fa-angles-up"></i>
                  </a>
            </div>
     </div>
      <div class="container">
            <div class="row pb-3 pb-6">
                 <div class="col-md-5">
                      <div class="footer_item mb-5 mb-sm-0">
                          <div>
                              <a title="<?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
" href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
">
                                    <img class="mb-3" src="uploads/images/<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['logo_dark'];?>
"
                              alt="<?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
" style="max-width: 120px;">
                              </a>
                          </div>
                          <div>
                              <ul>
                                  <li class="d-flex gap-3">
                                         <i style="font-size: 22px;color: var(--darkgreen);" class="fa-solid fa-address-book">
                                               
                                         </i>
                                     <p class="mb-0">
                                      <?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['footer_text'];?>

                                     </p>
                                  </li>
                              </ul>
                          </div>
                      </div>
                 </div>
                  <div class="col-6 col-md-3">
                      <div class="footer_item">
                          <h5>About <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
</h5>
                           <ul class="footer_ul">
                                <li class="menudepth0 first_child">
                                    <a class="" href="">
                                        <span>About <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
</span>
                                    </a>
                                </li>
                                <li class="menudepth0 first_child">
                                    <a class="privacy" href="">
                                        <span>Privacy Policy</span>
                                    </a>
                                </li>
                            </ul>
                      </div>
                  </div>
                  <div class="col-6 col-md-3">
                      <div class="footer_item">
                          <h5>Contact Us</h5>
                          <div class="footer_social_media align-self-end align-self-lg-center">
                             <ul>
                                   <li>
                                         <a class="media_link" target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['facebook_link'];?>
">
                                          <i class="fa-brands fa-facebook"></i>
                                      </a>
                                   </li>
                                   <li>
                                         <a class="media_link"target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['twitter_link'];?>
">
                                          <i class="fa-brands fa-twitter"></i>
                                      </a>
                                   </li>
                                   <li>
                                         <a class="media_link" target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['instagram_link'];?>
">
                                             <i class="fa-brands fa-instagram"></i>
                                         </a>
                                   </li>
                                   <li>
                                         <a class="media_link" target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['linkedin_link'];?>
">
                                          <i class="fa-brands fa-linkedin"></i>
                                         </a>
                                   </li>
                             </ul>
                              <div>
                              <ul>
                              
                                  <li>
          
                                     <a class="link" href="mailto:<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['email'];?>
">
                                          <i class="fa-solid fa-envelope"></i>
                                          <?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['email'];?>

                                      </a>
                                  </li>
                                  <li>
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
                  </div>
           </div>
            
      </div>
      <div class="footer_bottom py-2">
           <p class="copyright text-center">
                © <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['custom_copyright'][0], array( array(),$_smarty_tpl ) );?>
 <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
. All Rights Reserved. 
                by Mr. TIT
           </p>
     </div>
</footer><?php }
}
