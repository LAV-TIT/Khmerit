<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:15
  from 'cms_template:Get_page_show_home' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a8b6f74d5_01445179',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d72e364615e81417e08e4ed2592265e5177f00a' => 
    array (
      0 => 'cms_template:Get_page_show_home',
      1 => '1735492262',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a8b6f74d5_01445179 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nodes']->value, 'node');
$_smarty_tpl->tpl_vars['node']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['node']->value) {
$_smarty_tpl->tpl_vars['node']->do_else = false;
if ($_smarty_tpl->tpl_vars['node']->value->current == false) {?>
      <?php ob_start();
echo $_smarty_tpl->tpl_vars['node']->value->alias;
$_prefixVariable6 = ob_get_clean();
$_smarty_tpl->assign("second_img",cgsimple::get_page_content($_prefixVariable6,"second_img"));?>
      <?php ob_start();
echo $_smarty_tpl->tpl_vars['node']->value->alias;
$_prefixVariable7 = ob_get_clean();
$_smarty_tpl->assign("expect",cgsimple::get_page_content($_prefixVariable7,"expect"));?>
    <div class="col-sm-6 col-lg-4 px-md-3" data-aos="fade" data-aos-delay="50" data-aos-duration="500"
                                  data-aos-easing="ease-in-out">
      <div class="item_blog mb-4 mb-md-0">
            <figure class="mb-4 overflow-hidden w-100" style="height: 355px;max-height: 355px;">
             <a href="<?php echo $_smarty_tpl->tpl_vars['node']->value->url;?>
">
                   <img src="uploads/<?php echo $_smarty_tpl->tpl_vars['second_img']->value;?>
" class="h-100 w-100" alt="<?php echo $_smarty_tpl->tpl_vars['node']->value->menutext;?>
" style="object-fit: cover;">
             </a>
          </figure>
          <div class="blog_body">
            <h5 class="blog_title">
                  <a href="">
                       <?php echo $_smarty_tpl->tpl_vars['node']->value->menutext;?>

                  </a>
            </h5>
            <?php echo $_smarty_tpl->tpl_vars['expect']->value;?>

            
             <a href="<?php echo $_smarty_tpl->tpl_vars['node']->value->url;?>
" class="btn_link">
                Read More
             </a>
            </div>  
      </div>
  </div>
    
<?php }
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
