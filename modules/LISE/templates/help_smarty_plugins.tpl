<div class="pageoverflow">

  <h3>{ldelim}LISELoader}</h3>

  <h4>What does this do?</h4>
  
  <p>This plugin allows you to load LISE item and category object by certain criteria, anywhere in the system.</p>
   
  <h4>How do I use it?</h4>
  
  <p>Simply insert this tag into your page or template:</p>

  <pre><code>{ldelim}LISELoader item='item' identifier='alias' instance='LISEInstance' value='myalias' assign='tmp'}</code></pre>
  
  <br /><br />
  
  <p>Following line will load item object from instance 'LISEInstance' by alias 'myalias' and assign it to variable &dollar;tmp.<br />
  After this you can use it in similar way, just like in regular LISE templates:</p>

  <pre><code>{ldelim}&dollar;tmp->title}</code></pre>
  
  <br /><br />

  <p>If multiple items are being loaded, this function returns array of objects, else it returns single item/category object</p>

  <h4>What parameters does it take?</h4>
  
  <ul>
    <li><em>(required) </em><tt>instance</tt> - Name of instance that holds items. <i>(If used inside LISE templates, this parameter is optional)</i></li>
    <li><em>(required) </em><tt>value</tt> - Comma separated list of identifier values: 'alias1,alias2,alias3' or '1,2,3'</li>
    <li><em>(optional) </em><tt>item='item'</tt> - Wanted item type, either: item/category</li>
    <li><em>(optional) </em><tt>identifier='item_id/category_id'</tt> - Wanted identifier, one of following: item_id, category_id, alias</li>
    <li><em>(optional) </em><tt>force_array='false'</tt> - Force output value as array</li>
  </ul>

</div>