{*
if using a UDT  to handle the RenderForAdminListing output the returned value will be in {$value}
otherwise the usual {$fielddef->GetValue()} holds the return value
*}
{$type = $fielddef->GetOptionValue('type', 'Dropdown')}
{if $type == 'Dropdown'}
  {$value|default:$fielddef->GetValue()}
{else}
  {$value = $value|default:$fielddef->GetValue('array')}
  {implode(', ', $value)}
{/if}
