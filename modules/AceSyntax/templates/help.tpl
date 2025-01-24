{strip}

{tab_header name='support' label='Support'}
{tab_header name='general' label='General'}
{tab_header name='backend' label='Backend Use'}
{tab_header name='frontend' label='Frontend Use'}
{tab_header name='shortcuts' label='Shortcuts'}
{tab_header name='modes_themes' label='Modes and Themes'}
{tab_header name='troubleshooting' label='Troubleshooting'}
{tab_header name='copyright' label='Copyright and License'}

{tab_start name='support'}

	<h3>This module is brought to you by:</h3>
	<ul>
		<li>Fernando Morgado [jomorg at sm-art-lab dot com].</li>
		<li>Rolf Tjassens [info at cmscanbesimple dot org].</li>
	</ul>
		
	<h3>Support</h3>
	<p>This module does not contain any commercial support. If you have problems, ask for help in the:</p>
	<ul>
		<li><a href="https://forum.cmsmadesimple.org/" rel="noopener noreferrer" target="_blank">CMS Made Simple forums</a>;</li>
		<li><a href="https://www.cmsmadesimple.org/support/documentation/chat/" rel="noopener noreferrer" target="_blank">Slack chat</a>;</li>
		<li>or write an email to the author.</li>
	</ul>


{tab_start name='general'}

	<h3>What does this module do?</h3>

	<p><img src="{$module_path}/images/editor_screenshot.jpg" alt="screenshot editor" style="float: right; margin: 10px;" />
		The AceSyntax module is a Syntaxhighlighter plugin for CMS Made Simple using <strong>Ace</strong>, a standalone code editor written in JavaScript.<br />
		Goal of Ace code editor group is to create a web based code editor that matches and extends the features, usability and performance of existing native editors such as TextMate, Vim or Eclipse.<br />
		Ace is developed as the primary editor for <a href="http://www.cloud9ide.com">Cloud9 IDE</a> and the successor of the Mozilla Skywriter (Bespin) Project.</p>

	<h4>Ace Features:</h4>

	<ul>
		<li>Syntax highlighting</li>
		<li>Automatic indent and outdent</li>
		<li>An optional command line</li>
		<li>Handles huge documents (100,000 lines and more are no problem)</li>
		<li>Fully customizable key bindings including VI and Emacs modes</li>
		<li>Themes (TextMate themes can be imported)</li>
		<li>Search and replace with regular expressions</li>
		<li>Highlight matching parentheses</li>
		<li>Toggle between soft tabs and real tabs</li>
		<li>Displays hidden characters</li>
		<li>Drag and drop text using the mouse</li>
		<li>Line wrapping</li>
		<li>Unstructured / user code folding</li>
		<li>Live syntax checker (currently JavaScript/CoffeeScript)</li>
	</ul>

	<h3>Ace is hosted on GitHub</h3>

	<p>The Ace source code is hosted on GitHub. It is released under the Mozilla tri-license (MPL/GPL/LGPL).<br />
		This is the same license used by Firefox. This license is friendly to all kinds of projects, whether open source or not.<br />
		Take charge of your editor and add your favorite language highlighting and keybindings!</p>


{tab_start name='backend'}

	<h3>Using AceSyntax Module</h3>

	<p>Using AceSyntax Module is simple. After the module is installed go to "My Preferences &raquo; User Preferences" and choose AceSyntax as your Syntaxhighlighter of choice from "Select syntax highlighter to
		use:" dropdown.<br />
		Make sure you have 'Modify Site Preferences' Permsission.</p>

	<h3>Settings</h3>

	<p>You can change default Settings, Modes and Themes at "My Preferences &raquo; AceSyntax"</p>


