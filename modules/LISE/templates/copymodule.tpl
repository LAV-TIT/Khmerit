<h3>{$mod->Lang('copy_title')}</h3>
{$startform}
  <fieldset>
    <legend>{$mod->ModLang('module_main_options')}</legend>
      <div class="pageoverflow">
          <p class="pagetext">* {$mod->ModLang('module_name')}:</p>
          <p class="pageinput">{$input_module_name}</p>
      </div>

    {if $autoinstall}
      <div class="pageoverflow">
        <p class="pagetext">* {$mod->ModLang('instance_friendlyname')}:</p>
        <p class="pageinput">{$input_module_friendlyname}</p>
      </div>
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_moddescription')}:</p>
        <p class="pageinput">{$input_moddescription}</p>
      </div>

    {else}
        <div class="pageoverflow">
          <div class="pagewarning">
            <h3>{$mod->ModLang('notice')}</h3>
            <p>{$mod->ModLang('missing_options_notice')}</p>
          </div>
        </div>
    {/if}
  </fieldset>

  {if $autoinstall}
    <fieldset>
      <legend>{$mod->ModLang('items_options')}</legend>
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_hide_alias')}:</p>
        <p class="pageinput">{$input_hide_alias}</p>
      </div>
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_hide_slug')}:</p>
        <p class="pageinput">{$input_hide_slug}</p>
      </div>
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_hide_time_control')}:</p>
        <p class="pageinput">{$input_hide_time_control}</p>
      </div>
    </fieldset>

    <fieldset>
      <legend>{$mod->ModLang('module_advanced_options')}</legend>
      <div class="pageoverflow">
        <div class="information">
          <p>{$mod->ModLang('admin_section_info')}</p>
        </div>
      </div>
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_adminsection')}:</p>
        <p class="pageinput">{$input_adminsection}</p>
      </div>
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_separate_settings_control')}:</p>
        <p class="pageinput">{$input_separate_settings_control}</p>
      </div>
      <hr>
      <div class="pageoverflow">
        <div class="pagewarning">
          <h3>{$mod->ModLang('notice')}</h3>
          <p>{$mod->ModLang('instance_mode_notice')}</p>
        </div>
      </div>
      <div class="pageoverflow">
        <div class="information">
          <p>{$mod->ModLang('instance_mode_info')}</p>
        </div>
      </div>
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_instance_mode')}:</p>
        <p class="pageinput">{$input_mode_list}</p>
      </div>

      <hr>

      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('prompt_auto_upgrade')}:</p>
        <p class="pageinput">{$input_auto_upgrade}</p>
      </div>
    </fieldset>
  {/if}

  <div class="pageoverflow">
      <p class="pagetext">&nbsp;</p>
      <p class="pageinput">{$submit}{$cancel}</p>
  </div>
{$endform}

