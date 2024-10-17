@props(['value'])

<td
    {{ $attributes->merge(['class' => 'font-medium px-4 sm:px-6 py-2 border-y-2 border-zinc-500 text-sm leading-tight text-gray-900 whitespace-no-wrap']) }}>
    @if ($value >= 0)
        {{ Number::currency($value, 'IDR', 'id') }}
    @else
        {{ '(' . Number::currency($value * -1, 'IDR', 'id') . ')' }}
    @endif
</td>
