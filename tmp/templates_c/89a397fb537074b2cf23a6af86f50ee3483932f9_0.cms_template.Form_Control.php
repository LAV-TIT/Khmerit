<?php
/* Smarty version 4.5.2, created on 2025-01-12 13:30:02
  from 'cms_template:Form_Control' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6783616a2b3158_13798565',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '89a397fb537074b2cf23a6af86f50ee3483932f9' => 
    array (
      0 => 'cms_template:Form_Control',
      1 => '1736420487',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6783616a2b3158_13798565 (Smarty_Internal_Template $_smarty_tpl) {
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
    </form><?php }
}
