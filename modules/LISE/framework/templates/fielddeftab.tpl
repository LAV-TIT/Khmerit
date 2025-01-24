{if count($items) > 0}
  <div class="pageoptions">{$addlink}</div>
  <table id="sortable_fielddef" cellspacing="0" class="pagetable">
    <thead>
        <tr>
            <th>{$mod->ModLang('fielddef')}</th>
            <th>{$mod->ModLang('alias')}</th>
            <th>{$mod->ModLang('fielddef_type')}</th>
            <th>{$mod->ModLang('required')}</th>
            <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon">&nbsp;</th>
            <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon">&nbsp;</th>
            <th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" title="{$mod->ModLang('select_all')}" class="pageicon"><input id="check_all_fielddef" type="checkbox" /></th>
        </tr>
    </thead>
    <tbody class="content">
      {foreach from=$items item='fielddef'}
          {cycle values="row1,row2" assign='rowclass'}
        <tr id="fielddef_{$fielddef->GetId()}" class="{$rowclass}" style="cursor: move;">
                  <td>{$fielddef->GetName()}</td>
                  <td>{$fielddef->GetAlias()}</td>
                  <td>{$fielddef->GetFriendlyType()}</td>
                  <td class="init-ajax-toggle">{$fielddef->GetRequired()}</td>
                  <td>{$fielddef->editlink}</td>
                  <td class="init-ajax-delete">{$fielddef->deletelink}</td>
                  <td class="fielddef-mass-action">{$fielddef->select}</td>
              </tr>
      {/foreach}
    </tbody>
  </table>
  <div class="pageoptions" style="float:right;">
    <select id="lise_fielddef_mass_action">
      <option value="">{$mod->ModLang('select_one')}</option>
      <option value="delete">Delete</option>
      <option value="require">Toggle require</option>
    </select>
  </div>
  <div class="pageoptions" style="float:right;">{$submitorder}</div>
{/if}

<div class="pageoptions">{$addlink}</div>