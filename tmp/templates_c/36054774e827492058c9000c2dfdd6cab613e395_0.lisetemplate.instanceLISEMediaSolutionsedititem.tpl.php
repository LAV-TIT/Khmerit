<?php
/* Smarty version 4.5.2, created on 2025-01-12 17:04:41
  from 'lisetemplate:instance;LISEMediaSolutions;edititem.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_678393b9b43647_05513735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '36054774e827492058c9000c2dfdd6cab613e395' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;edititem.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
    'lisetemplate:instance;".((string)$_smarty_tpl->tpl_vars[\'mod\']->value->GetName()).";admin_edit_item_buttons.tpl' => 2,
  ),
),false)) {
function content_678393b9b43647_05513735 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.cms_action_url.php','function'=>'smarty_cms_function_cms_action_url',),));
echo $_smarty_tpl->tpl_vars['backlink']->value;?>

<?php $_smarty_tpl->_assignInScope('new_item_flag', '');
if ($_smarty_tpl->tpl_vars['itemObject']->value->item_id < 1) {?>
  <?php $_smarty_tpl->_assignInScope('new_item_flag', '*');
}?>

<?php if ($_smarty_tpl->tpl_vars['mod']->value->GetPreference('title_auto_gen',FALSE)) {?>
  <?php $_smarty_tpl->_assignInScope('title', (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? LISESmarty::GenerateTitle() ?? null : $tmp));
}?>
<h3><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</h3>
<h4><?php echo (($tmp = $_smarty_tpl->tpl_vars['title']->value ?? null)===null||$tmp==='' ? "&laquo;".((string)$_smarty_tpl->tpl_vars['mod']->value->ModLang('untitled'))."&raquo;" ?? null : $tmp);?>
 <?php echo $_smarty_tpl->tpl_vars['new_item_flag']->value;?>
</h4>

<?php echo $_smarty_tpl->tpl_vars['startform']->value;?>

  <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
previous_id" value="<?php echo $_smarty_tpl->tpl_vars['previous_id']->value;?>
">
  <input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
next_id" value="<?php echo $_smarty_tpl->tpl_vars['next_id']->value;?>
">
  <input type="hidden" id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
submit_on_pn" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
submit_on_pn" value="">
  <input type="hidden" id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
go" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
go" value="">
  <input type="hidden" id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
modified" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
modified" value="">

  <?php $_smarty_tpl->_subTemplateRender("lisetemplate:instance;".((string)$_smarty_tpl->tpl_vars['mod']->value->GetName()).";admin_edit_item_buttons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('p'=>'top'), 0, true);
?>

<!-- start tab -->
<div id="page_tabs">
	<div id="edititem">
    <?php echo $_smarty_tpl->tpl_vars['mod']->value->GetPreference('item_singular');?>

	</div>
    <?php if ((((($tmp = $_smarty_tpl->tpl_vars['itemObject']->value ?? null)===null||$tmp==='' ? array() ?? null : $tmp) !== null ))) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['itemObject']->value->fielddefs, 'fielddef');
$_smarty_tpl->tpl_vars['fielddef']->index = -1;
$_smarty_tpl->tpl_vars['fielddef']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fielddef']->value) {
$_smarty_tpl->tpl_vars['fielddef']->do_else = false;
$_smarty_tpl->tpl_vars['fielddef']->index++;
$__foreach_fielddef_0_saved = $_smarty_tpl->tpl_vars['fielddef'];
?>
        <?php if ($_smarty_tpl->tpl_vars['fielddef']->value->type === 'Tabs' || $_smarty_tpl->tpl_vars['fielddef']->value->type === 'Preview') {?>
          <?php echo $_smarty_tpl->tpl_vars['fielddef']->value->displayTabHeader();?>

        <?php }?>
      <?php
$_smarty_tpl->tpl_vars['fielddef'] = $__foreach_fielddef_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
</div>
<!-- end tab //-->

<!-- start content -->
<div id="page_content"> 
  <div id="edititem_result"></div>
  <div id="edititem_c">

    <?php if ((isset($_smarty_tpl->tpl_vars['input_active']->value))) {?>
      <div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('active');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_active']->value;?>
</p>
      </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['mod']->value->GetPreference('display_create_date',0) == 1) {?>
      <div class="pageoverflow">
        <p class='pagetext'><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('create_time','');?>
: <em style='font-weight: normal;'><?php echo $_smarty_tpl->tpl_vars['itemObject']->value->create_time;?>
</em></p>
      </div>
    <?php }?>

        <?php if ($_smarty_tpl->tpl_vars['mod']->value->GetPreference('title_display_mode',0) == 0) {?>
      <div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->GetPreference('item_title','');?>
*:</p>
        <p class="pageinput">
          <input class="cms_textfield" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
title" id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" size="50" maxlength="255" type="text">
        </p>
      </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['mod']->value->GetPreference('title_display_mode',0) == 1) {?>
        <div class="pageoverflow">
          <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->GetPreference('item_title','');?>
*:</p>
        <p class="pageinput">
          <input class="cms_textfield" name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
title" id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" size="50" maxlength="255" type="text" disabled readonly>
        </p>
        </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['mod']->value->GetPreference('title_display_mode',0) == 2) {?>
      <input  name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
title" id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
title" value="<?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" type="hidden">
    <?php }?>

    
    
    <?php if ($_smarty_tpl->tpl_vars['hide_alias']->value) {?>
      <?php echo $_smarty_tpl->tpl_vars['input_alias']->value;?>

    <?php } else { ?>
      <div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('alias');?>
:</p>        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_alias']->value;?>
</p>
      </div>
    <?php }?>

    
        <?php if ($_smarty_tpl->tpl_vars['hide_slug']->value) {?>
            <input
        type="hidden"
        name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
url"
        id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
url"
        value="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">
    <?php } else { ?>
      <div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('url');?>
:</p>        <p class="pageinput">
                    <input
            type="text"
            class="cms_textfield"
            name="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
url"
            id="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
url"
            value="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
" size="50" maxlength="255"
            style="cursor: auto;">
        </p>
      </div>
    <?php }?>

    
    
    <?php if (!$_smarty_tpl->tpl_vars['hide_time_control']->value) {?>
      <div class="pageoverflow">
        <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('time_control');?>
:</p>
        <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_time_control']->value;?>
</p>
      </div>

      <div id="expiryinfo"<?php if ($_smarty_tpl->tpl_vars['use_time_control']->value != true) {?> style="display:none;"<?php }?>>
        <div class="pageoverflow">
          <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('start_time');?>
:</p>
          <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_start_time']->value;?>
</p>
        </div>

        <div class="pageoverflow">
          <p class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('end_time');?>
:</p>
          <p class="pageinput"><?php echo $_smarty_tpl->tpl_vars['input_end_time']->value;?>
</p>
        </div>
      </div>
    <?php }?>

    
    
    <?php if ((((($tmp = $_smarty_tpl->tpl_vars['itemObject']->value ?? null)===null||$tmp==='' ? array() ?? null : $tmp) !== null ))) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['itemObject']->value->fielddefs, 'fielddef');
$_smarty_tpl->tpl_vars['fielddef']->index = -1;
$_smarty_tpl->tpl_vars['fielddef']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['fielddef']->value) {
$_smarty_tpl->tpl_vars['fielddef']->do_else = false;
$_smarty_tpl->tpl_vars['fielddef']->index++;
$__foreach_fielddef_1_saved = $_smarty_tpl->tpl_vars['fielddef'];
?>
        <?php if ($_smarty_tpl->tpl_vars['fielddef']->value->type === 'Tabs' || $_smarty_tpl->tpl_vars['fielddef']->value->type === 'Preview') {?>
            <?php echo $_smarty_tpl->tpl_vars['fielddef']->value->RenderInput($_smarty_tpl->tpl_vars['actionid']->value,$_smarty_tpl->tpl_vars['returnid']->value);?>

        <?php } else { ?>
          <div id="fielddef-<?php echo $_smarty_tpl->tpl_vars['fielddef']->index;?>
">
            <?php echo $_smarty_tpl->tpl_vars['fielddef']->value->RenderInput($_smarty_tpl->tpl_vars['actionid']->value,$_smarty_tpl->tpl_vars['returnid']->value);?>

          </div>
        <?php }?>

      <?php
$_smarty_tpl->tpl_vars['fielddef'] = $__foreach_fielddef_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>

     
  </div>

</div>
  <?php $_smarty_tpl->_subTemplateRender("lisetemplate:instance;".((string)$_smarty_tpl->tpl_vars['mod']->value->GetName()).";admin_edit_item_buttons.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('p'=>'bottom'), 0, true);
echo $_smarty_tpl->tpl_vars['endform']->value;?>

<!-- end content //-->
<?php echo '<script'; ?>
 type="text/javascript">
  var item_id = <?php echo (($tmp = $_smarty_tpl->tpl_vars['itemObject']->value->item_id ?? null)===null||$tmp==='' ? -1 ?? null : $tmp);?>
;
  var previous_id = "<?php echo $_smarty_tpl->tpl_vars['previous_id']->value;?>
";
  var next_id = "<?php echo $_smarty_tpl->tpl_vars['next_id']->value;?>
";
  var ajax_url = '<?php echo smarty_cms_function_cms_action_url(array('action'=>'ajax','forjs'=>1),$_smarty_tpl);?>
';
  var action_id = '<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
';
  var manually_changed1 = item_id;
  var manually_changed2 = item_id;
  var finished_setup = 0;
  var ajax_xhr1 = 0;
  var ajax_xhr2 = 0;
  var ajax_timeout1;
  var ajax_timeout2;
  var fire_off = <?php echo (($tmp = $_smarty_tpl->tpl_vars['mod']->value->GetPreference('title_auto_gen',0) ?? null)===null||$tmp==='' ? '0' ?? null : $tmp);?>
;
  var submit_on_pn = <?php echo (int)$_smarty_tpl->tpl_vars['mod']->value->GetPreference('submit_on_pn',0);?>
;
  var submit_on_pn_changed = false;
  var is_modified = false;
  var input_go = $("#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
go");
  var input_modified = $("#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
modified");
  var edit_mode = "<?php echo $_smarty_tpl->tpl_vars['edit_mode']->value;?>
";

  function ajax_geturl()
  {
    var vtitle = $('#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
title').val();
    var data = {
      <?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
fnc: 'gen_slug',
      <?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
params : {
                            title: vtitle,
                            iid: item_id
                          }
    };

    ajax_xhr1 = $.ajax(
    {
      url: ajax_url,
      method: 'POST',
      data:  data,

      success: function(result)
               {
                 $('#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
url').val(result.content);
                 ajax_xhr1 = 0;
                }
    });
  }

  function ajax_get_alias()
  {
    var vtitle = $('#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
title').val();
    var data = {
      <?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
fnc: 'gen_alias',
      <?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
params : {
                            title: vtitle
                          }
    };

    ajax_xhr2 = $.ajax(
    {
      url: ajax_url,
      method: 'POST',
      data:  data,

      success: function(result)
               {
                 $('#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
alias').val(result.content);
                 ajax_xhr2 = 0;
               }
    });
  }

  function on_change()
  {
    if( manually_changed1 < 1 && finished_setup == 1)
    {
      // ajax function to get a unique url given a title.
      if( ajax_timeout1 != undefined ) clearTimeout(ajax_timeout1);
      if( ajax_xhr1 = 0 ) xhr.abort();
      ajax_timeout1 = setTimeout(ajax_geturl,500);
    }

    if( manually_changed2 < 1 && finished_setup == 1)
    {
      // ajax function to get a unique alias given a title.
      if( ajax_timeout2 != undefined ) clearTimeout(ajax_timeout2);
      if( ajax_xhr2 = 0 ) xhr.abort();
      ajax_timeout2 = setTimeout(ajax_get_alias,500);
    }
  }

  function submit_on_pn_set(e)
  {
    if( $(e).is(':checked') )
    {
     submit_on_pn = true;
    }
    else
    {
     submit_on_pn = false;
    }

    $("#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
submit_on_pn")
     .val( (submit_on_pn ? 1 : 0) );
    submit_on_pn_changed = true;
  }

  function process_pn(direction)
  {
    if( direction === 'previous')
    {
      input_go.val(previous_id);
    }

    if( direction === 'next')
    {
      input_go.val(next_id);
    }

    if(submit_on_pn)
    {
      $('.cms_form').submit();
      return false;
    }
    else
    {

      if(submit_on_pn_changed)
      {
        $('.cms_form').submit();
        return false;
      }
      else
      {
        if(is_modified)
        {
          $('#confirm-dialog').dialog('open');
          return false;
        }
      }
    }
  }

  /************************************/

  jQuery(document)
    .ready(function()
    {
//      if(edit_mode === 'copy')
//      {
//        alert('copy');
//      }

      $(".lise-previous-next, .lise-editor-options")
      .hover( function()
        {
          $(this).addClass('ui-state-hover');
        },
        function()
        {
          $(this).removeClass('ui-state-hover');
        }
      );

      $("#submit_on_pn_cb")
      .attr('checked', (submit_on_pn ? true : false));

      $("#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
submit_on_pn")
      .val(submit_on_pn);

      is_modified = (item_id === '-1');

      $("[name*='" + action_id + "'")
      .on("change", function()
      {
        is_modified = true;
        $(input_modified).val("1");
      });

      $('<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
url')
      .keyup(function()
      {
        var val = $(this).val();
        manually_changed1 = 0
        if( val != '' ) manually_changed1 = 1;
      });

      $('<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
alias')
      .keyup(function()
      {
        var val = $(this).val();
        manually_changed1 = 0
        if( val != '' ) manually_changed2 = 1;
      });

      $('form')
        .ajaxStart(function()
        {
          $('*').css('cursor','progress');
        });

      $('form')
      .ajaxStop(function()
      {
        $('*').css('cursor','auto');
      });

      $('#<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
title')
      .keyup(function()
      {
        on_change();
      });

      if(fire_off && item_id < 1)
      {
        ajax_get_alias();
        ajax_geturl();
      }

       $('.edit-previous')
       .on("click", function()
       {
         link = this;
         return process_pn('previous')
       });

       $('.edit-next')
       .on("click", function()
       {
         link = this;
         return process_pn('next')
       });

        finished_setup = 1;

        jQuery('[name=m1_apply]')
          .on('click', function()
          {
            if (typeof tinyMCE != 'undefined')
            {
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

        jQuery
          .post(url, data, function(resultdata, text)
          {
            var resp = jQuery(resultdata).find('Response').text();
            var details = jQuery(resultdata).find('Details').text();
            var htmlShow = '';

            if (resp === 'Success' && details !== '')
            {
              htmlShow = '<div class="pagemcontainer"><p class="pagemessage">' + details + '<\/p><\/div>';
            }
            else
            {
              htmlShow = '<div class="pageerrorcontainer"><ul class="pageerror">';
              htmlShow += details;
              htmlShow += '<\/ul><\/div>';
            }

            jQuery('#edititem_result').html(htmlShow);

            window
              .setTimeout(function()
              {
                $('.pagemcontainer').hide();
              }, 9000)
          }, 'xml');

        return false;
      });


       $('#confirm-dialog')
       .dialog(
       {
         autoOpen: false,
         width: 400,
         resizable: false,
         modal: true,
         buttons: {
           "Continue": function() {
             window.location = link.href;
           },
           "Cancel": function() {
             $(this).dialog("close");
           }
         }
       });

       $('#lise-editor-options-dlg')
       .dialog(
       {
         autoOpen: false,
         width: 400,
         resizable: false,
         modal: true,
         buttons: {
           'OK': function () {
             $(this).dialog('close');
             submit_on_pn_set( $("#submit_on_pn_cb") );
           },
           'Cancel': function () {
             $(this).dialog('close');
           },
         }
       });

       $('.lise-editor-options').on("click", function()
       {
         $('#lise-editor-options-dlg').dialog('open');
       });

  });

<?php echo '</script'; ?>
>



<div id="confirm-dialog" title="<?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('dlg_editor_np_warn_title');?>
"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('dlg_editor_np_warning');?>
</div>


<div id="lise-editor-options-dlg" title="Options">
  <div id="useroptions" style="width: auto; min-height: 113px; max-height: none; height: auto;" class="ui-dialog-content ui-widget-content">
    <form>
      <div class="c_full cf">
      <p class="pageinput">
        <label for="submit_on_pn_cb"> <?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('option_click_arrows');?>
:
          <input type="checkbox"
                  name="submit_on_pn_cb"
                  id="submit_on_pn_cb"
                  value="1"
           />
        </label>
      </p>
			</div>
    </form>
	</div>
</div><?php }
}