{tab_start name='frontend'}

	<p>This module can also be used as a frontend syntaxhighlighter.<p>
	<p>There are a few steps you have to take for it to work. Ace is implemented as a jQuery plugin so an updated version of this framework is required for this functionality to work. To give you more versatility you can include jQuery in a number of different ways:</p>
	<ul>
		<li>you can include it yourself if your template doesn't already use it;</li>
		<li>you may use CMSMS <b><code>{ldelim}cms_jquery}</code></b> tag <em>(be aware that this tag is deprecated and is removed from CMS core in upcoming release 2.3)</em>;</li>
		<li>you may use AceSyntax own Smarty helper <b><code>{ldelim}acesyn::js(1)}</code></b> (see notes below);</li>
		<li>you may use a 3rd party plugin if you prefer;</li>
	</ul>

	<p>jQuery can be included in the template either in the HTML <b><code>&lt;head&gt;</code></b> section or right before the closing <b><code>&lt;/body&gt;</code></b> tag. The <b><code>{ldelim}acesyn::js()}</code></b> tag must be right after or even at the end of any plugins included for jQuery.<p>
	<p>Note that <b><code>{ldelim}acesyn::js()}</code></b> may have a parameter which may be <b>1</b>, <b>0</b> or empty in which case it will assume <b>0</b>: this will tell AceSyntax whether to include a link to jQuery CDN or not. If not only the initialization script of Ace will be included.<p>
	<p>Also required is the <b><code>{ldelim}acesyn::css()}</code></b> which unlike the js plugin <b>must</b> be included in the HTML <b><code>&lt;head&gt;</code></b> section as it includes the CSS reset for the containers of the code to highlight</p>
	<p>Finaly add a call to specify which area should be highlighted, for example <b><code>{ldelim}ace_code} your code {ldelim}/ace_code}</code></b> in your content.</p>
	<p>You can call the block plugin as many times in a single page as you which: AceSyntax will automaticaly add an unique id to each container but you can always specify an id if needed.</p>
	<p>To avoid having to repeat the same parameter on every tag, AceSyntax has a tag <b><code>{ldelim}ace_page_reset}</code></b> where you can add the accepted parameters once and they will be used by all subsequent tags on the same page.</p>
	<p>Please note that there is an hierarchy by which parameters are overwritten:</p>

	<ul>
		<li>parameters set in each block tag have precedence over all the rest;</li>
		<li>parameters set in <b><code>{ldelim}ace_page_reset}</code></b> will affect all subsequent tags in the page except where the block tags have specific overrides;</li>
		<li>if no parameters are set in any of the tags or <b><code>{ldelim}ace_page_reset}</code></b> is not used, the preferences set in the admin panel are used;</li>
	</ul>

	<h3>So how do you use it?</h3>

	<p>First include jQuery (if you are not using it already), for example in &quot;Page Specific Metdata&quot;:</p>

<pre>
{ldelim}cms_jquery exclude='jquery-ui.min.js, jquery.ui.nestedSortable.js,jquery.json.min.js'}
</pre>

	<p>This includes needed JavaScript scripts for Ace Syntaxhighlighter to work.<br />
		In Module Admin interface you can select default settings for your code blocks or use parameter on Module block plugin mode='html' and theme='textmate' which would override selected Preferences.</p>

	<p>Write your code which you would like to be highlighted inside <code>{ldelim}ace_code} {ldelim}/ace_code}</code> block plugin.</p>

<pre>
{ldelim}ace_code theme='twilight' mode='ruby' divid='my-code-block'} Code in here {ldelim}/ace_code}
</pre>

	<p>This block plugin includes needed jQuery plugin call and wraps your content inside &lt;pre&gt; HTML tag specified id.</p>

<pre>
<code>
{literal}{ace_code id='some-id' theme='twilight' htmlentities='1' mode='javascript'}
&lt;html&gt;
&lt;head&gt;
  &lt;style type="text/css"&gt;
    .text-layer {
      font-family: Monaco, "Courier New", monospace;
      font-size: 12px;
      cursor: text;
    }
  &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
  &lt;h1 style="color:red"&gt;YES!&lt;/h1&gt;
&lt;/body&gt;
&lt;/html&gt;
{/ace_code}{/literal}
</code>
</pre>


