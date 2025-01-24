<?php
/* Smarty version 4.5.2, created on 2025-01-12 00:36:44
  from 'lisetemplate:instance;LISEMediaSolutions;edittemplate.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782ac2cf00301_57601219',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '25a9c844d20be557dce69f05614e069da4304188' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;edittemplate.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6782ac2cf00301_57601219 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- start tab -->
<div id="page_tabs">
	<div id="edittemplate">
		<?php echo $_smarty_tpl->tpl_vars['title']->value;?>

	</div>
</div>
<!-- end tab //-->
<!-- start content -->
<div id="page_content"> 
	<div id="edittemplate_c"> 
	<div id="edittemplate_result"></div>
	<?php echo $_smarty_tpl->tpl_vars['backlink']->value;?>

	<?php echo $_smarty_tpl->tpl_vars['startform']->value;?>


		<div class="pageoverflow">
    		<p class="pagetext">* <?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('template_name');?>
:</p>
    		<p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_name']->value;?>
</p>
		</div>
		
		<div class="pageoverflow">
    		<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('default_templates');?>
:</p>
    		<p class="pageinput tpl_list"><?php echo $_smarty_tpl->tpl_vars['input_tpl_list']->value;?>
</p>
		</div>

		<div class="pageoverflow">
    		<p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('template');?>
:</p>
    		<div class="pageinput tpl_content"><?php echo $_smarty_tpl->tpl_vars['input_template']->value;?>
</div>
		</div>

		<div class="pageoverflow">
    		<p class="pagetext">&nbsp;</p>
    		<p class="pageinput"><?php if ((isset($_smarty_tpl->tpl_vars['idfield']->value))) {
echo $_smarty_tpl->tpl_vars['idfield']->value;
}
echo $_smarty_tpl->tpl_vars['submit']->value;
echo $_smarty_tpl->tpl_vars['cancel']->value;
echo $_smarty_tpl->tpl_vars['apply']->value;
if ((isset($_smarty_tpl->tpl_vars['reset']->value))) {
echo $_smarty_tpl->tpl_vars['reset']->value;
}?></p>
		</div>

	<?php echo $_smarty_tpl->tpl_vars['endform']->value;?>

	</div>
</div>

<?php echo '<script'; ?>
 type="text/javascript">
jQuery(document).ready(function() {

	jQuery('.tpl_list select').change(function() {
		var callback = ajax_function('ModGetTemplateFromFile', $(this).val());
		callback.success(function(data) {
			jQuery('.tpl_content textarea').val(data);
		});
	});

    jQuery('[name=m1_apply]').live('click', function() {
        if (typeof tinyMCE != 'undefined') {
            tinyMCE.triggerSave();
        }
        var data = jQuery('form').find('input:not([type=submit]), select, textarea').serializeArray();
        data.push({
            'name': 'm1_ajax',
            'value': 1
        });
        data.push({
            'name': 'm1_apply',
            'value': 1
        });
        data.push({
            'name': 'showtemplate',
            'value': 'false'
        });
        var url = jQuery('form').attr('action');
		
        jQuery.post(url, data, function(resultdata, text) {
            var resp = jQuery(resultdata).find('Response').text();
            var details = jQuery(resultdata).find('Details').text();
            var htmlShow = '';
            if (resp === 'Success' && details !== '') {
                htmlShow = '<div class="pagemcontainer"><p class="pagemessage">' + details + '<\/p><\/div>';
            }
            else {
                htmlShow = '<div class="pageerrorcontainer"><ul class="pageerror">';
                htmlShow += details;
                htmlShow += '<\/ul><\/div>';
            }
            jQuery('#edittemplate_result').html(htmlShow);
            window.setTimeout(function(){ 
            	$('.pagemcontainer').hide(); 
            	}, 9000)
        }, 'xml');
        return false;
    });
});
<?php echo '</script'; ?>
>
<?php }
}
