{$startform}
<fieldset>
	<legend>{$mod->ModLang('module_options')}</legend>
	<div class="pagewarning">
		<h3>{$mod->ModLang('notice')}</h3>
		<p>{$mod->ModLang('options_notice')}</p>
	</div>	
    <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_friendlyname')}:</p>
      <p class="pageinput">{$input_friendlyname}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_moddescription')}:</p>
      <p class="pageinput">{$input_moddescription}</p>
    </div>      
    <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_adminsection')}:</p>
      <p class="pageinput">{$input_adminsection}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_separate_settings_control')}:</p>
      <p class="pageinput">{$input_separate_settings_control}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_local_instances_list')}:</p>
      <p class="pageinput">{$input_local_mode_instance}</p>
    </div>
</fieldset>

<fieldset>
	<legend>{$mod->ModLang('default_options')}</legend>
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_detailpage')}:</p>
        <p class="pageinput">{$input_detailpage}</p>
    </div> 
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_summarypage')}:</p>
        <p class="pageinput">{$input_summarypage}</p>
    </div> 	
</fieldset>

<fieldset>
    <legend>{$mod->ModLang('items_options')}</legend>           
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_item_title')}:</p>
        <p class="pageinput">{$input_item_title}</p>
    </div>
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_item_singular')}:</p>
        <p class="pageinput">{$input_item_singular}</p>
    </div>
    <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_item_plural')}:</p>
        <p class="pageinput">{$input_item_plural}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_title_display_mode')}:</p>
      <p class="pageinput">{$input_title_display_mode}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_title_auto_gen')}:</p>
      <p class="pageinput">{$input_title_auto_gen}</p>
    </div>
    <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_title_template')}: {cms_help realm='LISE' key='title_template_popup_help' title=$mod->ModLang('title_template_popup_help_title')}</p>
      <p class="pageinput">{$input_title_template}</p>
    </div>
	  <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_create_date')}</p>
      <p class="pageinput">{$input_create_date}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->ModLang('prompt_hide_alias')}:</p>
    <p class="pageinput">{$input_hide_alias}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->ModLang('prompt_alias_template')}: {cms_help realm='LISE' key='alias_template_popup_help' title=$mod->ModLang('alias_template_popup_help_title')}</p>
    <p class="pageinput">{$input_alias_template}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->ModLang('prompt_hide_slug')}:</p>
    <p class="pageinput">{$input_hide_slug}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->ModLang('prompt_hide_time_control')}:</p>
    <p class="pageinput">{$input_hide_time_control}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->ModLang('prompt_item_cols')}:</p>
    <p class="pageinput">{$input_item_cols}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->ModLang('prompt_items_per_page')}:</p>
    <p class="pageinput">{$input_items_per_page}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->ModLang('text_sortorder')}:</p>
    <p class="pageinput">{$input_sortorder}</p>
  </div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->ModLang('prompt_inactive_item_triggers_404')}:</p>
    <p class="pageinput">{$input_inactive_item_triggers_404}</p>
    <div class="information">
      <p>{$mod->ModLang('info_inactive_item_triggers_404')}</p>
    </div>
  </div>
</fieldset>

<fieldset>
	<legend>{$mod->ModLang('url_options')}</legend>
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_url_prefix')}:</p>
        <p class="pageinput">{$input_url_prefix}</p>
    </div> 
  <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_url_template')}: {cms_help realm='LISE' key='slug_template_popup_help' title=$mod->ModLang('slug_template_popup_help_title')}</p>
        <p class="pageinput">{$input_url_template}</p>
    </div> 
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_subcategory')}:</p>
        <p class="pageinput">{$input_subcategory}</p>
    </div>	
	<div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_display_inline')}:</p>
        <p class="pageinput">{$input_display_inline}</p>
    </div>
</fieldset>
<fieldset>
  <legend>{$mod->ModLang('xmodule_options')}</legend>
  <div class="pageoverflow">
    <div class="warning">
      <p>{$mod->ModLang('warning_reindex_search')}</p>
    </div>          
  </div>   
  <div class="pageoverflow">
    <p class="pagetext">{$mod->ModLang('prompt_reindex_search')}:</p>
    <p class="pageinput">{$input_reindex_search}</p>
  </div>  
  <div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_reindex_do_search')}:</p>
      <p class="pageinput">
        <input type="hidden"
               name="{$actionid}_do_reindex"
               value="0" />
        <input type="checkbox"
               name="{$actionid}_do_reindex"
               value="1" />
      </p>
  </div>
  <div class="pageoverflow">
    <div class="warning">
      <p>{$mod->ModLang('warning_reindex_search_now')}</p>
    </div>          
  </div> 
</fieldset>
<fieldset>
	<legend>{$mod->ModLang('misc_options')}</legend>
	<div class="pageoverflow">
      <p class="pagetext">{$mod->ModLang('prompt_auto_upgrade')}:</p>
      <p class="pageinput">{$input_auto_upgrade}</p>
  </div>
</fieldset>
    <div class="pageoverflow">
        <p class="pagetext">&nbsp;</p>
        <p class="pageinput">
			{$submit}
		</p>
    </div>

{$endform}
