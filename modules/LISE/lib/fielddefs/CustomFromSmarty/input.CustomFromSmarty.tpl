{$source = $fielddef->GetOptionValue('source_template')}
{$type = $fielddef->GetOptionValue('type')}
{$sel = $fielddef->GetValue()}
{include
	file="string:$source"
	actionid=$actionid
	sel = $sel
	name = "{$actionid}customfield[{$fielddef->GetId()}]"
	assign = rendered}
<div class="pageoverflow">
	<p class="pagetext">{$fielddef->GetName()}{if $fielddef->IsRequired()}*{/if}:</p>
	<p class="pageinput">
		{if $fielddef->GetDesc()}({$fielddef->GetDesc()})<br />{/if}
    
    {if !empty($source)}
      {if $type == 'Dropdown'}
		    <select name="{$actionid}customfield[{$fielddef->GetId()}]">
					{$rendered}
		    </select>
      {elseif $type == 'MultiSelect'}
        <select name="{$actionid}customfield[{$fielddef->GetId()}][]}" size="{$opts|count}" multiple>
					{$rendered}
        </select>      
      {elseif $type == 'RadioGroup'}
				{$rendered}
      {elseif $type == 'CheckboxGroup'}
				{$rendered}
      {/if}
    {/if}
	</p>
</div>