<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:04
  from 'cms_template:Menu_Manager' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a807fc7d9_17344984',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3dd1690d6cd2aa9d0a7908a32d6b3b24f0d96cac' => 
    array (
      0 => 'cms_template:Menu_Manager',
      1 => '1735979342',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
    'cms_template:Model_Form_Search' => 1,
  ),
),false)) {
function content_67828a807fc7d9_17344984 (Smarty_Internal_Template $_smarty_tpl) {
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
                <?php echo Navigator::function_plugin(array('template'=>"Menu1",'number_of_levels'=>"3"),$_smarty_tpl);?>

                
            </div>
            
          </div>
        </nav>
        <?php $_smarty_tpl->_subTemplateRender('cms_template:Model_Form_Search', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</header><?php }
}