{tab_start name='shortcuts'}

	<h3>Default Keyboard Shortcuts</h3>

	<table class="pagetable" cellspacing="0" summary="Default Keyboard Shortcuts">
	<thead>
	<tr>
	<th>PC (Windows/Linux)</td>
	<th>Mac</td>
	<th>Action</td>
	</tr>
	</thead>
	<tbody>
	<tr class="row1">
	<td align="left">Ctrl-Return</td>
	<td align="left">Command-Return</td>
	<td align="left">fullscreen</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-S</td>
	<td align="left">Command-S</td>
	<td align="left">perform save</td>
	</tr>
	<tr class="row1">
	<td align="left"></td>
	<td align="left">Ctrl-L</td>
	<td align="left">center selection</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-Alt-Down</td>
	<td align="left">Command-Option-Down</td>
	<td align="left">copy lines down</td>
	</tr>
	<tr lcass="row1">
	<td align="left">Ctrl-Alt-Up</td>
	<td align="left">Command-Option-Up</td>
	<td align="left">copy lines up</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-F</td>
	<td align="left">Command-F</td>
	<td align="left">find</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-K</td>
	<td align="left">Command-G</td>
	<td align="left">find next</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-Shift-K</td>
	<td align="left">Command-Shift-G</td>
	<td align="left">find previous</td>
	</tr>
	<tr class="row1">
	<td align="left">Down</td>
	<td align="left">Down,Ctrl-N</td>
	<td align="left">go line down</td>
	</tr>
	<tr class="row2">
	<td align="left">Up</td>
	<td align="left">Up,Ctrl-P</td>
	<td align="left">go line up</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-End,Ctrl-Down</td>
	<td align="left">Command-End,Command-Down</td>
	<td align="left">go to end</td>
	</tr>
	<tr class="row2">
	<td align="left">Left</td>
	<td align="left">Left,Ctrl-B</td>
	<td align="left">go to left</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-L</td>
	<td align="left">Command-L</td>
	<td align="left">go to line</td>
	</tr>
	<tr class="row2">
	<td align="left">Alt-Right,End</td>
	<td align="left">Command-Right,End,Ctrl-E</td>
	<td align="left">go to line end</td>
	</tr>
	<tr class="row1">
	<td align="left">Alt-Left,Home</td>
	<td align="left">Command-Left,Home,Ctrl-A</td>
	<td align="left">go to line start</td>
	</tr>
	<tr class="row2">
	<td align="left">PageDown</td>
	<td align="left">Option-PageDown,Ctrl-V</td>
	<td align="left">go to page down</td>
	</tr>
	<tr class="row1">
	<td align="left">PageUp</td>
	<td align="left">Option-PageUp</td>
	<td align="left">go to page up</td>
	</tr>
	<tr class="row2">
	<td align="left">Right</td>
	<td align="left">Right,Ctrl-F</td>
	<td align="left">go to right</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-Home,Ctrl-Up</td>
	<td align="left">Command-Home,Command-Up</td>
	<td align="left">go to start</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-Left</td>
	<td align="left">Option-Left</td>
	<td align="left">go to word left</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-Right</td>
	<td align="left">Option-Right</td>
	<td align="left">go to word right</td>
	</tr>
	<tr class="row2">
	<td align="left">Tab</td>
	<td align="left">Tab</td>
	<td align="left">indent</td>
	</tr>
	<tr class="row1">
	<td align="left">Alt-Down</td>
	<td align="left">Option-Down</td>
	<td align="left">move lines down</td>
	</tr>
	<tr class="row2">
	<td align="left">Alt-Up</td>
	<td align="left">Option-Up</td>
	<td align="left">move lines up</td>
	</tr>
	<tr class="row1">
	<td align="left">Shift-Tab</td>
	<td align="left">Shift-Tab</td>
	<td align="left">outdent</td>
	</tr>
	<tr class="row2">
	<td align="left">Insert</td>
	<td align="left">Insert</td>
	<td align="left">overwrite</td>
	</tr>
	<tr class="row1">
	<td align="left"></td>
	<td align="left">PageDown</td>
	<td align="left">pagedown</td>
	</tr>
	<tr class="row2">
	<td align="left"></td>
	<td align="left">PageUp</td>
	<td align="left">pageup</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-Shift-Z,Ctrl-Y</td>
	<td align="left">Command-Shift-Z,Command-Y</td>
	<td align="left">redo</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-D</td>
	<td align="left">Command-D</td>
	<td align="left">remove line</td>
	</tr>
	<tr class="row1">
	<td align="left"></td>
	<td align="left">Ctrl-K</td>
	<td align="left">remove to line end</td>
	</tr>
	<tr class="row2">
	<td align="left"></td>
	<td align="left">Option-Backspace</td>
	<td align="left">remove to linestart</td>
	</tr>
	<tr class="row1">
	<td align="left"></td>
	<td align="left">Alt-Backspace,Ctrl-Alt-Backspace</td>
	<td align="left">remove word left</td>
	</tr>
	<tr class="row2">
	<td align="left"></td>
	<td align="left">Alt-Delete</td>
	<td align="left">remove word right</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-R</td>
	<td align="left">Command-Option-F</td>
	<td align="left">replace</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-Shift-R</td>
	<td align="left">Command-Shift-Option-F</td>
	<td align="left">replace all</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-A</td>
	<td align="left">Command-A</td>
	<td align="left">select all</td>
	</tr>
	<tr class="row2">
	<td align="left">Shift-Down</td>
	<td align="left">Shift-Down</td>
	<td align="left">select down</td>
	</tr>
	<tr class="row1">
	<td align="left">Shift-Left</td>
	<td align="left">Shift-Left</td>
	<td align="left">select left</td>
	</tr>
	<tr class="row2">
	<td align="left">Shift-End</td>
	<td align="left">Shift-End</td>
	<td align="left">select line end</td>
	</tr>
	<tr class="row1">
	<td align="left">Shift-Home</td>
	<td align="left">Shift-Home</td>
	<td align="left">select line start</td>
	</tr>
	<tr class="row2">
	<td align="left">Shift-PageDown</td>
	<td align="left">Shift-PageDown</td>
	<td align="left">select page down</td>
	</tr>
	<tr class="row1">
	<td align="left">Shift-PageUp</td>
	<td align="left">Shift-PageUp</td>
	<td align="left">select page up</td>
	</tr>
	<tr class="row2">
	<td align="left">Shift-Right</td>
	<td align="left">Shift-Right</td>
	<td align="left">select right</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-Shift-End,Alt-Shift-Down</td>
	<td align="left">Command-Shift-Down</td>
	<td align="left">select to end</td>
	</tr>
	<tr class="row2">
	<td align="left">Alt-Shift-Right</td>
	<td align="left">Command-Shift-Right</td>
	<td align="left">select to line end</td>
	</tr>
	<tr class="row1">
	<td align="left">Alt-Shift-Left</td>
	<td align="left">Command-Shift-Left</td>
	<td align="left">select to line start</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-Shift-Home,Alt-Shift-Up</td>
	<td align="left">Command-Shift-Up</td>
	<td align="left">select to start</td>
	</tr>
	<tr class="row1">
	<td align="left">Shift-Up</td>
	<td align="left">Shift-Up</td>
	<td align="left">select up</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-Shift-Left</td>
	<td align="left">Option-Shift-Left</td>
	<td align="left">select word left</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-Shift-Right</td>
	<td align="left">Option-Shift-Right</td>
	<td align="left">select word right</td>
	</tr>
	<tr class="row2">
	<td align="left"></td>
	<td align="left">Ctrl-O</td>
	<td align="left">split line</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-7</td>
	<td align="left">Command-7</td>
	<td align="left">toggle comment</td>
	</tr>
	<tr class="row2">
	<td align="left">Ctrl-T</td>
	<td align="left">Ctrl-T</td>
	<td align="left">transpose letters</td>
	</tr>
	<tr class="row1">
	<td align="left">Ctrl-Z</td>
	<td align="left">Command-Z</td>
	<td align="left">undo</td>
	</tr>
	</tbody>
	</table>


