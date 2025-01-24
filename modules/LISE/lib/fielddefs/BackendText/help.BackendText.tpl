<button class="accordion"><strong>{$fielddef->GetFriendlyType()}</strong></button>

<div class="accpanel">

  <h4>What does it do?</h4>

  <p>This field definition can be used to add <strong>read only text blocks</strong> to an item. The block will be rendered
    inside an <strong>HTML div tag</strong> which may have a class selected from the <strong>Container DIV Type</strong>
    option. The classes listed there may differ with LISE and CMSMS core versions or with the <strong>Administration Theme</strong> used.</p>

  <p>The block of text will be positioned as any other field type and can be ordered in the <strong>Field Definitions</strong> tab.</p>


  <h4>How do I use it?</h4>

  <p>The settings for this field are:</p>

  <ul>
    <li><strong>Container DIV Type:</strong>
      <ul>
        <li>None - the text block will be rendered without any special class;</li>
        <li>Green - <span class="green">the text block will be rendered with the class <strong>green</strong></span></li>
        <li>Yellow - <span class="yellow">the text block will be rendered with the class <strong>yellow</strong></span></li>
        <li>Red - <span class="red">the text block will be rendered with the class <strong>red</strong></span></li>
        <li>Information - <span class="information">the text block will be rendered with the class <strong>information</strong></span></li>
        <li>Warning - <span class="warning">the text block will be rendered with the class <strong>warning</strong></span></li>
      </ul>
    </li>
    <li><strong>Text</strong>: the text to insert in the block. Be carefull with the HTML tags used as it may break the items form page;</li>
  </ul>

  <div class="warning"><strong>Note:</strong> these options may vary with LISE version, CMSMS core version as well as the <strong>Administration Theme</strong> selected. The current settings have been tested with <strong>OneEleven</strong> (2.2.x) and <strong>Marigold</strong> (2.3.x).</div>

</div>