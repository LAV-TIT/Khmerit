<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:36:44
  from 'cms_template:43' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837f1c7af056_28277481',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b12390f6eed4ec91f174fc79da4d3f6f4ab893ef' => 
    array (
      0 => 'cms_template:43',
      1 => '1735888514',
      2 => 'cms_template',
    ),
    '3dd1690d6cd2aa9d0a7908a32d6b3b24f0d96cac' => 
    array (
      0 => 'cms_template:Menu_Manager',
      1 => '1735979342',
      2 => 'cms_template',
    ),
    'a59e354d7aa1db0b52df23f37d4d5e7c2e64e315' => 
    array (
      0 => 'cms_template:Model_Form_Search',
      1 => '1735979266',
      2 => 'cms_template',
    ),
    '4b1dcb2d2979f534440475e9887143518b7a2ebd' => 
    array (
      0 => 'cms_template:Banner_Image',
      1 => '1736594379',
      2 => 'cms_template',
    ),
    '89a397fb537074b2cf23a6af86f50ee3483932f9' => 
    array (
      0 => 'cms_template:Form_Control',
      1 => '1736420487',
      2 => 'cms_template',
    ),
    '3e5873108fd322b3247d0537ee0b3661a9ff3949' => 
    array (
      0 => 'cms_template:Footer',
      1 => '1736670248',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
    'cms_template:Menu_Manager' => 1,
    'cms_template:Model_Form_Search' => 1,
    'cms_template:Banner_Image' => 1,
    'cms_template:Form_Control' => 1,
    'cms_template:Footer' => 1,
  ),
),false)) {
function content_67837f1c7af056_28277481 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.cms_get_language.php','function'=>'smarty_function_cms_get_language',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.title.php','function'=>'smarty_function_title',),2=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.sitename.php','function'=>'smarty_function_sitename',),3=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.metadata.php','function'=>'smarty_function_metadata',),4=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),5=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.cms_stylesheet.php','function'=>'smarty_function_cms_stylesheet',),));
?>
<!DOCTYPE html>
<html lang="<?php echo smarty_function_cms_get_language(array(),$_smarty_tpl);?>
">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo smarty_function_title(array(),$_smarty_tpl);?>
 - <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
</title>
    <?php echo smarty_function_metadata(array(),$_smarty_tpl);?>

    <meta name="url" content="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
"/> 
    <meta name="description" content=" ">
    <meta name="keywords" content=" ">
    <meta name="identifier-URL" content="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
"/>
    <meta property="og:site_name" content="<?php echo smarty_function_title(array(),$_smarty_tpl);?>
 - <?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
"/>
    <meta property="og:title" content="<?php echo smarty_function_title(array(),$_smarty_tpl);?>
"/> 
    <meta property="og:image:type" content="image"/> 
    <meta property="og:image:width" content="1400"/> 
    <meta property="og:image:height" content="770"/> 
    <meta name="twitter:card" content="summary_large_image"/> 
    <meta property="og:type" content="Business"/> 
    <meta property="og:url" content="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
"/>
    <meta name="twitter:title" content="<?php echo smarty_function_title(array(),$_smarty_tpl);?>
" /> 

	<?php echo smarty_function_cms_stylesheet(array(),$_smarty_tpl);?>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./assets/aos-master/dist/aos.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <style>
          .btn_submit:disabled {
    border: 2px solid #99afb5;
    text-shadow: .1rem .1rem 0 #99afb5;
    background: #c9d5d8;
    text-shadow: .1rem .1rem 0 #99afb5;
    background: #c9d5d8;
    border: 2px solid #c9d5d8;
    cursor: not-allowed;
    border-radius: 5px;
    }
    </style>
    
</head>
<body>
      
         
        
         
      
	<?php
$_smarty_tpl->_subTemplateRender('cms_template:Menu_Manager', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false, '3dd1690d6cd2aa9d0a7908a32d6b3b24f0d96cac', 'content_67837f1c76e5f7_29413761');
?>
	
	<?php
$_smarty_tpl->_subTemplateRender('cms_template:Banner_Image', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false, '4b1dcb2d2979f534440475e9887143518b7a2ebd', 'content_67837f1c785117_86689626');
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
                             <?php
$_smarty_tpl->_subTemplateRender('cms_template:Form_Control', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false, '89a397fb537074b2cf23a6af86f50ee3483932f9', 'content_67837f1c798708_78607900');
?>
                       </div>
                 </div>
                 
            </div>
            <div class="mt-4 pt-4 mt-md-5 pt-md-5">
                  
            </div>
      </section>
	
    <?php
$_smarty_tpl->_subTemplateRender('cms_template:Footer', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false, '3e5873108fd322b3247d0537ee0b3661a9ff3949', 'content_67837f1c7a2770_83272487');
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
    
    <?php echo '<script'; ?>
>
    
    
    
          
    <?php echo '</script'; ?>
>
    
</body>

