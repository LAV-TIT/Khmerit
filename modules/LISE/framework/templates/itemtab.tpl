{if count($items) > 0}
  <div class="item-search">
    <form id="quicksearch_form">
      <label class="pagetext">{$mod->ModLang('search')} {$title_plural}: </label>
        <input type="text" name="search" value="" id="item_search2" placeholder="{$mod->ModLang('searchfor')} {$title}" />
        <input type="hidden" name="id" value="{$id}" />
        <input type="hidden" name="actionid" value="{$actionid}" />
        <input type="hidden" name="returnid" value="{$returnid}" />
        <input type="hidden" id="pagenumber" name="pagenumber" value="{$pagenumber}" />
        <input type="hidden" name="pagecount" value="{$pagecount}" />
        <input type="hidden" name="first" value="{$first_page_number}" />
        <input type="hidden" name="previous" value="{$previous_page_number}" />
        <input type="hidden" name="next" value="{$next_page_number}" />
        <input type="hidden" name="last" value="{$last_page_number}" />

    </form>
  </div>
  <div class="pageoptions">{$addlink}{if isset($importlink)}{$importlink}{/if}{if isset($exportlink)}{$exportlink}{/if}</div>
  <div class="clear"></div>

  <div id="ajax_cnt">{* ajax *}

  </div> {* ajax *}

  <div class="pageoptions" style="float:right;">
    <select id="lise_item_mass_action">
	    <option value="">{$mod->ModLang('select_one')}</option>
	    <option value="delete">Delete</option>
	    <option value="approve">Toggle approve</option>
    </select>
  </div>
  <div class="pageoptions" style="float:right;">{$submitorder}</div>
{/if}
<div class="pageoptions">
  {$addlink}{if isset($importlink)}{$importlink}{/if}{if isset($exportlink)}{$exportlink}{/if}
</div>
{*******************************************

testing stuff...

*******************************************}


<script type="text/javascript">
  var doom_ready = false;

var ajax_url = "{cms_action_url action = ajax forjs = 1 usr_function = 'beItemsList'}";

function ajax_post(params, ajax_url, selector)
{
  $.ajax({
           type : "POST",
           url : ajax_url,
           async : true,
           dataType : "html",
           data : { m1_params: params },
           beforeSend : function() {
             $(selector).empty().html('<div class="ajax-loading ajax-loader-type-wide"></div>');
             doom_ready = false;
           },
           error : function(jqXHR, textStatus, errorThrown) {
             alert("Sorry. There was a LISE AJAX error: " + textStatus);
             doom_ready = true;
           },
           success : function(data) {
             $(selector).html(data);

             initAjax();
             initAjaxEvents();

             $(".pagemcontainer").each(function() {
               var c = $(this);
               window.setTimeout(function() {
                 c.hide();
               }, 9000);
             });

             $('table#sortable_item').footable();

             initSortable();
             initSelectAll();
             initDatepicker();
             initTableSorter();
             initColorBox();
             doom_ready = true;
           }
         });
}

function on_change()
{
  if(!doom_ready) return;
  var params = $('#quicksearch_form').serializeArray();
  ajax_post(params, ajax_url, '#ajax_cnt');
}

function on_pagination_click(type, page_number)
{
  $('#pagenumber').val(page_number);

  var params = $('#quicksearch_form').serializeArray();

  console.log(params);
  ajax_post(params, ajax_url, '#ajax_cnt');
}

jQuery(document)
  .ready(function()
  {
    var params = $('#quicksearch_form').serializeArray();

    $('#quicksearch_form').submit(function(event) {
      event.preventDefault();
    });

    $('#ajax_cnt').html('<div class="ajax-loading ajax-loader-type-wide"></div>');


    ajax_post(params, ajax_url, '#ajax_cnt')


    var timeout;
    $('#item_search2').keyup(function() {
      if(timeout) {
        clearTimeout(timeout);
        timeout = null;
      }

      timeout = setTimeout(on_change, 500)
    });
    doom_ready = true;
  });


</script>