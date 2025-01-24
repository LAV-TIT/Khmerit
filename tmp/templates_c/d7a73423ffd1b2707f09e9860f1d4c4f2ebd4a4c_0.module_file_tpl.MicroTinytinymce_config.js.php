<?php
/* Smarty version 4.5.2, created on 2025-01-11 22:35:24
  from 'module_file_tpl:MicroTiny;tinymce_config.js' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_67828fbca7dd05_25720160',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7a73423ffd1b2707f09e9860f1d4c4f2ebd4a4c' => 
    array (
      0 => 'module_file_tpl:MicroTiny;tinymce_config.js',
      1 => 1732710210,
      2 => 'module_file_tpl',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_67828fbca7dd05_25720160 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.root_url.php','function'=>'smarty_function_root_url',),1=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.cms_stylesheet.php','function'=>'smarty_function_cms_stylesheet',),));
?>
// define cmsms_tiny object
var cmsms_tiny = { };
// this is the actual tinymce initialization
tinymce.init({
    selector: '<?php if ((isset($_smarty_tpl->tpl_vars['mt_selector']->value)) && $_smarty_tpl->tpl_vars['mt_selector']->value != '') {
echo $_smarty_tpl->tpl_vars['mt_selector']->value;
} else { ?>textarea.MicroTiny<?php }?>',
    language: '<?php echo $_smarty_tpl->tpl_vars['languageid']->value;?>
',
    cmsms_tiny: cmsms_tiny = {
        schema: 'html5',
        base_url: '<?php echo smarty_function_root_url(array(),$_smarty_tpl);?>
/',
        resize: <?php if ((bool)$_smarty_tpl->tpl_vars['mt_profile']->value['allowresize']) {?>true<?php } else { ?>false<?php }?>,
        statusbar: <?php if ((bool)$_smarty_tpl->tpl_vars['mt_profile']->value['showstatusbar']) {?>true<?php } else { ?>false<?php }?>,
        menubar: <?php if ((bool)$_smarty_tpl->tpl_vars['mt_profile']->value['menubar']) {?>true<?php } else { ?>false<?php }?>,
        filepicker_title: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('filepickertitle'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        filepicker_url: '<?php echo $_smarty_tpl->tpl_vars['filepicker_url']->value;?>
&field=',
        filebrowser_title: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('title_cmsms_filebrowser'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        linker_text: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('cmsms_linker'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        linker_title: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('title_cmsms_linker'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        linker_image: '<?php echo $_smarty_tpl->tpl_vars['MT']->value->GetModuleURLPath();?>
/lib/images/cmsmslink.gif',
        linker_url: '<?php echo $_smarty_tpl->tpl_vars['linker_url']->value;?>
',
        linker_autocomplete_url: '<?php echo $_smarty_tpl->tpl_vars['getpages_url']->value;?>
',
        mailto_text: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('mailto_text'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        mailto_title: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('mailto_image'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        mailto_image: '<?php echo $_smarty_tpl->tpl_vars['MT']->value->GetModuleURLPath();?>
/lib/images/mailto.gif',
        prompt_page: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_linker'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_page_info: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('info_linker_autocomplete'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_alias: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_selectedalias'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_alias_info: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('tooltip_selectedalias'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_text: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_texttodisplay'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_class: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_class'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_rel: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_rel'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_target: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_target'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_insertmailto: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_insertmailto'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_email: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_email'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_anchortext: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_anchortext'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        prompt_linktext: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('prompt_linktext'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        tab_general: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('tab_general_title'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        tab_advanced: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('tab_advanced_title'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        target_none: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('none'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        target_new_window: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('newwindow'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
',
        loading_info: '<?php echo strtr((string)$_smarty_tpl->tpl_vars['MT']->value->Lang('loading_info'), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", 
                       "\n" => "\\n", "</" => "<\/", "<!--" => "<\!--", "<s" => "<\s", "<S" => "<\S",
                       "`" => "\\`", "\${" => "\\\$\{"));?>
'
    },
    document_base_url: cmsms_tiny.base_url,
    relative_urls: true,
    image_title: true,
    mysamplesetting: 'foobar',
    menubar: cmsms_tiny.menubar,
    statusbar: cmsms_tiny.statusbar,
    resize: cmsms_tiny.resize,
    removed_menuitems: 'newdocument',
    browser_spellcheck: true,
    // smarty logic stuff
<?php if ((isset($_smarty_tpl->tpl_vars['mt_cssname']->value)) && $_smarty_tpl->tpl_vars['mt_cssname']->value != '') {?>
    content_css: '<?php echo smarty_function_cms_stylesheet(array('name'=>$_smarty_tpl->tpl_vars['mt_cssname']->value,'nolinks'=>1),$_smarty_tpl);?>
',
<?php }
if ($_smarty_tpl->tpl_vars['isfrontend']->value) {?>
    toolbar: 'undo | bold italic underline | alignleft aligncenter alignright alignjustify indent outdent | bullist numlist | link mailto<?php if ($_smarty_tpl->tpl_vars['mt_profile']->value['allowimages']) {?> | image<?php }?>',
    plugins: ['tabfocus hr autolink paste link mailto anchor wordcount lists <?php if ($_smarty_tpl->tpl_vars['mt_profile']->value['allowimages']) {?> media image<?php }?> <?php if ($_smarty_tpl->tpl_vars['mt_profile']->value['allowtables']) {?>table<?php }?>'],
<?php } else { ?>
    image_advtab: true,
    toolbar: 'undo redo | cut copy paste | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify indent outdent | bullist numlist | anchor link mailto unlink cmsms_linker<?php if ($_smarty_tpl->tpl_vars['mt_profile']->value['allowimages']) {?> | image <?php }?>',
    plugins: ['tabfocus hr paste autolink link lists mailto cmsms_linker charmap anchor searchreplace wordcount code fullscreen insertdatetime <?php if ($_smarty_tpl->tpl_vars['mt_profile']->value['allowtables']) {?>table<?php }?> <?php if ($_smarty_tpl->tpl_vars['mt_profile']->value['allowimages']) {?>media image cmsms_filepicker <?php }?>'],
<?php }?>
    // callback functions
    urlconverter_callback: function(url, elm, onsave, name) {
        var self = this;
        var settings = self.settings;

        if (!settings.convert_urls || ( elm && elm.nodeName == 'LINK' ) || url.indexOf('file:') === 0 || url.length === 0) {
            return url;
        }

        // fix entities in cms_selflink urls.
        if (url.indexOf('cms_selflink') != -1) {
            decodeURI(url);
            url = url.replace('%20', ' ');
            return url;
        }
        // Convert to relative
        if (settings.relative_urls) {
            return self.documentBaseURI.toRelative(url);
        }
        // Convert to absolute
        url = self.documentBaseURI.toAbsolute(url, settings.remove_script_host);

        return url;
    },
    setup: function(editor) {
        editor.addMenuItem('mailto',{
           text: cmsms_tiny.prompt_insertmailto,
           cmd:  'mailto',
           context: 'insert',
        })
        editor.on('change', function(e) {
            $(document).trigger('cmsms_formchange');
        });
    },
    paste_as_text: true,
});
<?php }
}