</html><?php }
/* Start inline template "cms_template:Model_Form_Search" =============================*/
function content_67837f1c77cc75_93363391 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="modal fade " id="modal_search" tabindex="-1" aria-hidden="true" style="height: 100vh;">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-fullscreen-sm-down">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title fs-5"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"Search",'kh_txt'=>"ស្វែងរក"),$_smarty_tpl ) );?>
</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div>
      
    </div>
    <div class="modal-body py-4">
      <div id="search-results" class="search-results"></div>
    </div>
  </div>
</div>
</div><?php
}
/* End inline template "cms_template:Model_Form_Search" =============================*/
/* Start inline template "cms_template:Menu_Manager" =============================*/
function content_67837f1c76e5f7_29413761 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.sitename.php','function'=>'smarty_function_sitename',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),));
?>
<header id="header" class="fixed-top">
        <nav id="nav" class="navbar navbar-expand-lg">
          <div class="container-fluid px-md-5 position-relative">
            <a title="<?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
" class="navbar-brand" href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
">
              <img class="img_logo white" src="uploads/images/<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['logo'];?>
" alt="<?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
" width="80px">
              <img class="img_logo dark" src="uploads/images/<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['logo_dark'];?>
" alt="<?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
" width="80px">
            </a>
            
            <div class="order-2 d-flex align-items-center">
                  <div class="pe-3">
                        <a title="search" href="#" class="btn-search" data-bs-toggle="modal" data-bs-target="#modal_search">
                              <i class="fa-solid fa-magnifying-glass"></i>
                          </a>
                  </div>
                  
                  <div class="languages">
                        <a title="Khmer" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['selft_url'][0], array( array(),$_smarty_tpl ) );?>
?lang=kh" class="lang  d-inline-block">
                        <img class='icon_lang' src='uploads/images/khmer-flag.svg' alt='icon_en.jpg'width='30px'>
                        </a>
                        <a title="English" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['selft_url'][0], array( array(),$_smarty_tpl ) );?>
?lang=en" class="lang px-2 d-inline-block">
                          <img class='icon_lang' src='uploads/images/english-flag.svg' alt='icon_en.jpg' width='30px'>
                          </a>
                  </div>
                  <button class="btn_toggle ms-3 d-lg-none" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
                          <span></span>
                          <span></span>
                          <span></span>
                  </button>
            </div>
            
            
            <div class="collapse navbar-collapse" id="navbarToggler">
                
                
            </div>
            
          </div>
        </nav>
        <?php
$_smarty_tpl->_subTemplateRender('cms_template:Model_Form_Search', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false, 'a59e354d7aa1db0b52df23f37d4d5e7c2e64e315', 'content_67837f1c77cc75_93363391');
?>
</header><?php
}
/* End inline template "cms_template:Menu_Manager" =============================*/
/* Start inline template "cms_template:Banner_Image" =============================*/
function content_67837f1c785117_86689626 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.title.php','function'=>'smarty_function_title',),));
?>
<div class="banner_image"style="background:linear-gradient(90deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
              url(uploads<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['banner_img']->value,'\\','/');?>
);
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
              <?php if ($_smarty_tpl->tpl_vars['page_alias']->value != "technology") {?>
              background-attachment: fixed;
              <?php }?>
              ">
          
      <div class="container-fluid px-md-5 mb-2">
            
            <h2 class="h2 text-white">
            <?php ob_start();
echo smarty_function_title(array(),$_smarty_tpl);
$_prefixVariable1=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>$_prefixVariable1,'kh_txt'=>((string)$_smarty_tpl->tpl_vars['title_kh']->value)),$_smarty_tpl ) );?>

            </h2>
      </div>
 </div><?php
}
/* End inline template "cms_template:Banner_Image" =============================*/
/* Start inline template "cms_template:Form_Control" =============================*/
function content_67837f1c798708_78607900 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.sitename.php','function'=>'smarty_function_sitename',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),));
?>
<form id="contactForm" method="POST" action="" class="needs-validation" novalidate>
        <input type="hidden" name="sitename" value="<?php echo smarty_function_sitename(array(),$_smarty_tpl);?>
">
        <input type="hidden" name="url" value="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
">
        <input type="hidden" name="email_owner" value="lav.tit19@gmail.com">
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-2 mb-sm-4 pb-2">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    <div class="invalid-feedback">
                        Please enter your name!
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-2 mb-sm-4 pb-2">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                    <div class="invalid-feedback">
                        Please enter your email!
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-2 mb-sm-4 pb-2">
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                    <div class="invalid-feedback">
                        Please enter your phone number!
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="mb-2 mb-sm-4 pb-2">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                    <div class="invalid-feedback">
                        Please enter your subject!
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-2 mb-sm-4 pb-2">
                    <textarea class="form-control" name="sms" id="sms" rows="5" placeholder="Your Message" required></textarea>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end align-items-center">
                <button type="submit" class="btn_submit btns_go">Submit Request</button>
            </div>
        </div>
    </form><?php
}
/* End inline template "cms_template:Form_Control" =============================*/
/* Start inline template "cms_template:Footer" =============================*/
function content_67837f1c7a2770_83272487 (Smarty_Internal_Template $_smarty_tpl) {
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
</footer><?php
}
/* End inline template "cms_template:Footer" =============================*/
}
