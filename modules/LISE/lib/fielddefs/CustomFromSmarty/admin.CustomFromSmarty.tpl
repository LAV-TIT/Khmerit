{$opts = $fielddef->GetOptions()}
<fieldset>
  <legend>{$fielddef->ModLang('options')}</legend>
  <div class="pageoverflow">
      <p class="pagetext">{$fielddef->ModLang('fielddef_type')}:</p>
      <p class="pageinput">
        {html_options name="`$actionid`custom_input[type]" options=$opts.types selected=$fielddef->GetOptionValue('type', 'Dropdown')}
      </p>
      <p class="pagetext"><div class="information">{$fielddef->ModLang('fielddef_type_help')}</div></p>
  </div>
  <hr>
  <div class="pageoverflow">
      <p class="pagetext">{$fielddef->ModLang('fielddef_source_template')}:</p>
      <p class="pageinput">
        <textarea
                rows="3"
                name="{$actionid}custom_input[source_template]">{$fielddef->GetOptionValue('source_template', '')}</textarea>
      </p>
      <p class="pagetext"><div class="information">{$fielddef->ModLang('fielddef_source_template_help')}</div></p>
  </div>
  <hr>   
  <div class="pageoverflow">
      <p class="pagetext">{$fielddef->ModLang('fielddef_validation_udt')}:</p>
      <p class="pageinput">
		    {html_options name="`$actionid`custom_input[validation_udt]" options=$opts.udts selected=$fielddef->GetOptionValue('validation_udt', -1)}
      </p>
      <p class="pagetext"><div class="information">{$fielddef->ModLang('fielddef_validation_UDT_help')}</div></p>
  </div>    
</fieldset>