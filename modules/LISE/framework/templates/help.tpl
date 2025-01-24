{strip}
  <link rel="stylesheet" href="{$root_url}/modules/{$parent_name}/lib/css/liseHelp.css" type="text/css" />
  <script src="{$root_url}/modules/{$parent_name}/lib/js/js.cookie.js"></script>
	<script>
			jQuery(document).ready(function(){
			var active_tab = Cookies.get('{$parent_name}_active');
			$("#donating").click(function(event)
			{
				event.preventDefault();
				_set_active_tab('contribute');
			});

			if(typeof active_tab === "undefined")
			{
				_set_active_tab('general');
			}
			else
			{
				_set_active_tab(active_tab);
			}

			$('#page_tabs > div')
							.each(function()
							{
								$(this).click(function()
								{
									Cookies.set('{$parent_name}_active', this.id);
								});
							});
		});


		function _set_active_tab(tab_name)
		{
			$('#page_tabs > div')
							.each(function()
							{
								$(this).removeClass('active');
							});

			$('#page_content > div')
							.each(function()
							{
								$(this).hide();
							});

			$('#' + tab_name).addClass('active');
			$('#' + tab_name + '_c').show();
			Cookies.set('{$parent_name}_active', tab_name);
		}

		function copyToClipboard(element)
		{
			var $temp = $("<input>");
			$("body").append($temp);
			$temp.val($(element).text()).select();
			document.execCommand("copy");
			$temp.remove();
		}
	</script>

  <div class="clear"></div>
  <div id="page_tabs">
	<div id="general">
		{$mod->ModLang('general')}
	</div>
	<div id="usage">
		{$mod->ModLang('usage')}
	</div>
	<div id="params">
		{$mod->ModLang('params')}
	</div>
	<div id="permissions">
		{$mod->ModLang('permissions')}
	</div>
	<div id="field">
		{$mod->ModLang('fielddefs')}
	</div>
	<div id="categories">
		{$mod->ModLang('categories')}
	</div>
	<div id="templates">
		{$mod->ModLang('templates')}
	</div>
	<div id="contribute">
		{$mod->ModLang('contribute')}
	</div>
	<div id="about">
		{$mod->ModLang('about')}
	</div>
</div>
  <div class="clearb"></div>
  <div id="page_content">
	<div id="general_c">
		<img src="data:image/png;base64,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" alt="LISE Logo" />
    {$mod->ModLang('help_general')}
	</div>	
	<div id="usage_c">		
		{$usage_text}
    <div style="float:left;">
			{$mod->ModLang('help_usage_options')}
		</div>
		<br style="clear:both;" />
		<div style="float:left; display: inline;">
			{$mod->ModLang('help_usage_fielddefs')}
		</div>
		<br style="clear:both;" />
		<div style="float:left;">
			{$mod->ModLang('help_usage_categories')}
		</div>
		<br style="clear:both;" />
		<div style="float:left;">
			{$mod->ModLang('help_usage_items')}
		</div>
		<br style="clear:both;" />
	</div>
	<div id="params_c">
		{include file='module_file_tpl:LISE;help_params_tab.tpl'}
	</div>
	<div id="permissions_c">
		{$permissions_text}
	</div>
	<div id="field_c">
		{*$mod->ModLang('help_fielddefs')*}
    {include file='module_file_tpl:LISE;help_fielddefs_tab.tpl'}
	</div>
	<div id="categories_c">
    {$categories_text}
    {*$mod->ModLang('help_categories')*}
	</div>
	<div id="templates_c">
		{$templates_text}
    <pre class="code">
<code>
{literal}
  {foreach from=$items item=item}
  {$item->fielddefs.position.value|cms_escape}&lt;br /&gt;
  {/foreach}
{/literal}

  {literal}
    {foreach from=$items item=item}
    {$item->position|cms_escape}&lt;br /&gt;
    {/foreach}
  {/literal}
</code>
</pre>
	</div>
	<div id="contribute_c">
		{include file='module_file_tpl:LISE;help_contribute_tab.tpl'}
	</div>
	<div id="about_c">
		{include file='module_file_tpl:LISE;help_about_tab.tpl'}
	</div>
	<div class="clearb"></div>	
</div>
{/strip}