@props(['value', 'cols' => '1', 'rows' => '1'])

<td
    {{ $attributes->merge(['class' => 'py-1 px-2 text-sm leading-tight text-black', 'colspan' => $cols, 'rowspan' => $rows]) }}>
    @if ($value >= 0)
        {{ Number::currency($value, 'IDR', 'id') }}
    @else
        {{ '(' . Number::currency($value * -1, 'IDR', 'id') . ')' }}
    @endif
</td>