{tab_start name='modes_themes'}

	<style>
	ul.ace_list {
		float: left;
		padding: 0 20px 20px 0;
	}
		ul.ace_list li {
		width: 150px;
	}
	</style>

	<h3>Available Modes</h3>

	{$count = 0}
	<ul class="ace_list">
		{foreach $modes_list as $k => $v}
			{if $count == '10'}
				</ul>
				<ul class="ace_list">
				{$count = 0}
			{/if}
			<li>{$k}</li>
			{$count = $count + 1}
		{/foreach}
	</ul>

	<div class="clear"></div>

	<h3>Available Themes</h3>

	{$count = 0}
	<ul class="ace_list">
		{foreach $themes_list as $k => $v}
			{if $count == '10'}
				</ul>
				<ul class="ace_list">
				{$count = 0}
			{/if}
			<li>{$k}</li>
			{$count = $count + 1}
		{/foreach}
	</ul>

	<div class="clear"></div>


{tab_start name='troubleshooting'}

	<h3>Known Issues</h3>
	<ul>
		<li>Full screen feature, when using escape key to close you need to click twice...</li>
	</ul>


{tab_start name='copyright'}

	<p>This module is a fork of the AceEditor module.<br />
		Copyright &copy; 2013 - 2019, Goran Ilic (uniqu3).</p>
	<br />

	<p><b>AceSyntax module</b><br />
		Copyright &copy; 2019. All Rights Are Reserved.<br />
		Fernando Morgado [jomorg at sm-art-lab dot com].<br />
		Rolf Tjassens [info at cmscanbesimple dot org].</p>
	<br />

	<p>This module has been released under the <b><a href="http://www.gnu.org/licenses/licenses.html#GPL" rel="noopener noreferrer" target="_blank">GNU Public License v3</a></b>.</p>

	<p><b>However</b>, as a special exception to the GPL, this software is distributed as an addon module to CMS Made Simple&trade;.<br />
		You may only use this software when there is a clear and obvious indication in the admin section that the site was built with <b>CMS Made Simple&trade;</b>.</p>

{tab_end}

{/strip}