{$opts = $fielddef->GetOptions()}
<fieldset>
  <legend>{$fielddef->ModLang('options')}</legend>

  <div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('fielddef_ph_title')}:</p>
    <p class="pageinput">
      <input type="text" name="{$actionid}custom_input[title]" value="{$opts.title}" />
    </p>
    <p class="pagetext"><div class="information">{$fielddef->ModLang('fielddef_ph_title_help')}</div></p>
  </div>

  <hr>

  <div class="pageoverflow">
    <p class="pagetext">{$fielddef->ModLang('fielddef_ph_msg')}:</p>
    <p class="pageinput">
      <textarea rows="10" name="{$actionid}custom_input[msg]">{$opts.msg}</textarea>
    </p>
    <p class="pagetext"><div class="information">{$fielddef->ModLang('fielddef_ph_msg_help')}</div></p>
  </div>

</fieldset>