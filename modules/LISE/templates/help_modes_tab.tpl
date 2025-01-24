<h3>Module Instance Modes</h3>
<p>LISE instances can have now three different <strong>operation modes</strong>:</p>
<ul>
  <li><strong>List</strong> (default)</li>
  <li><strong>Global</strong></li>
  <li><strong>Local</strong></li>
</ul>

<p>These are mutually exclusive and can only be set at creation time and only if the <strong>Allow system to upgrade instances automatically when LISE is upgraded</strong> is selected. Otherwise the default mode will be <strong>List</strong> which is the usual, well known, instance behaviour.</p>

<hr>

<h4>List Mode</h4>

<p>This is the usual LISE Instance behavior and the one you will use most of the time. If you are familiar with LISE you'll see the usual interface on the selected Admin section.</p>

<div class="information">
  <p>LISE now can have separated settings menu entry. The option is only possible when the instance is in <strong>Mode List</strong>.</p>
</div>

<p>If selected, the option to have a separated settings menu entry will split LISE interface in two pages accessible via different menu entries. One is the section selected in options where the items list and editor, as well as the categories and any additional local settings will be accessible <i>(more on local settings and instances in local mode below)</i>. The other section will be in <b>Settings - <i>&lt;Instance Friendly Name&gt;</i></b>, under the <b>Site Admin</b> section, where the custom fields definitions,  templates and options will be accessible.</p>
<p>The default is not to have the interface split, as in previous LISE versions, where all will be accessible in the menu entry with the friendly module name, under the selected admin section.</p>

<hr>

<h4>Global Mode</h4>

<div class="information">
  <p>This mode is somewhat limited in features. For a full fledged dedicated module use <a href="http://dev.cmsmadesimple.org/projects/customgs">Custom Global Settings</a>.</p>
  <p>LISE instances in gobal mode can easily complement the above module.</p>
</div>
<div class="m_top_25"></div>
<p>In this mode the instance will behave a bit like the old <strong>Global Content Blocks</strong> where you can have a list of global fields which can be used for a multitude of uses. Fields set in instances in <b><i>global mode</i></b> will be available in all templates in CMSMS, except if the template was created by some module that prevents global Smarty variables to be in scope. When a module is created in <b><i>global mode</i></b> it will automatically have a settings page in the admin section with the custom fields and options tabs split from the selected section, where it will only show a page similar to the <b>Items Editor</b>, but showing only the custom fields created for that purpose. In this mode the module Smarty tag will also have a different behaviour <em>(see below)</em>. The field types you will be able to use on this mode will be a bit less as some won't fit the purpose for this mode. <b>Categories</b>, for instance, won't be enabled for this use.</p>
<div class="m_top_25"></div>
<p>Let's say, as an example, that you have created a LISE instance called <b>Global</b> in <b><i>global mode</i></b>. LISE will, as usual, create a module instance that will be called <b>LISEGlobal</b>. However it will not register the module in Smarty as usual: <b>{ldelim}LISEGlobal{rdelim}</b> won't have the usual parameters you would expect and, particularly, won't have the expected frontend actions. While the tag is still valid, it will have different functions than what you'd expect from the usual LISE mode.</p>

<div class="warning">
  <p><b>LISEGlobal</b>, {ldelim}LISEGlobal{rdelim} and {ldelim}$LISEGlobal{rdelim} are used here as examples. The actual names will depend on the name you'll give to the modules on creation, and will follow the tipical template: <b>LISE<i>&lt;InstanceName&gt;</i></b></p>
</div>

<p>In Gobal mode the aliases of the created custom fields will be available using the following calls:</p>
<pre><code>{ldelim}* tag as static class with a get method *{rdelim}
{ldelim}LISEGlobal::get('&lt;field_alias&gt;'){rdelim}

{ldelim}* variable tag as either an object or an array *{rdelim}
{ldelim}$LISEGlobal.&lt;field_alias&gt;{rdelim}
{ldelim}$LISEGlobal['&lt;field_alias&gt;']{rdelim}
{ldelim}$LISEGlobal->&lt;field_alias&gt;{rdelim}
</code></pre>

<p>So, if you have a field with the alias <em>myalias</em> with the value 'My Text', to show 'My Text' on a template just use one of the following:</p>

<pre><code>{ldelim}* note the use of the LISEGlobal tag as static class with a get method *{rdelim}
{ldelim}LISEGlobal::get('myalias'){rdelim}

{ldelim}* otherwise use the $LISEGlobal variable tag as either an object or an array as below *{rdelim}
{ldelim}$LISEGlobal.myalias{rdelim}
{ldelim}$LISEGlobal['myalias']{rdelim}
{ldelim}$LISEGlobal->myalias{rdelim}
</code></pre>

