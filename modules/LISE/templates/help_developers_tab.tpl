<h2>Advanced Use For Developers</h2>
<p>Since version 1.3 LISE has been including a wide range of advanced features, some experimental, other already stable. Most of these features have been poorly documented, if at all. In fact, some of those features have been lingering since LI2 or maybe even since List It (the two modules that originated LISE), and were not documented. These have been improved where possible or needed. Other features have been slowly implemented and seem mature enough to be documented at this point.</p>
<p>There are features across the spectrum of uses for this module, from the PHP developer point of view, who may need a simple module that can be based on LISE but with a few modifications and custom code, to the web developer that needs to customize the look and feel of some of the instances used on a site. LISE has become more and more a module builder toolkit, and it looks like the way to go from this point on.</p>
<h3>The Instance</h3>
<p>When an instance is created, independently of its mode, a new folder is created in the modules folder with the its name, usually <em>LISE&lt;name&gt;</em> and, by default, the following files inside it:</p>
<ul>
  <li><em>LISE&lt;name&gt;</em>.module.php;</li>
  <li>another folder named images with the file icon.png inside it;</li>
</ul>
<p>There may be more files and folders in there, and we'll see later on why and how, but these are the ones we need to know now. The *.module.php is a minimal php class file that extends LISE main instance class. There not much in terms of functionality in this file although it can be extended further if needed. The icon.php file can be replaced with a custom one, and it will be the one appearing in CMSMS backend for that instance. It's advisable to keep the size in pixels the same as the original for better fit in most CMSMS uses.</p>
<p>All the other files needed for a LISE instance to work are inside the main LISE module, and an instance cannot work without the main module. There are a few exceptions as we will see soon.</p>
<h3>DNA</h3>
<p>If you are a regular user of LISE you may have seen, for quite some time now, a <strong>Save DNA</strong> button on the Instances tab of the main LISE module. Clicking on it will save a file called dna.xml inside a folder named 'data' with enough information to recreate the instance elsewhere, as an empty module, i.e. just about the same as you would have with any other module, except that this requires LISE main module to work. This file is also created if an instance is uninstalled, and it will allow you to reinstall it but with empty data, except for the database structure and preferences. This way, a module created by you as an instance can be packaged as any other module and installed elsewhere. I can even be shared in the forge, or wherever you see fit.</p>
<p>The <strong>Save DNA</strong> button is there so that you can save it on your own whenever you make a change to its structure. Remember: custom fields, preferences and structure are saved this way and can be shared by sharing the full instance folder. Also keep in mind that it requires LISE to be installed for it to work;</p>
<h3>Developing Custom Fields for LISE</h3>
<p>For quite some time LISE and its ancestors had the ability to allow for 3rd party modules to add custom fields to its already rather extensive palette. But the inherited mechanism was extremely clumsy and ineffective: in large installations, scanning all the files and folders for traces of a possible plugin was a very slow process. LISE has now adopted a different and more effective method:</p>
<ol>
  <li>LISE grabs a list of installed modules and</li>
  <li>only scans those modules' directories for valid custom fields files structures</li>
</ol>

<p>In the future, a module that includes custom fields for LISE will have to list it as a capability.</p>
<p>For an example of how to add custom fields for LISE look at the way MAMS implements it.</p>

<h3>Customizing Backend Templates</h3>
<p>LISE inherited some of its ancestor modules ability to customise the backend templates for all its instances. But it has taken it some steps further:</p>

<h4>- master templates</h4>

<p>All the templates in both main LISE module and any of its instances can be overridden, although the ones which will be of more use will be the ones from instances, namely:</p>
<ul>
  <li><strong>edititem.tpl</strong></li>
  <li><strong>editcategory.tpl</strong></li>
</ul>

<p>There may be some interest in customizing the main items list display, mainly in what concerns the way some custom fields show ith the list, but that is better achieved elsewhere, as explained in a follow-up section.</p>
<p>As it happens with regular modules, LISE instances also support the use of the <strong>module_custom</strong> technique to customise the backend templates. However, and because LISE instances are not exactly regular modules, there are a few things different in the way this may work. To begin with, the fact that the instances templates are inside the <strong>LISE/framework/templates</strong> folder, which makes it harder to find them at first glance. This is the place where you will need to copy the templates from to the recommended locations to be customized without having to ever touch the original templates.</p>
<p>LISE instances look for its customised master templates in the following locations, by order:</p>
<ul>
  <li>
    the templates folder inside the instance own folder:
      <p>It doesn't exist by default, neither do the templates, but it can be created, and any template copied from the source above will override the original one. This is the best way as a first approach as it allows for the templates to be kept together with the customised instance and shared as a whole.</p>
  </li>
  <li>
    the templates folder inside the module_custom/instance_name folder:
      <p>It's legacy and will no longer be an option starting with LISE 2.0. Any template copied from the source above will override the previous ones.</p>
  </li>
  <li>
    the templates folder inside the assets/module_custom/instance_name folder:
      <p>Use as documented in <a href="https://docs.cmsmadesimple.org/customizing/customizing-admin-templates" target="_blank">Customizing Admin Templates</a>. Any template copied from the source above will override the previous ones.</p>
  </li>
