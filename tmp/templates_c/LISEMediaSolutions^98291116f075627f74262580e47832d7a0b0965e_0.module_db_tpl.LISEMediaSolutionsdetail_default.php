<?php
/* Smarty version 4.5.2, created on 2025-01-12 13:30:32
  from 'module_db_tpl:LISEMediaSolutions;detail_default' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_678361886aafa8_26822377',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98291116f075627f74262580e47832d7a0b0965e' => 
    array (
      0 => 'module_db_tpl:LISEMediaSolutions;detail_default',
      1 => 1736663425,
      2 => 'module_db_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_678361886aafa8_26822377 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\modifier.cms_escape.php','function'=>'smarty_modifier_cms_escape',),2=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.date_format.php','function'=>'smarty_modifier_date_format',),3=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.explode.php','function'=>'smarty_modifier_explode',),4=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),5=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.truncate.php','function'=>'smarty_modifier_truncate',),));
?>
<section class="banner">
    <div class="banner_image" style="height: 35vh;background:linear-gradient(90deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url(uploads<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['item']->value->banner_photo,'\\','/');?>
);
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
                ">

        <div class="container-fluid px-md-5 mb-6">
            <?php echo Navigator::nav_breadcrumbs(array(),$_smarty_tpl);?>

            <h2 class="h2 text-white" style="max-width: 600px;">
                <!--translate en_txt="<?php echo smarty_modifier_cms_escape($_smarty_tpl->tpl_vars['item']->value->title);?>
"-->
                <!--        kh_txt="<?php echo smarty_modifier_cms_escape($_smarty_tpl->tpl_vars['item']->value->title_kh);?>
"-->
                <!--        }-->
            </h2>
        </div>
    </div>
</section>
<section>
    <div class="container-fluid py-4 py-md-5 px-md-5">
        <div class="row news_detail">
            <?php $_smarty_tpl->_assignInScope('j', ((string)$_smarty_tpl->tpl_vars['item']->value->alias));?>
            
            <div class="col-lg-2 d-none d-lg-block">
                   <div class="row blog_theme blog_news mt-4 mt-md-0 position-sticky" 
                style="top: 80px;">
                        <div class="col-sm-6 col-lg-12">
                                <img style="margin-bottom: 15px;"
                                  src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf"
                                  width="100%" />
                                  
                       </div>
                       <div class="col-sm-6 col-lg-12">
                                <img style="margin-bottom: 15px;"
                                  src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf"
                                  width="100%" />
                                  
                       </div>
                          <div class="col-sm-6 col-lg-12">
                                <img src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf"
                                  width="100%" />
                        </div>
                </div>
            </div>
            <div class="col-lg-8">
                   <h2 class="h2 mb-3">
                <?php ob_start();
echo smarty_modifier_cms_escape($_smarty_tpl->tpl_vars['item']->value->title);
$_prefixVariable1=ob_get_clean();
ob_start();
echo smarty_modifier_cms_escape($_smarty_tpl->tpl_vars['item']->value->title_kh);
$_prefixVariable2=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>$_prefixVariable1,'kh_txt'=>$_prefixVariable2),$_smarty_tpl ) );?>

            </h2>
                <div class="blog_theme mb-3">
                    <!--<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->date,"%b %d, %Y %I:%M:%S %p");?>
-->
                    <!--<p class="mb-2">-->
                    <!--    <small>-->
                    <!--        <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['item']->value->date,"%b %d, %Y");?>
-->
                    <!--    </small>-->
                    <!--</p>-->
                    <figure class="h-100 mb-3 w-100 overflow-hidden" style="max-height: 400px; border-radius: 15px;">
                        <img src="uploads/<?php echo $_smarty_tpl->tpl_vars['item']->value->banner_photo;?>
" class="h-100 w-100" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value->title;?>
"
                            style="object-fit: cover;">
                    </figure>
                    
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>((string)$_smarty_tpl->tpl_vars['item']->value->description),'kh_txt'=>((string)$_smarty_tpl->tpl_vars['item']->value->description_kh)),$_smarty_tpl ) );?>


                    <p class="mt-5">
                        <?php $_smarty_tpl->_assignInScope('tagwords', smarty_modifier_explode(",",$_smarty_tpl->tpl_vars['item']->value->tags));?>

                        <?php if ($_smarty_tpl->tpl_vars['item']->value->tags != '') {?>
                        <strong>
                            Tags:
                        </strong>
                        <?php }?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tagwords']->value, 'tag');
$_smarty_tpl->tpl_vars['tag']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->do_else = false;
?>
                        <?php if ($_smarty_tpl->tpl_vars['tag']->value != '') {?>
                        <a title="<?php echo $_smarty_tpl->tpl_vars['tag']->value;?>
" class="tags px-2 mx-1"
                            href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/media.php?tag=<?php echo mb_strtolower((string) $_smarty_tpl->tpl_vars['tag']->value, 'UTF-8');?>
&?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
">
                            <i class="fa-solid fa-tags"></i> <?php echo $_smarty_tpl->tpl_vars['tag']->value;?>

                        </a>
                        <?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </p>
                    <hr>
                </div>
                <div class="modal-body mb-4 mb-lg-0">
                    <h5>Share with</h5>
                    <ul class="share_list justify-content-start">
                        <li class="share_item">
                            <button onclick="getData(this)" class="share_link share_link_facebook"
                                data-platform="facebook" data-url="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
/?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" data-title="<?php ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,'...');
$_prefixVariable3=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,'...');
$_prefixVariable4=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>" ".$_prefixVariable3,'kh_txt'=>$_prefixVariable4),$_smarty_tpl ) );?>
">
                                <i class="fa-brands fa-facebook"></i>
                            </button>
                        </li>
                        <li class="share_item">
                            <button onclick="getData(this)" class="share_link share_link_twitter"
                                data-platform="twitter" data-url="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
/?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" data-title="<?php ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,'...');
$_prefixVariable5=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,'...');
$_prefixVariable6=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>" ".$_prefixVariable5,'kh_txt'=>$_prefixVariable6),$_smarty_tpl ) );?>
">
                                <i class="fa-brands fa-x-twitter"></i>
                            </button>
                        </li>
                        <li class="share_item">
                            <button onclick="getData(this)" class="share_link share_link_linkedin"
                                data-platform="linkedin" data-url="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
/?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" data-title="<?php ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,'...');
$_prefixVariable7=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,'...');
$_prefixVariable8=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>" ".$_prefixVariable7,'kh_txt'=>$_prefixVariable8),$_smarty_tpl ) );?>
">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </button>
                        </li>
                        <li class="share_item">
                            <button onclick="getData(this)" class="share_link share_link_mail"
                                data-platform="mail"
                                data-url="<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" data-title="<?php ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,'...');
$_prefixVariable9=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,'...');
$_prefixVariable10=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>" ".$_prefixVariable9,'kh_txt'=>$_prefixVariable10),$_smarty_tpl ) );?>
">
                                <i class="fa-solid fa-envelope"></i>
                            </button>
                        </li>
                        <li class="share_item">
                            <button onclick="getData(this)" class="share_link share_link_whatsapp"
                                data-platform="whatsapp"
                                data-url="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/<?php echo $_smarty_tpl->tpl_vars['item']->value->url;?>
/?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" data-title="<?php ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title,60,'...');
$_prefixVariable11=ob_get_clean();
ob_start();
echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['item']->value->title_kh,60,'...');
$_prefixVariable12=ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>" ".$_prefixVariable11,'kh_txt'=>$_prefixVariable12),$_smarty_tpl ) );?>
">
                                <i class="fa-brands fa-whatsapp"></i>
                            </button>
                        </li>
                    </ul>
                </div>
               <div class="mt-4 mt-lg-5 text-center">
                     <a href="<?php echo $_smarty_tpl->tpl_vars['return_url']->value;?>
?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" 
                       class="return-link btns btns py-2 px-3 text-center rounded d-inline-block" 
                       style="min-width: 150px;">Go Back</a>
               </div>
            </div>
            <div class="col-lg-2 order-3 order-lg-2 mt-4 mt-sm-5 mt-lg-0">
                <div class="row blog_theme blog_news mt-4 mt-md-0 position-sticky" 
                style="top: 80px;">
                   <div class="col-sm-6 col-lg-12">
                                <img style="margin-bottom: 15px;"
                                  src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf"
                                  width="100%" />
                                  
                     </div>
                     <div class="col-sm-6 col-lg-12">
                                <img style="margin-bottom: 15px;"
                                  src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf"
                                  width="100%" />
                                  
                     </div>
                        <div class="col-sm-6 col-lg-12">
                                <img src="https://business-cambodia.com/cms/assets/c08c0704-52c4-43e4-91c4-37c76df6c3bf"
                                  width="100%" />
                        </div>
                </div>
            </div>
            <div class="col-12 order-2 order-lg-3">
                <div class="d-flex pb-2 my-5 justify-content-between 
                align-items-center border-bottom">
                      <h3 class="mb-0">Related</h3>
                       
                </div>
                <div class="row news">
                    <?php ob_start();
echo $_smarty_tpl->tpl_vars['item']->value->alias;
$_prefixVariable13 = ob_get_clean();
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['LISEMediaSolutions'][0], array( array('summarytemplate'=>"theme_summary_relate",'exclude_items'=>$_prefixVariable13,'pagelimit'=>"8",'category'=>'','orderby'=>"item_id|DESC"),$_smarty_tpl ) );?>

                    <div class="col-12 mt-4 text-center">
                         <a href="<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/media.php?lang=<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['get_lang'][0], array( array(),$_smarty_tpl ) );?>
" 
                       class="return-link btns py-2 px-3 text-center rounded" 
                       style="min-width: 130px;">
                               <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"See More",'kh_txt'=>"មើលច្រើនទៀត"),$_smarty_tpl ) );?>

                                <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section><?php }
}
