{strip}
{form_start action='save_settings_backend'}

<fieldset>

<p class="information">{$mod->Lang('content_description_backend')}</p>

<div class="c_full">

    <div class="grid_6">

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('width_title')} </p>
            <p class="pageinput">
                <input type="text" id="{$actionid}width" name="{$actionid}width" size="5" maxlength="255" value="{$mod->AceGetPreference('width', '100')}" />
                <select name="{$actionid}width_units" id="{$actionid}width_units">
                    {html_options options=$unitsinput selected=$mod->AceGetPreference('width_units', '%')}
                </select>
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('height_title')} </p>
            <p class="pageinput">
                <input type="text" id="{$actionid}height" name="{$actionid}height" size="5" maxlength="255" value="{$mod->AceGetPreference('height', '600')}" />
                <select name="{$actionid}height_units" id="{$actionid}height_units">
                    {html_options options=$unitsinput selected=$mod->AceGetPreference('height_units', 'px')}
                </select>
                <br />
                <input type="checkbox" id="{$actionid}auto_height" name="{$actionid}auto_height" value="{$mod->AceGetPreference('auto_height', 0)}"{if $mod->AceGetPreference('auto_height') == 1} checked="checked"{/if} /> {$mod->Lang('auto_height')}
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('syntax_mode')} </p>
            <p class="pageinput">
                <select name='{$actionid}mode' id='{$actionid}mode' onchange="this.form.submit()">
                    {html_options options=$mod->AceGetModes() selected=$mod->AceGetPreference('mode', 'html')}
                </select>
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('themes')} </p>
            <p class="pageinput">
                <select name="{$actionid}theme" id="{$actionid}theme" onchange="this.form.submit()">
                    {html_options options=$mod->AceGetThemes() selected=$mod->AceGetPreference('theme', 'twilight')}
                </select>
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('font_size')} </p>
            <p class="pageinput">
                <select name="{$actionid}fontsize" id="{$actionid}fontsize">
                    {html_options options=$fontsizeinput selected=$mod->AceGetPreference('fontsize', '13px')}
                </select>
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('full_line')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}full_line" name="{$actionid}full_line" value="{$mod->AceGetPreference('full_line', 1)}" {if $mod->AceGetPreference('full_line') == '' || $mod->AceGetPreference('full_line') == 1}checked{/if} />
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('highlight_active')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}highlight_active" name="{$actionid}highlight_active" value="{$mod->AceGetPreference('highlight_active', 1)}"{if $mod->AceGetPreference('highlight_active') == '' || $mod->AceGetPreference('highlight_active') == 1} checked="checked"{/if} />
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('show_invisibles')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}show_invisibles" name="{$actionid}show_invisibles" value="{$mod->AceGetPreference('show_invisibles', 0)}"{if $mod->AceGetPreference('show_invisibles') == 1} checked="checked"{/if} />
            </p>
        </div>

    </div>

    <div class="grid_6">

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('persistent_hscroll')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}persistent_hscroll" name="{$actionid}persistent_hscroll" value="{$mod->AceGetPreference('persistent_hscroll', 0)}"{if $mod->AceGetPreference('persistent_hscroll') == 1} checked="checked"{/if} />
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('soft_wrap')} </p>
            <p class="pageinput">
                <select name="{$actionid}soft_wrap" id="{$actionid}soft_wrap">
                    {html_options options=$soft_wrapinput selected=$mod->AceGetPreference('soft_wrap', '80')}
                </select>
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('show_gutter')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}show_gutter" name="{$actionid}show_gutter" value="{$mod->AceGetPreference('show_gutter', 1)}"{if $mod->AceGetPreference('show_gutter') == '' || $mod->AceGetPreference('show_gutter') == 1} checked="checked"{/if} />
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('wrap_line')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}wrap_line" name="{$actionid}wrap_line" value="{$mod->AceGetPreference('wrap_line', 1)}"{if $mod->AceGetPreference('wrap_line') == '' || $mod->AceGetPreference('wrap_line') == 1} checked="checked"{/if} />
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('print_margin')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}print_margin" name="{$actionid}print_margin" value="{$mod->AceGetPreference('print_margin', 0)}"{if $mod->AceGetPreference('print_margin') == 1} checked="checked"{/if} />
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('soft_tab')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}soft_tab" name="{$actionid}soft_tab" value="{$mod->AceGetPreference('soft_tab', 1)}"{if $mod->AceGetPreference('soft_tab') == '' || $mod->AceGetPreference('soft_tab') == 1} checked="checked"{/if} />
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('tab_size')} </p>
            <p class="pageinput">
                <select name="{$actionid}tab_size" id="{$actionid}tab_size">
                    {html_options options=$tab_sizeinput selected=$mod->AceGetPreference('tab_size', '4')}
                </select>
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('highlight_selected')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}highlight_selected" name="{$actionid}highlight_selected" value="{$mod->AceGetPreference('highlight_selected', 1)}"{if $mod->AceGetPreference('highlight_selected') == '' || $mod->AceGetPreference('highlight_selected') == 1} checked="checked"{/if} />
            </p>
        </div>

        <div class="pageoverflow">
            <p class="pagetext"> {$mod->Lang('enable_behaviors')} </p>
            <p class="pageinput">
                <input type="checkbox" id="{$actionid}enable_behaviors" name="{$actionid}enable_behaviors" value="{$mod->AceGetPreference('enable_behaviors', 1)}"{if $mod->AceGetPreference('enable_behaviors') == '' || $mod->AceGetPreference('enable_behaviors') == 1} checked="checked"{/if} />
            </p>
        </div>

    </div>

</div>

<div class="pageoverflow">
    <p class="pagetext"> &nbsp; </p>
    <p class="pageinput"> {$submit} </p>
</div>

</fieldset>


<fieldset>

    <legend>
        {$mod->Lang('testareatext')}
    </legend>

    <div class="pageoverflow">
        <div class="pageinput">
             <textarea id="as_test" class="AceSyntax" data-cms-lang="smarty">{$testareacontent}</textarea>
        </div>
    </div>
    
</fieldset>
{form_end}
{/strip}