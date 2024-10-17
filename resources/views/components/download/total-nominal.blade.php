@props(['value', 'cols'])

<td
    {{ $attributes->merge(['class' => 'py-1 px-2 text-sm font-bold text-center border-y-4 border-double leading-tight text-black', 'colspan' => $cols]) }}>
    {{ $value }}
</td>
