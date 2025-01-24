{strip}

<div class="ace-ui-toolbar-bottom cf">

  <div class="ace-ui-bottom-left ace-left cf">
    <div class="ace-editor-cursor ace-editor-info-bottom ace-left" id="(ti)_ace-editor-cursor">&nbsp;</div>
    <div class="ace-info-divider">&nbsp;</div>
    <div class="ace-editor-cursor ace-editor-info-bottom ace-left" id="(ti)_ace-editor-linenum">{$mod->Lang('total_lines')}: <span>&nbsp;</span></div>
    <div class="ace-info-divider">&nbsp;</div>
    <div class="ace-editor-token ace-editor-info-bottom ace-left" id="(ti)_ace-editor-token">{$mod->Lang('current_token')}: <span>&nbsp;</span></div>
  </div>

  <div class="ace-ui-bottom-right ace-right cf">

    <ul class="ace-option-menu">
      <li>
        <a aria-hidden="true" data-icon="&#xe010;" id="ace-editor-modes" class="ace-tooltip ace-tooltip-top-left ace-icon ace-option-icon ace-toggle-menu" href="#" data-tip="{$mod->Lang('syntax_mode')} ">
          <span class="visuallyhidden">{$mod->Lang('syntax_mode')}</span>
        </a>
        <ul id="(ti)_modes" class="ace-list cf">
            {foreach $mod->AceGetModes() as $value}
              <li data-ace-mode="{$value@key}"{if isset($mode) && !empty($mode) && $mode == $value@key} class="ace-selected"{/if}>
              <i class="ace-icon-checkmark-circle"></i> {$value}</li>
            {/foreach}
        </ul>
      </li>
    </ul>

  </div>

</div>
{/strip}