<?php
/* Smarty version 4.5.2, created on 2025-01-12 00:36:38
  from 'lisetemplate:instance;LISEMediaSolutions;optiontab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782ac26eed662_38752018',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3438778d23e59a0dbcae168a721692e4580e1e3a' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;optiontab.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6782ac26eed662_38752018 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\admin\\plugins\\function.cms_help.php','function'=>'smarty_function_cms_help',),));
echo $_smarty_tpl->tpl_vars['startform']->value;?>

<fieldset>
	<legend><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('module_options');?>
</legend>
	<div class="pagewarning">
		<h3><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('notice');?>
</h3>
		<p><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('options_notice');?>
</p>
	</div>	
    <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_friendlyname');?>
:</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_friendlyname']->value;?>
</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_moddescription');?>
:</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_moddescription']->value;?>
</p>
    </div>      
    <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_adminsection');?>
:</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_adminsection']->value;?>
</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_separate_settings_control');?>
:</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_separate_settings_control']->value;?>
</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_local_instances_list');?>
:</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_local_mode_instance']->value;?>
</p>
    </div>
</fieldset>

<fieldset>
	<legend><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('default_options');?>
</legend>
	<div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_detailpage');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_detailpage']->value;?>
</p>
    </div> 
	<div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_summarypage');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_summarypage']->value;?>
</p>
    </div> 	
</fieldset>

<fieldset>
    <legend><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('items_options');?>
</legend>           
    <div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_item_title');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_item_title']->value;?>
</p>
    </div>
    <div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_item_singular');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_item_singular']->value;?>
</p>
    </div>
    <div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_item_plural');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_item_plural']->value;?>
</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_title_display_mode');?>
:</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_title_display_mode']->value;?>
</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_title_auto_gen');?>
:</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_title_auto_gen']->value;?>
</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_title_template');?>
: <?php echo smarty_function_cms_help(array('realm'=>'LISE','key'=>'title_template_popup_help','title'=>$_smarty_tpl->tpl_vars['mod']->value->ModLang('title_template_popup_help_title')),$_smarty_tpl);?>
</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_title_template']->value;?>
</p>
    </div>
	  <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_create_date');?>
</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_create_date']->value;?>
</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_hide_alias');?>
:</p>
    <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_hide_alias']->value;?>
</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_alias_template');?>
: <?php echo smarty_function_cms_help(array('realm'=>'LISE','key'=>'alias_template_popup_help','title'=>$_smarty_tpl->tpl_vars['mod']->value->ModLang('alias_template_popup_help_title')),$_smarty_tpl);?>
</p>
    <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_alias_template']->value;?>
</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_hide_slug');?>
:</p>
    <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_hide_slug']->value;?>
</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_hide_time_control');?>
:</p>
    <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_hide_time_control']->value;?>
</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_item_cols');?>
:</p>
    <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_item_cols']->value;?>
</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_items_per_page');?>
:</p>
    <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_items_per_page']->value;?>
</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('text_sortorder');?>
:</p>
    <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_sortorder']->value;?>
</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_inactive_item_triggers_404');?>
:</p>
    <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_inactive_item_triggers_404']->value;?>
</p>
    <div class="information">
      <p><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('info_inactive_item_triggers_404');?>
</p>
    </div>
  </div>
</fieldset>

<fieldset>
	<legend><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('url_options');?>
</legend>
	<div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_url_prefix');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_url_prefix']->value;?>
</p>
    </div> 
  <div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_url_template');?>
: <?php echo smarty_function_cms_help(array('realm'=>'LISE','key'=>'slug_template_popup_help','title'=>$_smarty_tpl->tpl_vars['mod']->value->ModLang('slug_template_popup_help_title')),$_smarty_tpl);?>
</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_url_template']->value;?>
</p>
    </div> 
	<div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_subcategory');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_subcategory']->value;?>
</p>
    </div>	
	<div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_display_inline');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_display_inline']->value;?>
</p>
    </div>
</fieldset>
<fieldset>
  <legend><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('xmodule_options');?>
</legend>
  <div class="pageoverflow">
    <div class="warning">
      <p><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('warning_reindex_search');?>
</p>
    </div>          
  </div>   
  <div class="pageoverflow">
    <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_reindex_search');?>
:</p>
    <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_reindex_search']->value;?>
</p>
  </div>  
  <div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_reindex_do_search');?>
:</p>
      <p class="pageinput">
        <input type="hidden"
               name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
_do_reindex"
               value="0" />
        <input type="checkbox"
               name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
_do_reindex"
               value="1" />
      </p>
  </div>
  <div class="pageoverflow">
    <div class="warning">
      <p><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('warning_reindex_search_now');?>
</p>
    </div>          
  </div> 
</fieldset>
<fieldset>
	<legend><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('misc_options');?>
</legend>
	<div class="pageoverflow">
      <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('prompt_auto_upgrade');?>
:</p>
      <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_auto_upgrade']->value;?>
</p>
  </div>
</fieldset>
    <div class="pageoverflow">
        <p class="pagetext">&nbsp;</p>
        <p class="pageinput">
			<?php echo $_smarty_tpl->tpl_vars['submit']->value;?>

		</p>
    </div>

<?php echo $_smarty_tpl->tpl_vars['endform']->value;?>

<?php }
}
