<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:16
  from 'tpl_body:50' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a8c007cf4_20832274',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '241aef54c5a55ed16c8c6d9ee1b1b83a659f6c6e' => 
    array (
      0 => 'tpl_body:50',
      1 => '1734515787',
      2 => 'tpl_body',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a8c007cf4_20832274 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.title.php','function'=>'smarty_function_title',),2=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),));
?>
<body>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Banner Image",'block'=>'banner_img','assign'=>"banner_img"),$_smarty_tpl ) );?>

	<section class="d-flex align-items-center justify-content-center" style="height: 100vh;
	background: url(uploads<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['banner_img']->value,'\\','/');?>
);
	background-position: center;
    background-size: cover;
    background-repeat: no-repeat;">
  	  <div class="container">
  	    <div class="row mb-md-4 text-center">
  	          <h2 class="text-danger h2 head_title" style="font-size: 45px;">
  	                <?php echo smarty_function_title(array(),$_smarty_tpl);?>

  	          </h2>
  	          <div>
  	                 <a href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
" class="text-green rounded border p-2">
                       <i class="fa-solid fa-arrow-left"></i> Back to home 
                  </a>
  	          </div>
  	    </div>
  	    	<?php CMS_Content_Block::smarty_internal_fetch_contentblock(array(),$_smarty_tpl); ?>
       </div>
       </section>
	
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
 src="./assets/js/main.js"><?php echo '</script'; ?>
>
    
</body>

</html><?php }
}
