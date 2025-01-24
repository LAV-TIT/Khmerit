<h2>Creating Module Instances</h2>

<p>This main and base module is a <strong>Control Panel</strong> for creating other <strong>LISE Module Instances</strong>.</p>
<p>To create a <strong>LISE Module Instance</strong>, simply go to <strong>Instances</strong> tab and click on <strong>Create Instance</strong> button.</p>
<p>Make sure you follow the CMSMS module naming conventions: use <strong>a - z</strong> characters with no punctuation or spaces to be safe.</p>
<div class="warning">
  <p><strong>Allow system to upgrade instances automatically when LISE is upgraded</strong> option is selected by default in the base LISE module options page.</p>
  <p>Without that option selected LISE will not install the new created instances at creation time and will not be able to set options other than the instance name, in which case the instances will have to be installed via Module Manager, and its options set after install.</p>
</div>
<div class="information">
  <p>LISE now has <strong>operation modes</strong>. These are mutually exclusive and can only be set on the instances creation page.</p>
</div>

<h3>Module Instances Modes</h3>
<p>LISE instances can have now three different <strong>operation modes</strong>:</p>
<ul>
  <li><strong>List</strong> (default)</li>
  <li><strong>Global</strong></li>
  <li><strong>Local</strong></li>
</ul>

<p>These are mutually exclusive and can only be set at creation time and only if the <strong>Allow system to upgrade instances automatically when LISE is upgraded</strong> is selected.</p>
<p>Otherwise the default mode will be <strong>List</strong> which is the usual, well known, instance behaviour <i>(more about mode s on <b>Help > Instance Modes</b> tab)</i>.</p>

<p class="m_top_25 m_bottom_25">As list mode is the usual, and default, LISE Instance behavior and the one you will use most often, we'll use it to explain the procedure to create a LISE instance.</p>
<p>You will be able to select a few of the options at creation time as long as you have LISE set to automatically install newly created instances.</p>
<p>You can set the instance <strong>Friendly Name</strong> and <strong>Module Admin Description</strong> on the <strong>Create Instance</strong> form.</p>
<p>You can also chose to hide or show the <strong>alias</strong> field and the <strong>URL</strong> field, and whether or not to use the <strong>time control</strong> feature on the item editor.</p>
<p>Additionally you can set the <strong>Module Admin Section</strong> i.e. where the module link will appear in the admin console of CMSMS. You will also have the option to have a separate <strong>Settings</strong> menu entry if you wish but it will always be set to show under the <strong>Site Admin</strong> section.</p>

<div class="information">
  <p>LISE now can have separated settings menu entry. The option is only possible when the instance is in <strong>Mode List</strong>.</p>
</div>

<p>After the module has been created a new instance will be installed and listed in original LISE module under the <strong>Instances</strong> tab.</p>
<p>You can always change the module friendly name once installed under <strong>Options</strong>.</p>
<p>To change the icon, replace <strong>/modules/<em>&lt;LISENameOfDuplicate&gt;</em>/images/icon.gif</strong>.</p>
<p>To change Admin section of the module, simply select appropriate section from Dropdown. Make sure you clear the cache after these changes.</p>