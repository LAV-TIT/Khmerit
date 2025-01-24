{strip}
{form_start action='save_settings_frontend'}

<fieldset>

    <p class="information">{$mod->Lang('content_description_frontend')}</p>

    <div class="pageoverflow">
        <p class="pagetext"> {$mod->Lang('frontend_width_title')} </p>
        <p class="pageinput">
            <input type="text" id="{$actionid}frontend_width" name="{$actionid}frontend_width" size="5" maxlength="255" value="{$mod->GetPreference('frontend_width', '400')}" />
            <select name="{$actionid}frontend_width_units" id="{$actionid}frontend_width_units">
                {html_options options=$unitsinput selected=$mod->GetPreference('frontend_width_units')}
            </select>
        </p>
    </div>

    <div class="pageoverflow">
        <p class="pagetext"> {$mod->Lang('frontend_height_title')} </p>
        <p class="pageinput">
            <input type="text" id="{$actionid}frontend_height" name="{$actionid}frontend_height" size="5" maxlength="255" value="{$mod->GetPreference('frontend_height', '500')}" />
            <select name="{$actionid}frontend_height_units" id="{$actionid}frontend_height_units">
                {html_options options=$unitsinput selected=$mod->GetPreference('frontend_height_units')}
            </select>
            <br />
            <input type="checkbox" id="{$actionid}frontend_auto_height" name="{$actionid}frontend_auto_height" value="{$mod->GetPreference('frontend_auto_height')}"{if $mod->GetPreference('frontend_auto_height') == 1} checked="checked"{/if} /> {$mod->Lang('auto_height')}
        </p>
    </div>

    <div class="pageoverflow">
        <p class="pagetext"> {$mod->Lang('syntax_mode')} </p>
        <p class="pageinput">
            <select name='{$actionid}frontend_syntaxarea_mode' id='{$actionid}frontend_syntaxarea_mode'>
                {html_options options=$mod->AceGetModes() selected=$mod->GetPreference('frontend_syntaxarea_mode', 'html')}
            </select>
        </p>
    </div>

    <div class="pageoverflow">
        <p class="pagetext"> {$mod->Lang('themes')} </p>
        <p class="pageinput">
            <select name="{$actionid}frontend_syntaxarea_theme" id="{$actionid}frontend_syntaxarea_theme">
                {html_options options=$mod->AceGetThemes() selected=$mod->GetPreference('frontend_syntaxarea_theme', 'github')}
            </select>
        </p>
    </div>

    <div class="pageoverflow">
        <p class="pagetext"> {$mod->Lang('font_size')} </p>
        <p class="pageinput">
            <select name="{$actionid}frontend_fontsize" id="{$actionid}frontend_fontsize">
                {html_options options=$fontsizeinput selected=$mod->GetPreference('frontend_fontsize', '12px')}
            </select>
        </p>
    </div>

    <div class="pageoverflow">
        <p class="pagetext"> &nbsp; </p>
        <p class="pageinput"> {$frontendsubmit} </p>
    </div>

</fieldset>

{form_end}
{/strip}