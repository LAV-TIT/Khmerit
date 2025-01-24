<script type='text/javascript'>
function go(record = 0)
{
  $.ajax(
  {
    type: 'POST',
    url: '{cms_action_url action=admin_do_import_csv forjs=1}',
    data:{
            record: record,
            of: {$rows_count}
         },
    success: function (data, status, xhr)
             {
               var percentage_done = Math.floor((data.current / {$rows_count}) * 100);
               $("#progressbar")
                 .progressbar(
                   {
                      value: percentage_done
                   });
               $('#current_rec').html(percentage_done);
               if(data.current < {$rows_count} && !data.done)
               {
                 return go(data.current);
               }
               $(".pageback").show();
               $("#success").show();
               return;
             },
    error: function(xhr)
           {
             $("#error_p").html(xhr.status + " " + xhr.statusText);
             $("#error").show();
           }
  });
}

$(document).ready(function()
{
  $("#progressbar")
    .progressbar({
                   max: 100
                 });
  $(".pageback").hide();
  $("#success").hide();
  $("#error").hide();
  go();
});
</script>
<h2>{$title}</h2>
<div class="pageoverflow">
  <div class="warning">
    <p>Please note that while this module was not designed to support a large number of items, it has been known to be used, in certain server configurations, with tens of thousands of records together with a high number of custom fields per instance, all with a reasonable performance. As such please be advised that importing a large number of files can be slow on some servers. The
      import function has been improved to prevent timeouts. The speed will vary with vary from server
      configuration to server configuration.</p>
  </div>
</div>
<div class="pageoverflow">
  <div id="progressbar"></div>
  <p>Imported <span id="current_rec">0</span>% of {$rows_count} records!</p>
  <div id="success" class="green"><p>Import has been completed sucessfuly.</p></div>
  <div id="error" class="red"><p id="error_p">Import has been completed sucessfuly.</p></div>
</div>
{$backlink}