<div class="pageshowrows">
  {if $pagenumber > 1}

    <a href="javascript:void(0)" onclick="on_pagination_click('first', 1)">&lt;&lt;</a>
    <a href="javascript:void(0)" onclick="on_pagination_click('previous', {$pagenumber - 1})">&lt;</a>
  {/if}
  {$pagenumber}&nbsp;{$oftext}&nbsp;{$pagecount}
  {if $pagenumber < $pagecount}

    <a href="javascript:void(0)" onclick="on_pagination_click('previous', {$pagenumber + 1})">&gt;</a>
    <a href="javascript:void(0)" onclick="on_pagination_click('last', {$pagecount})">&gt;&gt;</a>
  {/if}
</div>

{if !empty($items)}
  <table id="sortable_item" data-filter="#item_search" cellspacing="0" class="pagetable {$themeObject->themeName}">
    <thead>
      <tr class="top">
        <th data-toggle="true">{$title}</th>
        {if isset($items.0->alias)}<th data-hide="phone,tablet">{$mod->ModLang('alias')}</th>{/if}

        {foreach from=$items.0->fielddefs item=fielddef}
          <th data-hide="phone.tablet">{$fielddef.name}</th>
        {/foreach}
        {if isset($items.0->create_time)}<th data-hide="phone,tablet" data-type="numeric">{$mod->ModLang('create_time')}</th>{/if}
        {if isset($items.0->modified_time)}<th data-hide="phone,tablet" data-type="numeric">{$mod->ModLang('modified_time')}</th>{/if}
        {if isset($items.0->start_time)}<th data-hide="phone,tablet" data-type="numeric">{$mod->ModLang('start_time')}</th>{/if}
        {if isset($items.0->end_time)}<th data-hide="phone,tablet" data-type="numeric">{$mod->ModLang('end_time')}</th>{/if}
        {if isset($items.0->approve)}<th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon"><span class="lise-hidden">{$mod->ModLang('toggle_status')}</span>&nbsp;</th>{/if}
        <th data-ignore="highlight" data-hide="phone,tablet" data-sort-ignore="true" data-class="hide-heading" class="pageicon"><span class="lise-hidden">{$mod->ModLang('copy')}</span>&nbsp;</th>
        <th data-ignore="highlight" data-hide="phone,tablet" data-sort-ignore="true" data-class="hide-heading" class="pageicon"><span class="lise-hidden">{$mod->ModLang('edit')}</span>&nbsp;</th>
        {if isset($items.0->delete)}<th data-ignore="highlight" data-hide="phone,tablet" data-class="hide-heading" data-sort-ignore="true" class="pageicon"><span class="lise-hidden">{$mod->ModLang('delete')}</span>&nbsp;</th>{/if}
        <th data-ignore="highlight" data-hide="phone,tablet" data-sort-ignore="true" data-class="hide-heading"title="{$mod->ModLang('select_all')}" class="pageicon no-sort"><span class="lise-hidden">{$mod->ModLang('select_item')}</span><input id="check_all_item" type="checkbox" /></th>
      </tr>
    </thead>
    <tbody class="content" width="100%">
      {foreach from=$items item=entry}
        {cycle values="row1,row2" assign='rowclass'}
        <tr id="item_{$entry->item_id}" class="{$rowclass}" style="cursor: move;">
          <td>{$entry->title}</td>
          {if isset($items.0->alias)}<td>{$entry->alias}</td>{/if}
          {foreach from=$entry->fielddefs item=fielddef}
            {if 'SelectDateTime' == $fielddef->GetType()}
              <td data-value="{$fielddef->GetOptionValue('unix_datetime_stamp')}">{$fielddef->RenderForAdminListing($actionid, $returnid)}</td>
            {else}
              <td>{$fielddef->RenderForAdminListing($actionid, $returnid)}</td>
            {/if}
          {/foreach}
          {if isset($items.0->create_time)}<td data-value="{$entry->create_time|cms_date_format}">{$entry->create_time}</td>{/if}
          {if isset($items.0->modified_time)}<td data-value="{$entry->modified_time|cms_date_format}">{$entry->modified_time}</td>{/if}
          {if isset($items.0->start_time)}<td data-value="{$entry->start_time|cms_date_format}">{$entry->start_time}</td>{/if}
          {if isset($items.0->end_time)}<td data-value="{$entry->end_time|cms_date_format}">{$entry->end_time}</td>{/if}
          {if isset($entry->approve)}<td class="init-ajax-toggle approve-item">{$entry->approve}</td>{/if}
          <td>{$entry->copylink}</td>
          <td>{$entry->editlink}</td>
          {if isset($entry->delete)}<td class="init-ajax-delete">{$entry->delete}</td>{/if}
          <td class="item-mass-action">{$entry->select}</td>
        </tr>
      {/foreach}
    </tbody>
  </table>
{else}
  <div class="pageoverflow"><div class="pagetext">Your query returned no results</div></div>
{/if}

<div class="pageshowrows">
  {if $pagenumber > 1}

    <a href="javascript:void(0)" onclick="on_pagination_click('first', 1)">&lt;&lt;</a>
    <a href="javascript:void(0)" onclick="on_pagination_click('previous', {$pagenumber - 1})">&lt;</a>
  {/if}
  {$pagenumber}&nbsp;{$oftext}&nbsp;{$pagecount}
  {if $pagenumber < $pagecount}

    <a href="javascript:void(0)" onclick="on_pagination_click('previous', {$pagenumber + 1})">&gt;</a>
    <a href="javascript:void(0)" onclick="on_pagination_click('last', {$pagecount})">&gt;&gt;</a>
  {/if}
</div>
