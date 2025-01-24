{$backlink}
{**}
{$new_item_flag = ''}
{if $itemObject->item_id < 1}
  {$new_item_flag = '*'}
{/if}

{if $mod->GetPreference('title_auto_gen', FALSE)}
  {$title = $title|default:LISESmarty::GenerateTitle()}
{/if}
{**}
<h3>{$page_title}</h3>
<h4>{$title|default:"&laquo;{$mod->ModLang('untitled')}&raquo;"} {$new_item_flag}</h4>

{$startform}
  <input type="hidden" name="{$actionid}previous_id" value="{$previous_id}">
  <input type="hidden" name="{$actionid}next_id" value="{$next_id}">
  <input type="hidden" id="{$actionid}submit_on_pn" name="{$actionid}submit_on_pn" value="">
  <input type="hidden" id="{$actionid}go" name="{$actionid}go" value="">
  <input type="hidden" id="{$actionid}modified" name="{$actionid}modified" value="">

  {include file="lisetemplate:instance;{$mod->GetName()};admin_edit_item_buttons.tpl" p = 'top'}

<!-- start tab -->
<div id="page_tabs">
	<div id="edititem">
    {$mod->GetPreference('item_singular')}
	</div>
    {if isset($itemObject|default:[])}
      {foreach from=$itemObject->fielddefs item='fielddef'}
        {if $fielddef->type === 'Tabs' || $fielddef->type === 'Preview'}
          {$fielddef->displayTabHeader()}
        {/if}
      {/foreach}
    {/if}
</div>
<!-- end tab //-->

<!-- start content -->
<div id="page_content"> 
  <div id="edititem_result"></div>
  <div id="edititem_c">

    {if isset($input_active)}
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('active')}:</p>
        <p class="pageinput">{$input_active}</p>
      </div>
    {/if}

    {if $mod->GetPreference('display_create_date', 0) == 1}
      <div class="pageoverflow">
        <p class='pagetext'>{$mod->ModLang('create_time', '')}: <em style='font-weight: normal;'>{$itemObject->create_time}</em></p>
      </div>
    {/if}

    {*** title logic start ***}
    {if $mod->GetPreference('title_display_mode', 0) == 0}
      <div class="pageoverflow">
        <p class="pagetext">{$mod->GetPreference('item_title', '')}*:</p>
        <p class="pageinput">
          <input class="cms_textfield" name="{$actionid}title" id="{$actionid}title" value="{$title}" size="50" maxlength="255" type="text">
        </p>
      </div>
    {elseif $mod->GetPreference('title_display_mode', 0) == 1}
        <div class="pageoverflow">
          <p class="pagetext">{$mod->GetPreference('item_title', '')}*:</p>
        <p class="pageinput">
          <input class="cms_textfield" name="{$actionid}title" id="{$actionid}title" value="{$title}" size="50" maxlength="255" type="text" disabled readonly>
        </p>
        </div>
    {elseif $mod->GetPreference('title_display_mode', 0) == 2}
      <input  name="{$actionid}title" id="{$actionid}title" value="{$title}" type="hidden">
    {/if}

    {*** title logic end ***}

    {*** alias logic ***}

    {if $hide_alias}
      {$input_alias}
    {else}
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('alias')}:</p>{*$alias|default:''*}
        <p class="pageinput">{$input_alias}</p>
      </div>
    {/if}

    {*** alias logic end ***}

    {*** slug logic ***}
    {if $hide_slug}
      {*$input_url*}
      <input
        type="hidden"
        name="{$actionid}url"
        id="{$actionid}url"
        value="{$url}">
    {else}
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('url')}:</p>{*$url|default:''*}
        <p class="pageinput">
          {*$input_url*}
          <input
            type="text"
            class="cms_textfield"
            name="{$actionid}url"
            id="{$actionid}url"
            value="{$url}" size="50" maxlength="255"
            style="cursor: auto;">
        </p>
      </div>
    {/if}

    {*** slug logic end ***}

    {*** time_control logic ***}

    {if !$hide_time_control}
      <div class="pageoverflow">
        <p class="pagetext">{$mod->ModLang('time_control')}:</p>
        <p class="pageinput">{$input_time_control}</p>
      </div>

      <div id="expiryinfo"{if $use_time_control != true} style="display:none;"{/if}>
        <div class="pageoverflow">
          <p class="pagetext">{$mod->ModLang('start_time')}:</p>
          <p class="pageinput">{$input_start_time}</p>
        </div>

        <div class="pageoverflow">
          <p class="pagetext">{$mod->ModLang('end_time')}:</p>
          <p class="pageinput">{$input_end_time}</p>
        </div>
      </div>
    {/if}

    {*** time_control logic end ***}

    {*** defined custom fields logic ***}

    {if isset($itemObject|default:[])}
      {foreach from=$itemObject->fielddefs item='fielddef'}
        {if $fielddef->type === 'Tabs' || $fielddef->type === 'Preview'}
            {$fielddef->RenderInput($actionid, $returnid)}
        {else}
          <div id="fielddef-{$fielddef@index}">
            {$fielddef->RenderInput($actionid, $returnid)}
          </div>
        {/if}

      {/foreach}
    {/if}

    {*** defined custom fields logic end ***}
 
  </div>