</ul>
<h4>- custom fields templates</h4>
<p>There is the temptation to alter the original templates or even the PHP code in order to modify the fields' presentation. It actually used to be the only way to do any customisation to their presentation in the backend. That is no longer the case: LISE instances also have a mechanism to allow some degree of customisation to them without having to alter the original files.</p>
<p>There are two templates that can be used to do this customisation:</p>
<ul>
  <li>input.&lt;fieldname&gt;.tpl, where the actual input used in the item editor resides;</li>
  <li>list.&lt;fieldname&gt;.tpl, where the presentation of the field in a list, if selected to be listed, is defined;</li>
</ul>
<p>The original source of these templates are either in LISE (inside the modules/LISE/lib/fielddefs/&lt;fieldname&gt; folder) or in any other module that provides custom fields for LISE. You'll need to copy them to one of the locations listed below. Please note that these templates may not exist on the original field definitions folders for a number of reasons, but it will be an increasingly used and encouraged practice for most custom fields.</p>
<p>LISE instances look for its customised field definitions templates in the following locations, by order:</p>
<ul>
  <li>
    the &lt;fieldname&gt; folder inside the module_custom/instance_name/fielddefs folder:
      <p>It's legacy and will no longer be an option starting with LISE 2.0. Any template copied from the source above will override the original one.</p>
  </li>
  <li>
    the &lt;fieldname&gt; folder inside the assets/module_custom/instance_name/fielddefs folder:
      <p>Any template copied from the source above will override the previous ones.</p>
  </li>
  <li>
    the &lt;fieldname&gt; folder inside the modules/instance_name/templates/fielddefs folder:
      <p>Any template copied from the source above will override the previous ones.</p>
  </li>
</ul>

<p>LISE will use one of these templates even if there are no original template sources, so use carefully. On the bright side, you can always get back to the original with little effort.</p>

  <div class="pagewarning">
    <h3>Important Information</h3>
    <p>The whole template override mechanism was flawed in some ways:</p>
    <ul>
      <li>The <strong>field definitions</strong> objects were sending the wrong data to the <strong>template resource</strong>, which is what handles the way locating and prioritizing custom templates works: instead of the instance name, the originator module name was being used - in  most cases that was LISE itself but in any case there was no differentiation between instances; all custom templates were going under LISE or other originator folder as, for example: <strong>assets/module_custom/LISE/...</strong> instead of <strong>assets/module_custom/&lt;instance_name&gt;/...</strong>;</li>
      <li>This help page itself had a typo and some missing information: <strong>fielddef</strong> instead of <strong>fielddefs</strong> when mentioning the folder where to put the custom fielddef templates, and missed all the paragraph about the <strong>modules/instance_name/templates/fielddefs</strong> option which is very important when using either the DNA or export/import features;</li>
    </ul>
    <p>All of these have been fixed now, and the documentation now reflects the location options;</p>
  </div>

<h3>Action Files</h3>
<p>The best, and the most powerful, for last: overriding the instances PHP action files.</p>
<p>It's undoubtedly one of the most powerful and potentially dangerous features in LISE. It has been there for quite a while too but undocumented.</p>
<p>The PHP files inside the <strong>LISE/framework/templates</strong> folder can be copied to the below locations to override the original action files. These files all have the prefix <strong>action.</strong>, the action name and the <strong>.php</strong> extension.</p>
<p>This feature is meant for seasoned PHP developers with solid knowledge of the intricacies of both LISE and CMSMS and opens the door for some very high level of customization to the point of allowing to cook up a very powerful module in a very short period of time.</p>
<p>A few notes:</p>
<ul>
  <li>Security is of the essence: while developing and/or customizing PHP for a LISE instance, make sure you keep in place, copy or otherwise adopt the security measures implemented to prevent vulnerabilities or attack vectors;</li>
  <li>Always make sure the source of a customized LISE instance is reliable and trustworthy as this feature is extremely powerful;</li>
  <li>If you are not sure what you are doing either don't do it at all, or reach for specialized help from the dev team of CMSMS in its Slack channel (although this module is not their responsibility most of them are well versed in using it and its developer can usually be found there too);</li>
</ul>