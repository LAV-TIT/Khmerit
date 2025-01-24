<div class="pageoverflow">

    <h3>Templates</h3>

    <p>If you are not sure what variables are available to use in your templates, try debugging:</p>

    <p>{ldelim}{$module_name} debug=1}</p>
    
    <p>You can access any field directly when looping through items using its alias, for example, to if you created a field definition with an alias "position", you can do one of the following:</p>

    <pre class="code"><code>{literal}{foreach from=$items item=item}
  {$item->fielddefs.position.value|cms_escape}&lt;br /&gt;
{/foreach}

{foreach from=$items item=item}
  {$item->position|cms_escape}&lt;br /&gt;
{/foreach}{/literal}</code></pre>

</div>