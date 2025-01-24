<div class="pageoverflow">
  <p class="pageinput">
    {$show_opts = 0}
    {if $previous_id > 0 && $itemObject->item_id|default:-1 > 0}{$show_opts = 1}
      <a
        title="{lang('previous')}"
        class="ui-button ui-widget ui-state-default ui-corner-all lise-previous-next edit-previous"
        href="{cms_action_url action=admin_edititem item_id=$previous_id}">
        <span class="ui-icon ui-button-icon-primary ui-icon-triangle-1-w"
              style="position:relative;top:50%;margin-top:-8px"
        ></span>
      </a>
    {/if}
    <input name="{$actionid}cancel" class="lise_cancel" value="{lang('cancel')}" type="submit" />
    {if $itemObject->item_id|default:-1 > 0}
      <input name="{$actionid}apply" class="lise_apply" value="{lang('apply')}" type="submit" />
    {/if}
    <input name="{$actionid}save_create" class="lise_save_create" value="{$mod->ModLang('save_create')}" type="submit" />
    <input name="{$actionid}submit" class="lise_submit" value="{lang('submit')}" type="submit" />
  {if $next_id > 0 && $itemObject->item_id|default:-1 > 0}{$show_opts = 1}

     <a
      title="{lang('next')}"
      class="ui-button ui-widget ui-state-default ui-corner-all lise-previous-next edit-next"
      href="{cms_action_url action=admin_edititem item_id=$next_id}">
      <span class="ui-icon ui-icon-triangle-1-e"
            style="position:relative;top:50%;margin-top:-8px"
      ></span>
    </a>

    {/if}

    {if $show_opts}
      <a
        title="{lang('options')}"
        class="ui-button ui-widget ui-state-default ui-corner-all lise-editor-options">
      <span class="ui-icon ui-icon-gear"
            style="position:relative;top:50%;margin-top:-8px"
      ></span>
    </a>
    {/if}
  </p>
</div>