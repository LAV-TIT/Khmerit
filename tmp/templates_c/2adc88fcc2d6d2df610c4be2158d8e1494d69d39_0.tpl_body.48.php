<?php
/* Smarty version 4.5.2, created on 2025-01-12 15:32:00
  from 'tpl_body:48' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67837e00334fc7_40238475',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2adc88fcc2d6d2df610c4be2158d8e1494d69d39' => 
    array (
      0 => 'tpl_body:48',
      1 => '1736141481',
      2 => 'tpl_body',
    ),
  ),
  'includes' => 
  array (
    'cms_template:Menu_Manager' => 1,
    'cms_template:Banner_Image' => 1,
    'cms_template:Footer' => 1,
  ),
),false)) {
function content_67837e00334fc7_40238475 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.Title.php','function'=>'smarty_function_Title',),));
?>
<body>   <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'textinput','block'=>'title_kh','label'=>'Title KH','size'=>40,'max_length'=>100,'assign'=>"title_kh"),$_smarty_tpl ) );?>

         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'textinput','block'=>'title2','label'=>'Title2','size'=>55,'max_length'=>55,'assign'=>"title2"),$_smarty_tpl ) );?>

         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Banner Image",'block'=>'banner_img','assign'=>"banner_img"),$_smarty_tpl ) );?>

         <?php CMS_Content_Block::smarty_internal_fetch_contentblock(array('module'=>"ECB2",'field'=>"textarea",'label'=>"Expect Text",'block'=>"expect",'wysiwyg'=>1,'rows'=>3,'cols'=>100,'assign'=>"expect"),$_smarty_tpl); ?>
         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Second Image",'block'=>'second_img','assign'=>"second_img"),$_smarty_tpl ) );?>

         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Image",'block'=>'img2','assign'=>"img2"),$_smarty_tpl ) );?>

         <?php CMS_Content_Block::smarty_internal_fetch_contentblock(array('module'=>"ECB2",'field'=>"textarea",'label'=>"Description",'block'=>"desc",'wysiwyg'=>1,'rows'=>100,'cols'=>100,'assign'=>"desc"),$_smarty_tpl); ?>
         
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'group','label'=>"Privacy Notice",'tab'=>"Privacy Notice",'block'=>'privacy_notice','assign'=>'privacy_notice','sub1_field'=>'file_picker','sub1_name'=>'pdf','sub1_label'=>'PDF File','sub1_size'=>100,'sub2_field'=>'textarea','sub2_name'=>'des','sub2_label'=>'Description'),$_smarty_tpl ) );?>

  
	<?php $_smarty_tpl->_subTemplateRender('cms_template:Menu_Manager', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	<?php $_smarty_tpl->_subTemplateRender('cms_template:Banner_Image', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	<section class="section_blog pb-3 pb-md-5">
  	  <div class="container">
  	    <div class="row mb-md-4">
  	          <h2 class="h2 head_title text-center">
  	                Portfolio
  	          </h2>
  	    </div>
  	    	<?php echo $_smarty_tpl->tpl_vars['LISEGlobalContent']->value['portfolio_details'];?>

       </div>
       </section>
       <section class="section pb-3 pb-md-5">
  	  <div class="container">
  	    <div class="row mb-md-4">
  	          <h2 class="h2 head_title text-center">
  	               <?php if (empty($_smarty_tpl->tpl_vars['title2']->value)) {?>
  	                  <?php echo smarty_function_Title(array(),$_smarty_tpl);?>

  	               <?php } else { ?>
  	                  <?php echo $_smarty_tpl->tpl_vars['title2']->value;?>

  	               <?php }?>
  	          </h2>
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
 src="./assets/js/main.js"><?php echo '</script'; ?>
>
    
</body>

</html><?php }
}
