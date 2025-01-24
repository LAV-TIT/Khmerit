<h4>1.5.6</h4>
<h5>Fixes</h5>
<ul>
  <li>Fixed a bug regarding the ajax action and backend users permissions;</li>
  <li>Fixed PHP class bug affecting field definitions;</li>
</ul>
<h5>Added</h5>
<ul>
</ul>
<h4>Version 1.5.5</h4>
<h5>Fixes</h5>
<ul>
  <li>A few stability fixes;</li>
</ul>
<h5>Added</h5>
<ul>
  <li>New option to make an inactive item trigger a 404 error when accessed via its URL;</li>
</ul>

<h4>Version 1.5.4</h4>

<h5>Fixes</h5>
<ul>
  <li>Fixed a bug with the custom templates, fieddefs base class and its interaction with the template resource;</li>
  <li>Fixed a few issues with the module's help page;</li>
</ul>

<h4>Version 1.5.3</h4>

<h5>Fixes</h5>
<ul>
  <li>Fixed a bug introduced in 1.5.0 regarding permissions in ajax;</li>
  <li>Fixed a bug introduced in 1.5.0 regarding slug generation;</li>
  <li>Fixed a bug with duplicate aliases when copying an item and trying to save it;</li>
  <li>Fixed a bug regarding the use of summary template parameters;</li>
</ul>

<h5>Changes</h5>

<ul>
  <li>Not only the 'template_summary' has been deprecated but precedence of 'summarytemplate' over 'template_summary' has been enforced in case both are inadvertently used;</li>
</ul>

<h4>Version 1.5.2</h4>

<h5>Fixes</h5>
<ul>
  <li>Fixed a regression between beta versions regarding the xml importer;</li>
</ul>
<h4>Version 1.5.1</h4>

<h5>Fixes</h5>
<ul>
  <li>Fixed a bug introduced in 1.5.0 where routes in new items had an incorrect parameter registered;</li>
</ul>

<h4>Version 1.5.0</h4>

<h5>Fixes</h5>
<ul>
  <li>A few minor fixes;</li>
  <li>Fixed the changelog call;</li>
  <li>Fixed an issue with the generation of custom URLs when the field was hidden;</li>
  <li>More PHP 8.1 compatibility fixes;</li>
</ul>

<h5>New features</h5>

<ul>
  <li>Added new fields:
    <ul>
      <li>Custom Field From Smarty Template;</li>
      <li>Help Popup;</li>
      <li>Preview Tab;</li>
    </ul>
  </li>
  <li>Added Titles Modes and auto generation;</li>
  <li>Added easy navigation on the Item Editor via previous and next arrow buttons;</li>
  <li>Item Title, Alias and Custom URLs templates have new tags with more features;</li>
  <li>Added option to list inactive items, active items or both in LISE Instance Item custom field;</li>
  <li>Upload File can now use Smart Image API to process uploaded images;</li>
  <li>There is now an easy mechanism to customise field templates;</li>
</ul>

<h5>Changes</h5>

<ul>
  <li>Item Title, Alias and Custom URLs have an improved generator;</li>
  <li>Item Title, Alias and Custom URLs can now use faster and more robust smarty parsing;</li>
  <li>An attempt has been made to improve documentation;</li>
</ul>

<h4>Version 1.4.3</h4>

<h5>Fixes</h5>
<ul>
  <li>Fixes a vulnerability in a particular important action file;</li>
</ul>

<h4>Version 1.4.2</h4>

<h5>Fixes</h5>
<ul>
  <li>A few minor fixes;</li>
  <li>Re-fixed BR#12372: error while importing LISE instances previously not correctly fixed;</li>
</ul>

<h4>Version 1.4.1</h4>

<h5>Fixes</h5>
<ul>
  <li>Fixed BR#12372: error while importing LISE instances;</li>
  <li>Fixed a bunch of issues consequence of the 1.4 release being cut from a work copy that wasn't the latest tested and stable one;</li>
</ul>
<h4>Version 1.4</h4>

<h5>Fixes</h5>

<ul>
  <li>Several fixes for CMSMS 2.3 compatibility;</li>
  <li>Several PHP notices and warnings fixed;</li>
</ul>

<h5>New features</h5>

<ul>
  <li>Improved help text, now also field definition help (English only);</li>
</ul>


<h4>Version 1.3.1</h4>

<h5>Fixes</h5>

