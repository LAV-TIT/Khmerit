{strip}
<div class="ace-wrapper" id="{$editorid}_screen">
    <div class="ace-ui-container">
        <div class="{$textareaid}_toolbar">
            <div class="ace-ui-toolbar cf">
                <div class="ace-toggle-editor ace-left">
                    <input type="radio" id="{$textareaid}_on" class="ace-toggle ace-radio ace-toggle-left" name="radio_{$ace_id}" checked="checked" />
                    <label class="ace-tooltip" data-tip="{$mod->Lang('highlighter_on')}" for="{$textareaid}_on">{$mod->Lang('on')}</label>
                    <input type="radio" id="{$textareaid}_off" class="ace-toggle ace-radio ace-toggle-right" name="radio_{$ace_id}" />
                    <label class="ace-tooltip" data-tip="{$mod->Lang('highlighter_off')}" for="{$textareaid}_off">{$mod->Lang('off')}</label>
                </div>
                <div class="ace-info-divider">&nbsp;</div>
                <div class="ace-find-line ace-text-input ace-left">
                    <label class="visuallyhidden">{$mod->Lang('go_line')}:</label>
                    <input type="text" id="{$textareaid}_goline" class="ace-input" name="ace_goline" value="" pattern="\d+" placeholder="{$mod->Lang('go_line')}:" onfocus="this.placeholder = ''" onblur="this.placeholder = '{$mod->Lang('go_line')}:'" />
                    <i aria-hidden="true" data-icon="&#xe00b;" class="ace-icon ace-line-search-icon"><span class="visuallyhidden">{$mod->Lang('go_line')}</span></i>
                </div>
                <div class="ace-info-divider">&nbsp;</div>
                <div class="ace-search-string ace-text-input ace-left cf">
                    <label class="visuallyhidden">{$mod->Lang('search_document')}:</label>
                    <input type="text" id="{$textareaid}_search" class="ace-input" name="ace_search" value="" placeholder="{$mod->Lang('search_document')}:" onfocus="this.placeholder = ''" onblur="this.placeholder = '{$mod->Lang('search_document')}:'" />
                    <div class="ace-info-divider">&nbsp;</div>
                    <label class="visuallyhidden">{$mod->Lang('replace_with')}:</label>
                    <input type="text" id="{$textareaid}_replace" class="ace-input ace-hidden" name="ace_replace" value="" placeholder="{$mod->Lang('replace_with')}:" onfocus="this.placeholder = ''" onblur="this.placeholder = '{$mod->Lang('replace_with')}:'" />
                    <ul class="ace-option-menu">
                        <li>
                            <a href="#" aria-hidden="true" data-icon="&#xe00c;" class="ace-icon ace-option-icon ace-tooltip ace-toggle-menu" data-tip="{$mod->Lang('search_options')}"><span class="visuallyhidden">{$mod->Lang('search_options')}</span></a>
                            <ul id="{$textareaid}_options" class="ace-list">
                                <li data-ace-search-option="find" class="ace-selected"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('search_document')}</li>
                                <li data-ace-search-option="replace"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('replace_option')}</li>
                                <li data-ace-search-option="replaceAll"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('replaceall_option')}</li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" aria-hidden="true" data-icon="&#xe00f;" class="ace-icon ace-option-icon ace-tooltip ace-toggle-menu" data-tip="{$mod->Lang('search_settings')}"><span class="visuallyhidden">{$mod->Lang('search_settings')}</span></a>
                            <ul id="{$textareaid}_search_settings" class="ace-list">
                                <li data-ace-search-option="reset" class="ace-selected"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('search_any')}</li>
                                <li data-ace-search-option="caseSensitive"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('case_sensitive')}</li>
                                <li data-ace-search-option="wholeWord"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('whole_word')}</li>
                                <li data-ace-search-option="regExp"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('regexp')}</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="ace-info-divider">&nbsp;</div>
                <div class="ace-toggle-editor ace-left">
                    <label class="visuallyhidden">{$mod->Lang('keybindings')}:</label>
                    <input type="radio" class="ace-toggle ace-radio ace-toggle-left" id="{$textareaid}_ace" name="radio2_{$ace_id}" checked="checked" value="null" />
                    <label class="ace-tooltip" data-tip="{$mod->Lang('keybindings')}" for="{$textareaid}_ace">{$mod->Lang('ace')}</label>
                    <input type="radio" class="ace-toggle ace-radio ace-toggle-middle" id="{$textareaid}_vim" name="radio2_{$ace_id}" value="vim" />
                    <label class="ace-tooltip" data-tip="{$mod->Lang('keybindings')}" for="{$textareaid}_vim">{$mod->Lang('vim')}</label>
                    <input type="radio" class="ace-toggle ace-radio ace-toggle-right" id="{$textareaid}_emacs" name="radio2_{$ace_id}" value="emacs" />
                    <label class="ace-tooltip" data-tip="{$mod->Lang('keybindings')}" for="{$textareaid}_emacs">{$mod->Lang('emacs')}</label>
                </div>
                <div class="ace-info-divider">&nbsp;</div>
                <a href="#" id="{$editorid}_ace-fullscreen" class="ace-icon-expand ace-icon ace-fullscreen-button ace-right" title="{$mod->Lang('full_screen')}"><span class="visuallyhidden">{$mod->Lang('full_screen')}</span></a>
            </div>
        </div>
        <div class="ace-container">
{/strip}
            <textarea 
                id="{$textareaid}" 
                data-ace-editor-id="{$editorid}"
                data-ace-width="{$mod->AceGetPreference('width', '100')}"
                data-ace-width-units="{$mod->AceGetPreference('width_units', '%')}"
                data-ace-height="{$mod->AceGetPreference('height', '600')}"
                data-ace-auto-height="{$mod->AceGetPreference('auto_height', 0)}"
                data-ace-height-units="{$mod->AceGetPreference('height_units', 'px')}"
                data-ace-selected-theme="{$mod->AceGetPreference('theme', 'twilight')}"
                data-ace-selected-mode="{if isset($mode) && !empty($mode)}{$mode}{else}{$mod->AceGetPreference('mode', 'html')}{/if}"
                data-ace-font-size="{$mod->AceGetPreference('fontsize', '13px')}"
                data-ace-tab-size="{$mod->AceGetPreference('tab_size', '4')}"
                data-ace-soft-wrap="{$mod->AceGetPreference('soft_wrap', '80')}"
                data-ace-selection-style="{$mod->AceGetPreference('full_line', 1)}"
                data-ace-highlight-line="{$mod->AceGetPreference('highlight_active', 1)}"
                data-ace-highlight-word="{$mod->AceGetPreference('highlight_selected', 1)}"
                data-ace-show-invisibles="{$mod->AceGetPreference('show_invisibles', 0)}"
                data-ace-hscroll-bar="{$mod->AceGetPreference('persistent_hscroll', 0)}"
                data-ace-show-gutter="{$mod->AceGetPreference('show_gutter', 1)}"
                data-ace-wrap-line="{$mod->AceGetPreference('wrap_line', 1)}"
                data-ace-soft-tab="{$mod->AceGetPreference('soft_tab', 1)}"
                data-ace-behaviours-enabled="{$mod->AceGetPreference('enable_behaviors', 1)}"
                data-ace-print-margin="{$mod->AceGetPreference('print_margin', 0)}"
                class="ace_editor_textarea" 
                name="{$textareaname}">{$syntax_content}</textarea>
{strip}
        </div>
        <div class="ace-ui-toolbar-bottom cf">
            <div class="ace-ui-bottom-left ace-left cf">
                <div class="ace-editor-cursor ace-editor-info-bottom ace-left" id="{$textareaid}_ace-editor-cursor">&nbsp;</div>
                <div class="ace-info-divider">&nbsp;</div>
                <div class="ace-editor-cursor ace-editor-info-bottom ace-left" id="{$textareaid}_ace-editor-linenum">{$mod->Lang('total_lines')}: <span>&nbsp;</span></div>
                <div class="ace-info-divider">&nbsp;</div>
                <div class="ace-editor-token ace-editor-info-bottom ace-left" id="{$textareaid}_ace-editor-token">{$mod->Lang('current_token')}: <span>&nbsp;</span></div>
            </div>
            <div class="ace-ui-bottom-right ace-right cf">
                <ul class="ace-option-menu">
                    <li>
                        <a aria-hidden="true" data-icon="&#xe010;" id="ace-editor-modes" class="ace-tooltip ace-tooltip-top-left ace-icon ace-option-icon ace-toggle-menu" href="#" data-tip="{$mod->Lang('syntax_mode')} "><span class="visuallyhidden">{$mod->Lang('syntax_mode')}</span></a>
                        <ul id="{$textareaid}_modes" class="ace-list cf">
                            {foreach $mod->AceGetModes() as $value}
                            <li data-ace-mode="{$value@key}"{if isset($mode) && !empty($mode) && $mode == $value@key} class="ace-selected"{/if}><i class="ace-icon-checkmark-circle"></i> {$value}</li>
                            {/foreach}
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{/strip}