<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:13:38
  from 'module_file_tpl:AceSyntax;AdminSyntaxGenerateHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828aa2ef3d86_96870225',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '29ce7793e9b7b6ba495a4c4641baeddd3b9f9959' => 
    array (
      0 => 'module_file_tpl:AceSyntax;AdminSyntaxGenerateHeader.tpl',
      1 => 1732714756,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828aa2ef3d86_96870225 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\smarty\\plugins\\modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['mod']->value->GetModuleURLPath();?>
/lib/css/aceUI.css" />
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['mod']->value->GetModuleURLPath();?>
/lib/ace/ace.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['mod']->value->GetModuleURLPath();?>
/lib/ace/keybinding-vim.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['mod']->value->GetModuleURLPath();?>
/lib/ace/keybinding-emacs.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(document)
  .ready(function()
  {
    $('.AceSyntax')
    .each(function(index)
     {
       // do some initialization
       var textarea = $(this);
       var topHTML = '<?php echo $_smarty_tpl->tpl_vars['top']->value;?>
';
       var BottomHTML = '<?php echo $_smarty_tpl->tpl_vars['bottom']->value;?>
';
       var HTML = '';
       var textareaid = 'ace_editor' + index;
       var editorid = 'ace-editor' + index;
        textarea
         .attr({
                 'id': textareaid,
                 'data-ace-editor-id': editorid,
                 'data-ace-width': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('width','100');?>
',
                 'data-ace-width-units': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('width_units','%');?>
',
                 'data-ace-height': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('height','600');?>
',
                 'data-ace-auto-height': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('auto_height',0);?>
',
                 'data-ace-height-units': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('height_units','px');?>
',
                 'data-ace-selected-theme': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('theme','twilight');?>
',
                 'data-ace-selected-mode': 'html',     // revisit
                 'data-ace-font-size': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('fontsize','13px');?>
',
                 'data-ace-tab-size': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('tab_size','4');?>
',
                 'data-ace-soft-wrap': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('soft_wrap','80');?>
',
                 'data-ace-selection-style': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('full_line',1);?>
',
                 'data-ace-highlight-line': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('highlight_active',1);?>
',
                 'data-ace-highlight-word': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('highlight_selected',1);?>
',
                 'data-ace-show-invisibles': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('show_invisibles',0);?>
',
                 'data-ace-hscroll-bar': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('persistent_hscroll',0);?>
',
                 'data-ace-show-gutter': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('show_gutter',1);?>
',
                 'data-ace-wrap-line': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('wrap_line',1);?>
',
                 'data-ace-soft-tab': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('soft_tab',1);?>
',
                 'data-ace-behaviours-enabled': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('enable_behaviors',1);?>
',
                 'data-ace-print-margin': '<?php echo $_smarty_tpl->tpl_vars['mod']->value->AceGetPreference('print_margin',0);?>
'
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
  return '<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['ajax_link']->value,'&amp;','&');?>
';
}
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['mod']->value->GetModuleURLPath();?>
/lib/js/functions.js"><?php echo '</script'; ?>
>
<?php }
}