<ul>
  <li>Fixed a minor typo in version numbers in last changelog: previous version was 1.3, not 1.4;</li>
  <li>Fixed the JMFilePicker field deffinition: cleaned the file of older attempts of fixes (the fix had to be on the JMFilePicker itself, not here);</li>
  <li>Bumped the ninimum JMFilePicker version in dependencies;</li>
  <li>Fixed support to external modules fields definitions;</li>
  <li>Minor tweaks;</li>
</ul>


<h4>Version 1.3</h4>

<h5>New features</h5>

<ul>
  <li>Search parameters are now stored into the session so they can be retrieved by smarty if needed using <strong>&lt;<em>instancename</em>&gt;_search</strong> and <strong>&lt;<em>instancename</em>&gt;_search_*</strong>, where <strong>*</strong> is a field alias;</li>
  <li>Added <strong>"filterorderby"</strong> parameter on action search when using filters: orders the dropdown values on the search form template;</li>
  <li>Added a custom field for core <strong>"FilePicker"</strong>;</li>
</ul>

<h5>Changes</h5>

<ul>
  <li>Implemented FR#11320;</li>
  <li>Implemented FR#11323: Show item name in header;</li>
  <li>A number of improvements and fixes to the interaction between LISE and the core search feature:
    <ul>
      <li>now only text based fields can be indexed (TextInput and TextArea);</li>
      <li>fields need to be set in order to be indexed, as an option;</li>
      <li>LISE now supports any search module that is compatible with the Core Search Module;</li>
      <li>Re-indexing all content now actually works as expected on LISE side;</li>
      <li>A few other tweaks and enhancements;</li>
    </ul>
  </li>
</ul>

<h5>Fixes</h5>

<ul>
  <li>Fixes to FEUMultiSelect and JQueryMultiSelect: unselecting all now woks as expected;</li>
  <li>BR#11319 - XML Import does not work when there are entities in module friendly name;</li>
  <li>BR#11328 - minor error logged for FileUpload field;</li>
  <li>Fixes with regards to module_friendlyname not defaulting to module_name when the friendly name field is empty while creating a new instance;</li>
  <li>BR#11321 - edititem.tpl file has duplicated id's;</li>
  <li>BR#11242 - auto-alias is not valid when title starts with number;</li>
  <li>Fixes for pagination links on the frontend: pretty URls will still be available, but as soon as exta tag parameters are added and not supported by pretty URLs, ugly URLs kick in;</li>
  <li>Fixes to template resource and fielddef to make it work with cmsms 2.2.2 (on account of an important core security fix);</li>
  <li>BR#11071 - SelectDateTime field gets pre-filled with UTC time instead local;</li>
  <li>BR#11330 Save sortorder items reversed with default sortorder = DESC;</li>
  <li>A great number of minor fixes and code optimizations;</li>
</ul>


<h4>Version 1.2.3</h4>

<h5>Changes</h5>

<ul>
  <li>Changed most if not all die() error statements to exceptions, allowing for better error handling;</li>
</ul>

<h5>Fixes</h5>

<ul>
  <li>Fixes a bug introduced in 1.2.2.1 regarding the exclude_category and category parameters;</li>
  <li>Fixes a bug occurring when saving items with no categories it would error on some MySQL database setups;</li>
  <li>Fixes a small bug in the instance class constructor preventing the routes to be registered;</li>
</ul>

<h4>Version 1.2.2.1</h4>

<h5>Fixes</h5>

<ul> 
  <li>Removed a forgotten debug statement;</li>
</ul>

<h4>Version 1.2.2</h4>

<h5>New features</h5>

<ul>
  <li>Added JQuery MultiSelect Field Definition;</li>
  <li>Added JQuery MultiSelect to Categories options;</li>
  <li>LISE starts using the namespaces features of PHP 5.3.0;</li>
  <li>New exceptions handler: errors and exceptions in LISE can now be localized (check error codes and strings in the Translator Center);</li>
  <li>Added FEU SingleSelect Field Definition (deprecates FEU Dropdown);</li>
  <li>Added FEU MultiSelect Field Definition;</li>
  <li>Added support for arrays in optionvalues;</li> 
  <li>Added support for admin listing templates</li> 
</ul>

<h5>Fixes</h5>

<ul> 
  <li>Fixes backlink functionality;</li>
  <li>Fixes to the maintenance functions: fixing DB tables imported from LI2 should not issue a PHP Fatal Error in no conditions;</li>
  <li>Added route for pagination with category;</li>
  <li>Fixes detailpage parameter override on default action;</li>
  <li>Fixes exclude_category parameter: now items not belonging to any category don't get excluded;</li>
