<?php
/* Smarty version 4.5.2, created on 2025-01-12 19:04:42
  from 'cms_template:G_blog' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6783afda0c3684_84052214',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78ea3036e6a26e021ab7ec82bbfeba57b79b3c2f' => 
    array (
      0 => 'cms_template:G_blog',
      1 => '1736683360',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
    'cms_template:Banner_Image' => 1,
  ),
),false)) {
function content_6783afda0c3684_84052214 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="banner">
      <?php $_smarty_tpl->_subTemplateRender('cms_template:Banner_Image', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</div>
<div class="container-fluid py-4 py-md-5 px-md-5">
  <div class="row">
      <div class="col-md-9">
          <div id="content-list" class="row news">
                <?php if ($_smarty_tpl->tpl_vars['page_alias']->value != "media") {?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEMediaSolutions'][0], array( array('summarytemplate'=>"default",'detailpage'=>"technology",'pagelimit'=>'','category'=>"technology",'xf_startyear'=>"2024",'xf_endyear'=>"2025",'orderby'=>'item_id|DESC'),$_smarty_tpl ) );?>

              
              <?php } else { ?>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEMediaSolutions'][0], array( array('summarytemplate'=>"default",'pagelimit'=>'','detailpage'=>"media",'category'=>'','xf_startyear'=>"2024",'xf_endyear'=>"2025",'orderby'=>'item_id|DESC'),$_smarty_tpl ) );?>

              
              <?php }?>
            </div>
      </div>
      <div class="col-md-3">
          <div class="row position-sticky" style="top: 80px;">
              <div class="col-sm-6 col-md-12">
                    <img style="margin-bottom: 15px;"
                      src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf"
                      width="100%" />
                   
                   </div>
              <div class="col-sm-6 col-md-12">
                    <img src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf"
                      width="100%" />
               </div>
          </div>
      </div>
  </div>
</div><?php }
}
