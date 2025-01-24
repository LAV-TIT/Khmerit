<?php
/* Smarty version 4.5.2, created on 2025-01-12 19:04:57
  from 'module_db_tpl:LISEOperatingBusiness;summary_default' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6783afe9ee37c7_55771750',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7e0a003073243fb4a3d0e3154400aa46634facb2' => 
    array (
      0 => 'module_db_tpl:LISEOperatingBusiness;summary_default',
      1 => 1734582604,
      2 => 'module_db_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6783afe9ee37c7_55771750 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.count.php','function'=>'smarty_modifier_count',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<div class="row news">
      <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['items']->value) > 0) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['items']->value, 'item');
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
      
       
          <div class="col-sm-6 col-lg-4 px-md-3" data-aos="fade" data-aos-delay="50" data-aos-duration="500" data-aos-easing="ease-in-out">
            <div class="border-0 p-0 item_blog mb-4">
                  <figure class="rounded-top overflow-hidden w-100">
                   <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
">
                        <img src="uploads/<?php echo $_smarty_tpl->tpl_vars['item']->value->bannerphoto;?>
" class="h-100 w-100" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>
" style="object-fit: cover;">
                   </a>
                 </figure>
                <div class="blog_body rounded-bottom border p-3">
                  <h5 class="blog_title">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
">
                            <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,"...");?>

                        </a>
                  </h5>
                  
                        <a href="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
" class="btns btns_go mb-1 mt-4 mt-sm-3 d-block text-center rounded">
                               Read More
                         </a>
                   
                  </div>  
            </div>
        </div>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
</div>

<!--<?php if ($_smarty_tpl->tpl_vars['pagenumber']->value < $_smarty_tpl->tpl_vars['pagecount']->value) {?>-->
            <!--   <a href="<?php echo $_smarty_tpl->tpl_vars['nexturl']->value;?>
&showtemplate=false" class="jscroll-link" rel="nofollow">load more</a>-->
            <!--<?php }?>-->
            
<?php if ($_smarty_tpl->tpl_vars['pagecount']->value > 1) {?>
    <div class="page-list mt-4 mb-4 mb-md-0">
      <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value > 1) {?>
          <nav class="prev-col">
            <ul>
              <li><?php echo $_smarty_tpl->tpl_vars['prevpage']->value;?>
</li>
            </ul>
          </nav>
      <?php } else { ?>
         <nav class="prev-col disible">
            <ul>
              <li>< Prev</li>
            </ul>
          </nav>
      <?php }?>
      <nav class="pages">
        <ul class="pagination">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pagelinks']->value, 'page');
$_smarty_tpl->tpl_vars['page']->iteration = 0;
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
$_smarty_tpl->tpl_vars['page']->iteration++;
$__foreach_page_1_saved = $_smarty_tpl->tpl_vars['page'];
?>
            <li class="page-item <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value == $_smarty_tpl->tpl_vars['page']->iteration) {?>active<?php }?>"><?php echo $_smarty_tpl->tpl_vars['page']->value->link;?>
</li>
        <?php
$_smarty_tpl->tpl_vars['page'] = $__foreach_page_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
      </nav>
      <?php if ($_smarty_tpl->tpl_vars['pagenumber']->value < $_smarty_tpl->tpl_vars['pagecount']->value) {?>
          <nav class="next-col">
            <ul>
              <li><?php echo $_smarty_tpl->tpl_vars['nextpage']->value;?>
</li>
            </ul>
          </nav>
      <?php } else { ?>
         <nav class="next-col disible">
            <ul>
              <li>Next ></li>
            </ul>
          </nav>
      <?php }?>
    </div>
<?php }
}
}