<p>To see a json representation of all the stored field names and respective values use one of the following on your template:</p>

<pre><code>{ldelim}LISEGlobal{rdelim}
{ldelim}$LISEGlobal{rdelim}
</code></pre>
<div class="m_top_15"></div>
<div class="information">
  <p>The above tags will fail silently if the alias doesn't exist.</p>
  <p>However if you look at the page source you should find HTML comments such as <em>&lt;!-- invalid --&gt;</em> in case of errors.</p>
</div>
<div class="information">
  <p>You can have multiple instances in global mode, in different sections of the admin console.</p>
</div>
<div class="warning">
  <p>LISE plugins won't be able to differentiate aliases from multiple global instances, so in case you have the same alias on different instances only one the values will be available, and the one that is won't be easily predictable.</p>
</div>
<hr>
<h4>Local Mode</h4>

<p>In this mode the instance will behave as an add on tab for other <b>LISE instances</b>. However only instances in list mode will be able to use this feature: youl be able to select in the options tab one of the instances that may exist in local mode if any already exists. Although there can be multiple instances in local mode, instances in list mode can only select one of the local mode instances at any given time. Different instances in list mode can use the same local mode instance though.</p>
<p>This mode is similar to <b><i>global mode</i></b> in that the instance will behave a bit like the old <strong>Global Content Blocks</strong> but there are a few fundamental differences. First the module won't have a typical page where to edit the custom fields. As explained above it will appear as an additional tab, <b>Settings</b>. Fields set in instances in <b><i>local mode</i></b> will only be available in templates in scope with any of the LISE instances' frontend actions where that local instance is associated with. In local mode, LISE will try to determine which instance is currently in scope and retrieve the local settings used for that particular instance. As a rule of thumb only use these Smarty plugins from templates specific for the LISE instance it is associated with, or child templates.</p>
<div class="m_top_25"></div>
<p>Let's say, as an example, that you have created a LISE instance called <b>Local</b> in <b><i>local mode</i></b>. LISE will, as usual, create a module instance that will be called <b>LISELocal</b>. However it will not register the module in Smarty as usual: <b>{ldelim}LISELocal{rdelim}</b> won't have the usual parameters you would expect and, particularly, won't have the expected frontend actions. While the tag is still valid, it will have different functions than what you'd expect from the usual LISE mode.</p>

<div class="warning">
  <p><b>LISELocal</b>, {ldelim}LISELocal{rdelim} and {ldelim}$LISELocal{rdelim} are used here as examples. The actual names will depend on the name you'll give to the modules on creation, and will follow the tipical template: <b>LISE<i>&lt;InstanceName&gt;</i></b></p>
</div>

<p>In local mode the aliases of the created custom fields will be available using the following calls:</p>
<pre><code>{ldelim}* tag as static class with a get method *{rdelim}
{ldelim}LISELocal::get('&lt;field_alias&gt;'){rdelim}

{ldelim}* variable tag as either an object or an array *{rdelim}
{ldelim}$LISELocal.&lt;field_alias&gt;{rdelim}
{ldelim}$LISELocal['&lt;field_alias&gt;']{rdelim}
{ldelim}$LISELocal->&lt;field_alias&gt;{rdelim}
</code></pre>

<p>So, if you have a field with the alias <em>myalias</em> with the value 'My Text', to show 'My Text' on a template just use one of the following:</p>

<pre><code>{ldelim}* note the use of the LISELocal tag as static class with a get method *{rdelim}
{ldelim}LISELocal::get('myalias'){rdelim}

{ldelim}* otherwise use the $LISEGlobal variable tag as either an object or an array as below *{rdelim}
{ldelim}$LISELocal.myalias{rdelim}
{ldelim}$LISELocal['myalias']{rdelim}
{ldelim}$LISELocal->myalias{rdelim}
</code></pre>

<p>To see a json representation of all the stored field names and respective values use one of the following on your template:</p>

<pre><code>{ldelim}LISELocal{rdelim}
{ldelim}$LISELocal{rdelim}
</code></pre>
<div class="m_top_15"></div>
<div class="information">
  <p>You can have multiple instances in local mode, however you can only have one selected on any given LISE instance in list mode. Instances in list mode don't need to have any associated local mode instance at all.</p>
</div>
<div class="warning">
  <p>LISE plugins for local instances will be able to differentiate which of the instances in list mode associated with it is being used provided the plugins are being called from templates of actions of the associated list mode instances.</p>
</div>