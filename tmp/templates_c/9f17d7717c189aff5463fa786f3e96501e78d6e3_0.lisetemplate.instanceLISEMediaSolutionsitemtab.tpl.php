<?php
/* Smarty version 4.5.2, created on 2025-01-12 00:36:37
  from 'lisetemplate:instance;LISEMediaSolutions;itemtab.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.2',
  'unifunc' => 'content_6782ac25d5b654_85023178',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9f17d7717c189aff5463fa786f3e96501e78d6e3' => 
    array (
      0 => 'lisetemplate:instance;LISEMediaSolutions;itemtab.tpl',
      1 => 1732713836,
      2 => 'lisetemplate',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6782ac25d5b654_85023178 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'D:\\xampp\\htdocs\\WEB\\khmerit\\lib\\plugins\\function.cms_action_url.php','function'=>'smarty_cms_function_cms_action_url',),));
if (count($_smarty_tpl->tpl_vars['items']->value) > 0) {?>
  <div class="item-search">
    <form id="quicksearch_form">
      <label class="pagetext"><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('search');?>
 <?php echo $_smarty_tpl->tpl_vars['title_plural']->value;?>
: </label>
        <input type="text" name="search" value="" id="item_search2" placeholder="<?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('searchfor');?>
 <?php echo $_smarty_tpl->tpl_vars['title']->value;?>
" />
        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
        <input type="hidden" name="actionid" value="<?php echo $_smarty_tpl->tpl_vars['actionid']->value;?>
" />
        <input type="hidden" name="returnid" value="<?php echo $_smarty_tpl->tpl_vars['returnid']->value;?>
" />
        <input type="hidden" id="pagenumber" name="pagenumber" value="<?php echo $_smarty_tpl->tpl_vars['pagenumber']->value;?>
" />
        <input type="hidden" name="pagecount" value="<?php echo $_smarty_tpl->tpl_vars['pagecount']->value;?>
" />
        <input type="hidden" name="first" value="<?php echo $_smarty_tpl->tpl_vars['first_page_number']->value;?>
" />
        <input type="hidden" name="previous" value="<?php echo $_smarty_tpl->tpl_vars['previous_page_number']->value;?>
" />
        <input type="hidden" name="next" value="<?php echo $_smarty_tpl->tpl_vars['next_page_number']->value;?>
" />
        <input type="hidden" name="last" value="<?php echo $_smarty_tpl->tpl_vars['last_page_number']->value;?>
" />

    </form>
  </div>
  <div class="pageoptions"><?php echo $_smarty_tpl->tpl_vars['addlink']->value;
if ((isset($_smarty_tpl->tpl_vars['importlink']->value))) {
echo $_smarty_tpl->tpl_vars['importlink']->value;
}
if ((isset($_smarty_tpl->tpl_vars['exportlink']->value))) {
echo $_smarty_tpl->tpl_vars['exportlink']->value;
}?></div>
  <div class="clear"></div>

  <div id="ajax_cnt">
  </div> 
  <div class="pageoptions" style="float:right;">
    <select id="lise_item_mass_action">
	    <option value=""><?php echo $_smarty_tpl->tpl_vars['mod']->value->ModLang('select_one');?>
</option>
	    <option value="delete">Delete</option>
	    <option value="approve">Toggle approve</option>
    </select>
  </div>
  <div class="pageoptions" style="float:right;"><?php echo $_smarty_tpl->tpl_vars['submitorder']->value;?>
</div>
<?php }?>
<div class="pageoptions">
  <?php echo $_smarty_tpl->tpl_vars['addlink']->value;
if ((isset($_smarty_tpl->tpl_vars['importlink']->value))) {
echo $_smarty_tpl->tpl_vars['importlink']->value;
}
if ((isset($_smarty_tpl->tpl_vars['exportlink']->value))) {
echo $_smarty_tpl->tpl_vars['exportlink']->value;
}?>
</div>


<?php echo '<script'; ?>
 type="text/javascript">
  var doom_ready = false;

var ajax_url = "<?php echo smarty_cms_function_cms_action_url(array('action'=>'ajax','forjs'=>1,'usr_function'=>'beItemsList'),$_smarty_tpl);?>
";

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


<?php echo '</script'; ?>
><?php }
}
