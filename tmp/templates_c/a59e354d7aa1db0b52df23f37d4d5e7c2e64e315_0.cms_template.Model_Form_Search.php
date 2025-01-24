<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:05
  from 'cms_template:Model_Form_Search' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828a811aa6d5_22362337',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a59e354d7aa1db0b52df23f37d4d5e7c2e64e315' => 
    array (
      0 => 'cms_template:Model_Form_Search',
      1 => '1735979266',
      2 => 'cms_template',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828a811aa6d5_22362337 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="modal fade " id="modal_search" tabindex="-1" aria-hidden="true" style="height: 100vh;">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-fullscreen-sm-down">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title fs-5"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['translate'][0], array( array('en_txt'=>"Search",'kh_txt'=>"ស្វែងរក"),$_smarty_tpl ) );?>
</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div>
      <?php echo Search::function_plugin(array('formtemplate'=>"Form_Search",'resulttemplate'=>"Form_Search_Results"),$_smarty_tpl);?>

    </div>
    <div class="modal-body py-4">
      <div id="search-results" class="search-results"></div>
    </div>
  </div>
</div>
</div><?php }
}
