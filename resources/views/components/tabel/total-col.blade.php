@props(['value', 'cols'])

<td
    {{ $attributes->merge(['class' => 'font-bold text-center border-y-2 border-zinc-500 px-4 sm:px-6 py-2 text-sm leading-tight text-gray-900 whitespace-no-wrap', 'colspan' => $cols]) }}>
    {{ $value }}
</td>
