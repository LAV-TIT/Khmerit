{if !is_array($value)}{$value = [$value]}{/if}
{LISELoader
  instance = $fielddef->GetOptionValue('instance')
  item = 'item'
  identifier = $fielddef->GetOptionValue('identifier')
  force_array=1
  value=implode(',', $value)
  assign='items'}
{$tmp = []}
{foreach $items as $item}
    {$tmp[] = $item->title|truncate:10:'...':true:false}
{/foreach}
{$c = count($tmp)}{$out = implode(', ', $tmp)}
({$c}): {$out|truncate:50:'...':true:false}