<link rel="stylesheet" type="text/css" href="{$mod->GetModuleURLPath()}/lib/css/aceUI.css" />
<script src="{$mod->GetModuleURLPath()}/lib/ace/ace.js"></script>
<script src="{$mod->GetModuleURLPath()}/lib/ace/keybinding-vim.js"></script>
<script src="{$mod->GetModuleURLPath()}/lib/ace/keybinding-emacs.js"></script>

<script>
$(document)
  .ready(function()
  {
    $('.AceSyntax')
    .each(function(index)
     {
       // do some initialization
       var textarea = $(this);
       var topHTML = '{$top}';
       var BottomHTML = '{$bottom}';
       var HTML = '';
       var textareaid = 'ace_editor' + index;
       var editorid = 'ace-editor' + index;
        textarea
         .attr({
                 'id': textareaid,
                 'data-ace-editor-id': editorid,
                 'data-ace-width': '{$mod->AceGetPreference('width', '100')}',
                 'data-ace-width-units': '{$mod->AceGetPreference('width_units', '%')}',
                 'data-ace-height': '{$mod->AceGetPreference('height', '600')}',
                 'data-ace-auto-height': '{$mod->AceGetPreference('auto_height', 0)}',
                 'data-ace-height-units': '{$mod->AceGetPreference('height_units', 'px')}',
                 'data-ace-selected-theme': '{$mod->AceGetPreference('theme', 'twilight')}',
                 'data-ace-selected-mode': 'html',     // revisit
                 'data-ace-font-size': '{$mod->AceGetPreference('fontsize', '13px')}',
                 'data-ace-tab-size': '{$mod->AceGetPreference('tab_size', '4')}',
                 'data-ace-soft-wrap': '{$mod->AceGetPreference('soft_wrap', '80')}',
                 'data-ace-selection-style': '{$mod->AceGetPreference('full_line', 1)}',
                 'data-ace-highlight-line': '{$mod->AceGetPreference('highlight_active', 1)}',
                 'data-ace-highlight-word': '{$mod->AceGetPreference('highlight_selected', 1)}',
                 'data-ace-show-invisibles': '{$mod->AceGetPreference('show_invisibles', 0)}',
                 'data-ace-hscroll-bar': '{$mod->AceGetPreference('persistent_hscroll', 0)}',
                 'data-ace-show-gutter': '{$mod->AceGetPreference('show_gutter', 1)}',
                 'data-ace-wrap-line': '{$mod->AceGetPreference('wrap_line', 1)}',
                 'data-ace-soft-tab': '{$mod->AceGetPreference('soft_tab', 1)}',
                 'data-ace-behaviours-enabled': '{$mod->AceGetPreference('enable_behaviors', 1)}',
                 'data-ace-print-margin': '{$mod->AceGetPreference('print_margin', 0)}'
               })
          .addClass('ace_editor_textarea');

           HTML += '<div class="ace-wrapper" id="' + editorid + '_screen">';
           HTML += '<div class="ace-ui-container">';
           HTML += topHTML.replace(/\(ti\)/g, textareaid).replace(/\(ei\)/g, editorid).replace(/\(\#\)/g, index);
           HTML += '<div class="ace-container">';
           HTML += $(textarea).get(0).outerHTML;
           HTML += '</div>';
           HTML += BottomHTML.replace(/\(ti\)/g, textareaid);
           HTML += '</div>';
           HTML += '</div>';
           $(textarea).replaceWith(HTML);
         });

    console.log('Header done!')
      });

function getRequestUri()
{
  return '{$ajax_link|replace:'&amp;':'&'}';
}
</script>

<script src="{$mod->GetModuleURLPath()}/lib/js/functions.js"></script>
