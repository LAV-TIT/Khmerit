<div class="pageoverflow">

  <h3>Fields Definitions Help</h3>
  
  <p>At the "Field Definitions" tab of your LISE instance you click the "Add Field Definition" link to create a new field.<br />
    After creation, you can click on the name or edit icon to change the settings.<p>
  <br />

  <p>Field definitions have some common settings (the <strong>Main Settings</strong> and <strong>Template</strong>) and some specific settings (or <strong>Options</strong>).</p>
  <br />

  <fieldset>

    <legend>Main Settings</legend>
    
    <p>Common to all field definitions you'll find the <strong>Name</strong> (required), <strong>Alias</strong>, <strong>Helpful tip</strong> and <strong>Required</strong>.</p>
    
    <ul>
      <li><strong>Name</strong>: a meaningful name for the input. It will be shown as a prompt for the field in the Item Editor;</li>
      <li><strong>Alias</strong>: if you don't provide it, one will be generated for you. It will be used in the templates when you need to call the field definition by alias;</li>
      <li><strong>Helpful tip</strong>: If provided will be shown next to the input as instructions or help to the user when filling the form in the Item Editor;</li>
      <li><strong>Required</strong>: sets the field as required or optional;</li>
    </ul>

  </fieldset>

  <br />

  <fieldset>

    <legend>Template</legend>
      
    <p>This is an experimental feature: it has been around for a while but undocumented. The idea behind this feature is the customization of the frontend rendering of the field on the frontend and simplifying the summary and detail templates.</p>
      
    <p class="m_top_10"><em> Example of a simplified detail template:</em></p>
      
    {literal}<pre><code>...

{if !empty($item->fielddefs)}
  {foreach $item->fielddefs as $fielddef}
    {$fielddef.View()}
  {/foreach}
{/if}

...</code></pre>{/literal}
      
    <p>The sample above shows how to use the template feature by calling the <strong>View</strong> method of the field definition object in a <strong>Detail</strong> template context. This method renders the template defined in this field definition setting.</p>

  </fieldset>

  <br />

  <fieldset>

  <legend>Options</legend>
    
    <p>This group of settings is especific to each field definition. There might be a few similar options but they will all depend on the context of each custom field.</p>
    <p>The basics of the use of a field definition and the available settings can be read below, more information is be displayed at the field.</p>

  </fieldset>

  <br />
  
  <h3>Check the following accordion for each field explanation and help:</h3>

  <div class="m_top_15">
    {if count($fielddefs) > 0}
      {foreach $fielddefs as $fielddef}
        {$fielddef->GetHelp()}
      {/foreach}
    {/if}
  </div>

</div>