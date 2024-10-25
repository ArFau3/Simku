@props(['value', 'cols' => '1', 'rows' => '1'])

<td
    {{ $attributes->merge(['class' => 'py-1 px-2 text-sm leading-tight text-black', 'colspan' => $cols, 'rowspan' => $rows]) }}>
    {{ $value }}
</td>
