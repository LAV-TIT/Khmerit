<button class="accordion"><strong>{$fielddef->GetFriendlyType()}</strong></button>

<div class="accpanel">

	<h4>What does it do?</h4>

	<p>This field definition can be used to add a <strong>Smarty parsed template multiple input</strong> to a LISE item.</p>

	<p>TODO</p>


	<h4>How do I use it?</h4>
	<p>Fill $opts array with key value pairs and pass it to any of the following tags. $name and $sel are already provided by the module.</p>
	<p>For Dropdown and MultiSelect types use: {literal}{html_options options=$opts selected=$sel}{/literal}</p>
	<p>For RadioGroup type use: {literal}html_radios name=$name options=$opts selected=$sel separator='<br />'}</p>
	<p>For CheckboxGroup type use: {html_checkboxes  name=$name options=$opts selected=$sel separator='<br />'}</p>

	<p>The settings for this field are:</p>

	<ul>
		<li><b>TODO:</b>
 			<ul>
 				<li> </li>
			</ul>
		</li>
		<li><b> </b></li>
		<li><b> </b></li>
		<li><b> </b></li>
	</ul>

</div>