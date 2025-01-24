{if count($modules) > 0}
	{$modes = [
	0 => $mod->ModLang('mode_list'),
	1 => $mod->ModLang('mode_local'),
	2 => $mod->ModLang('mode_global')
	]}

<div class="pagewarning">
	<h3>{$mod->ModLang('notice')}</h3>
	<p>{$mod->ModLang('installed_instances_warning')}</p>
</div>
<fieldset>
	<legend>{$mod->ModLang('installed_instances')}</legend>
	<table cellspacing="0" class="pagetable">
    	<thead>
        	<tr>
            	<th>{$mod->ModLang('instance_name')}</th>
            	<th>{$mod->ModLang('instance_friendlyname')}</th>
            	<th>{$mod->ModLang('instance_smarty')}</th>
              <th>{$mod->ModLang('instance_version')}</th>
              <th>{$mod->ModLang('instance_mode')}</th>
              <th>{$mod->ModLang('clone_title')}</th>
              <th>{$mod->ModLang('export_title')}</th>
							<th>{$mod->ModLang('save_dna_title')}</th>
            	<th class="pageicon">{$mod->ModLang('instance_uptodate')}</th>
        	</tr>
    	</thead>
    	<tbody>
	{foreach from=$modules item='entry'}
    	    <tr class="{cycle values='row1,row2' name='summary'}">
        	    <td>{$entry->module_name}</td>
        	    <td>{$entry->friendlyname}</td>
        	    <td>{ldelim}{$entry->module_name}{rdelim}</td>
              <td>{$entry->version}</td>
							<td><div class="green">{$modes[$entry->mode]}</div></td>
              <td>{$entry->clonelink}</td>
            	<td>{$entry->exportlink}</td>
            	<td>{$entry->savednalink}</td>
            	<td>{$entry->upgradelink}</td>
        	</tr>
	{/foreach}
    	</tbody>
	</table>
</fieldset>
{/if}
{$startform}
        <p class="pageinput">
				{$duplicate}
		</p>   
{$endform}

{$startuploadform}
<fieldset>
	<legend>{$mod->ModLang('import_instance')}</legend>
	<div class="information">
		<p>{$mod->ModLang('import_instance_info')}</p>
	</div>
	<div class="pageoverflow">
		<p class="pageinput">{$instancenameinput}{$filenameinput}{$upload}</p>
	</div>
</fieldset>
{$enduploadform}