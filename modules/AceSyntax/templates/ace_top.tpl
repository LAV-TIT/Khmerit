{strip}

<div class="(ti)_toolbar">
      <div class="ace-ui-toolbar cf">

        <div class="ace-toggle-editor ace-left">
          <input type="radio"
                 id="(ti)_on"
                 class="ace-toggle ace-radio ace-toggle-left"
                 name="radio_(#)"
                 checked="checked" />
          <label class="ace-tooltip"
                 data-tip="{$mod->Lang('highlighter_on')}"
                 for="(ti)_on">{$mod->Lang('on')}</label>
          <input type="radio"
                 id="(ti)_off"
                 class="ace-toggle ace-radio ace-toggle-right"
                 name="radio_(#)" />
          <label class="ace-tooltip"
                 data-tip="{$mod->Lang('highlighter_off')}"
                 for="(ti)_off">{$mod->Lang('off')}</label>
        </div>

        <div class="ace-info-divider">&nbsp;</div>

        <div class="ace-find-line ace-text-input ace-left">
          <label class="visuallyhidden">{$mod->Lang('go_line')}:</label>
          <input type="text"
                 id="(ti)_goline"
                 class="ace-input"
                 name="ace_goline"
                 value=""
                 pattern="\d+"
                 placeholder="{$mod->Lang('go_line')}:"
                 onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'{$mod->Lang('go_line')}:\'" />
          <i aria-hidden="true"
             data-icon="&#xe00b;"
             class="ace-icon ace-line-search-icon">
                <span class="visuallyhidden">{$mod->Lang('go_line')}</span>
          </i>
        </div>

        <div class="ace-info-divider">&nbsp;</div>

        <div class="ace-search-string ace-text-input ace-left cf">

          <label class="visuallyhidden">{$mod->Lang('search_document')}:</label>
          <input type="text"
                 id="(ti)_search"
                 class="ace-input"
                 name="ace_search"
                 value=""
                 placeholder="{$mod->Lang('search_document')}:"
                 onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'{$mod->Lang('search_document')}:\'" />

          <div class="ace-info-divider">&nbsp;</div>

          <label class="visuallyhidden">{$mod->Lang('replace_with')}:</label>
          <input type="text"
                 id="(ti)_replace"
                 class="ace-input ace-hidden"
                 name="ace_replace"
                 value=""
                 placeholder="{$mod->Lang('replace_with')}:"
                 onfocus="this.placeholder = \'\'" onblur="this.placeholder = \'{$mod->Lang('replace_with')}:\'" />

          <ul class="ace-option-menu">
            <li>
              <a href="#"
                 aria-hidden="true"
                 data-icon="&#xe00c;"
                 class="ace-icon ace-option-icon ace-tooltip ace-toggle-menu"
                 data-tip="{$mod->Lang('search_options')}">
                  <span class="visuallyhidden">{$mod->Lang('search_options')}</span>
              </a>
              <ul id="(ti)_options"
                  class="ace-list">
                <li data-ace-search-option="find"
                    class="ace-selected"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('search_document')}</li>
                <li data-ace-search-option="replace"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('replace_option')}</li>
                <li data-ace-search-option="replaceAll"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('replaceall_option')}</li>
              </ul>
            </li>
            <li>
              <a href="#"
                 aria-hidden="true"
                 data-icon="&#xe002;"
                 class="ace-icon ace-option-icon ace-tooltip ace-toggle-menu"
                 data-tip="{$mod->Lang('search_settings')}"><span class="visuallyhidden">{$mod->Lang('search_settings')}</span></a>
              <ul id="(ti)_search_settings"
                  class="ace-list">
                  <li data-ace-search-option="reset"
                      class="ace-selected"><i class="ace-icon-checkmark-circle"></i> {$mod->Lang('search_any')}</li>
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
          <input type="radio"
                 class="ace-toggle ace-radio ace-toggle-left"
                 id="(ti)_ace"
                 name="radio2_(#)"
                 checked="checked"
                 value="null" />
          <label class="ace-tooltip"
                 data-tip="{$mod->Lang('keybindings')}"
                 for="(ti)_ace">{$mod->Lang('ace')}</label>
          <input type="radio"
                 class="ace-toggle ace-radio ace-toggle-middle"
                 id="(ti)_vim"
                 name="radio2_(#)"
                 value="vim" />
          <label class="ace-tooltip"
                 data-tip="{$mod->Lang('keybindings')}"
                 for="(ti)_vim">{$mod->Lang('vim')}</label>
          <input type="radio"
                 class="ace-toggle ace-radio ace-toggle-right"
                 id="(ti)_emacs"
                 name="radio2_(#)"
                 value="emacs" />
          <label class="ace-tooltip"
                 data-tip="{$mod->Lang('keybindings')}"
                 for="(ti)_emacs">{$mod->Lang('emacs')}</label>
        </div>

        <div class="ace-info-divider">&nbsp;</div>

        <a href="#"
           id="(ei)_ace-fullscreen"
           class="ace-icon-expand ace-icon ace-fullscreen-button ace-right"
           title="{$mod->Lang('full_screen')}">
          <span class="visuallyhidden">{$mod->Lang('full_screen')}</span>
        </a>

      </div>

    </div>
{/strip}