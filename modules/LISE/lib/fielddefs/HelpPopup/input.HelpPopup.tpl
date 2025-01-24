{$id = $fielddef->GetId()}
{$options = $fielddef->GetOptions()}
{if !empty($options.title)}
  <div id="place-holder-{$id}"></div>
  <span id="opener-{$id}">
    <img class="cms_helpicon" src="{$fielddef->GetIcon()}" {* alt="" *}>
  </span>

    <div id="dialog-{$id}" title="{$options.title|strip_tags:false}">
      {$options.msg}
    </div>

  <script>
    $(function()
    {
     $( "#opener-{$id}" )
       .appendTo(
         $("#place-holder-{$id}")
           .parent()
           .prev()
           .find(".pagetext")
       );

     $( "#dialog-{$id}" )
       .dialog({
                 autoOpen: false,
                 draggable: true,
                 drag: function(event, ui) {
                   var fixPix = $(document).scrollTop();
                   iObj = ui.position;
                   iObj.top = iObj.top - fixPix;
                   $(this).closest(".ui-dialog").css("top", iObj.top + "px");
                 }
               });

     $( "#opener-{$id}" )
       .click(function()
              {
                $( "#dialog-{$id}" ).dialog( "open" );
              });
    });
  </script>
{/if}