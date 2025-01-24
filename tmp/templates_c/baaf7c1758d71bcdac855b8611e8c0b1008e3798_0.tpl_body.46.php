<?php
/* Smarty version 4.5.2, created on 2025-01-12 01:04:28
  from 'tpl_body:46' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782b2acdc58b5_51281849',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'baaf7c1758d71bcdac855b8611e8c0b1008e3798' => 
    array (
      0 => 'tpl_body:46',
      1 => '1736017417',
      2 => 'tpl_body',
    ),
  ),
  'includes' => 
  array (
    'cms_template:Menu_Manager' => 1,
    'cms_template:Footer' => 1,
  ),
),false)) {
function content_6782b2acdc58b5_51281849 (Smarty_Internal_Template $_smarty_tpl) {
?><body>
         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'textinput','block'=>'title_kh','label'=>'Title KH','size'=>40,'max_length'=>100,'assign'=>"title_kh"),$_smarty_tpl ) );?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Banner Image",'block'=>'banner_img','assign'=>"banner_img"),$_smarty_tpl ) );?>

         <?php CMS_Content_Block::smarty_internal_fetch_contentblock(array('module'=>"ECB2",'field'=>"textarea",'label'=>"Expect Text",'block'=>"expect",'wysiwyg'=>1,'rows'=>3,'cols'=>100,'assign'=>"expect"),$_smarty_tpl); ?>
         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Second Image",'block'=>'second_img','assign'=>"second_img"),$_smarty_tpl ) );?>

         <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['content_module'][0], array( array('module'=>'ECB2','field'=>'file_picker','label'=>"Image",'block'=>'img2','assign'=>"img2"),$_smarty_tpl ) );?>

         <?php CMS_Content_Block::smarty_internal_fetch_contentblock(array('module'=>"ECB2",'field'=>"textarea",'label'=>"Description",'block'=>"desc",'wysiwyg'=>1,'rows'=>100,'cols'=>100,'assign'=>"desc"),$_smarty_tpl); ?>
  
	<?php $_smarty_tpl->_subTemplateRender('cms_template:Menu_Manager', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
	
	<?php CMS_Content_Block::smarty_internal_fetch_contentblock(array(),$_smarty_tpl); ?>
    <?php $_smarty_tpl->_subTemplateRender('cms_template:Footer', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="./assets/js/bootstrap.bundle.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"><?php echo '</script'; ?>
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