</ul>

<h4>Version 1.2.1.1</h4>

<h5>Minor Fixes</h5>

<ul> 
  <li>Minor fix to LI2 imported instances tables fixing code;</li>
  <li>Minor fix to field definitions;</li>
</ul>

<h4>Version 1.2.1</h4>

<h5>New features</h5>
<ul>  
  <li>
    Adds the ability to fix tables from previous LI2 imported instances;
  </li>  
</ul>

<h5>Fixes and Improvements</h5>

<ul> 
  <li>Fixes to the LISE_LI2converter class. Imported instances should work without errors now;</li>
</ul>

<h4>Version 1.2</h4>

<h5>New features</h5>
<ul>
  <li>
    Added CustomFromUDT field definition: allows to create select/checkboxes/radio fields with multiple selection capability and validation from UDTs ;
  </li> 
  <li>
    Added Category filter to the default action: you can now show summaries of selected categories;
  </li>  
  <li>
    Added the possibility to pass parameters to field templates (for instance to handle summary and detail views differently);
  </li>    
  <li>
    New field definitions: BackendText, FEUDropdown, GalleryDropdown, GBFilePicker (with CMSMS 1.x only), JMFilePicker, LISEInstance, LISEInstanceItem;
  </li>  
</ul>

<h5>Fixes and Improvements</h5>

<ul> 
  <li><strong>#10706 -</strong> minor notice;</li>
  <li>Better handling of fielddef custom templates;</li>
  <li>Fixes to SearchResult;</li>
  <li>Fixes to DateTime fielddef mainly related to db storage and sorting;</li>
  <li>Added a lise_datetime_utils class to help with format conversions;</li>
  <li>CategoryQuery class supports category parameter now;</li>
  <li>Improved Tags sorting;</li>
  <li>
    CustomFromUDT: added the possibility to customize Admin Listing presentation via UDT;
  </li>
  <li>
    Fixes bug #10814 - Assets fail to load if SSL is enabled for Backend. (Thanks hexdj);
  </li>
  <li>
    Numerous fixes and improvements in fielddefs templates;
  </li>
  <li>
    Numerous minor bug fixes;
  </li>
  <li>
    Fixes to routes in CMSMS 2.x(thanks ajprog);
  </li>
  <li>
    Tags interfering with CMSMS backend menu; fixes regarding aliases; additional work on routes (thanks ajprog);
  </li>
  <li>
    Fixes to backend instances pagination (BR #10712) (Thanks Jeff Bosch [ajprog] and Greg Prosser [geepers]);
  </li>
  <li>
    Fixes BR #10904, (thanks Jeff Bosch [ajprog] and Eduardo Martinez [hexdj]);
  </li>
  <li>
    Fixes to LI2 imports and LISE instance cloner; Updating fixes old imports/clones bugs;
  </li>
</ul>

<h4>Version 1.1.0</h4>

<h5>New features</h5>
<ul>
  <li>LISE instances can now be set to be upgraded manually or automatically on a per instance setting in conjunction with a global setting on LISE main module;</li>
  <li>LISE main module can now be set to be upgraded manually (recommended) to avoid timing out during upgrades;</li>
  <li>LISE main module has to be installed manually to avoid timeouts during installation;</li>
  <li>Added the capability to define the instance <strong>Friendly Name</strong>, <strong>Module Admin Description</strong> and <strong>Module Admin Section</strong> on the <strong>Create Instance</strong> form;</li>
  <li>Added instance import, export and clone capability;</li>
  <li>Implemented <strong>FRs #10643 and #10646</strong>:
    <ul>
      <li><strong>#10643 -</strong> added a <strong>Tabs</strong> field definition (thanks to <strong>Albert Cansado</strong>);</li>
      <li><strong>#10646 -</strong> made total record count available as a Smarty variable (thanks to <strong>Chris Ciavarella [caciavar]</strong>);</li>
    </ul>
  </li>
</ul>

<h5>Fixes</h5>

<ul>
  <li>Fixes to the Tags functionality;</li>
  <li>Fixes related with new CMSMS 2.0.1 way of handling variable scopes and template objects;</li>
  <li>Some minor fixes;</li>
</ul>

<h4>Version 1.0.2</h4>
<ul>
  <li>Minor fixes including #10635.</li>
</ul>
<h4>Version 1.0.1</h4>
<ul>
  <li>Minor fixes including #10630.</li>
</ul>
<h4>Version 1.0.0</h4>
<ul>
  <li>1st public release.</li>
</ul>