</div>
  {include file="lisetemplate:instance;{$mod->GetName()};admin_edit_item_buttons.tpl" p = 'bottom'}
{$endform}
<!-- end content //-->
<script type="text/javascript">
  var item_id = {$itemObject->item_id|default:-1};
  var previous_id = "{$previous_id}";
  var next_id = "{$next_id}";
  var ajax_url = '{cms_action_url action=ajax forjs=1}';
  var action_id = '{$actionid}';
  var manually_changed1 = item_id;
  var manually_changed2 = item_id;
  var finished_setup = 0;
  var ajax_xhr1 = 0;
  var ajax_xhr2 = 0;
  var ajax_timeout1;
  var ajax_timeout2;
  var fire_off = {$mod->GetPreference('title_auto_gen', 0)|default:'0'};
  var submit_on_pn = {(int)$mod->GetPreference('submit_on_pn', 0)};
  var submit_on_pn_changed = false;
  var is_modified = false;
  var input_go = $("#{$actionid}go");
  var input_modified = $("#{$actionid}modified");
  var edit_mode = "{$edit_mode}";

  function ajax_geturl()
  {
    var vtitle = $('#{$actionid}title').val();
    var data = {
      {$actionid}fnc: 'gen_slug',
      {$actionid}params : {
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
                 $('#{$actionid}url').val(result.content);
                 ajax_xhr1 = 0;
                }
    });
  }

  function ajax_get_alias()
  {
    var vtitle = $('#{$actionid}title').val();
    var data = {
      {$actionid}fnc: 'gen_alias',
      {$actionid}params : {
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
                 $('#{$actionid}alias').val(result.content);
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

    $("#{$actionid}submit_on_pn")
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

      $("#{$actionid}submit_on_pn")
      .val(submit_on_pn);

      is_modified = (item_id === '-1');

      $("[name*='" + action_id + "'")
      .on("change", function()
      {
        is_modified = true;
        $(input_modified).val("1");
      });

      $('{$actionid}url')
      .keyup(function()
      {
        var val = $(this).val();
        manually_changed1 = 0
        if( val != '' ) manually_changed1 = 1;
      });

      $('{$actionid}alias')
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

      $('#{$actionid}title')
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

</script>


{* ** *** ** *}
{* hidden    *}
{* ** *** ** *}

<div id="confirm-dialog" title="{$mod->ModLang('dlg_editor_np_warn_title')}">{$mod->ModLang('dlg_editor_np_warning')}</div>

{* ** *** ** *}

<div id="lise-editor-options-dlg" title="Options">
  <div id="useroptions" style="width: auto; min-height: 113px; max-height: none; height: auto;" class="ui-dialog-content ui-widget-content">
    <form>
      <div class="c_full cf">
      <p class="pageinput">
        <label for="submit_on_pn_cb"> {$mod->ModLang('option_click_arrows')}:
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
</div>