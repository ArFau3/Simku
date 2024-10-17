@props(['value'])

<th
    {{ $attributes->merge(['class' => 'text-left font-medium py-2 px-4 sm:px-6  text-sm leading-tight text-gray-900 whitespace-no-wrap border-b border-gray-200']) }}>
    @if ($value >= 0)
        {{ Number::currency($value, 'IDR', 'id') }}
    @else
        {{ '(' . Number::currency($value * -1, 'IDR', 'id') . ')' }}
    @endif
</th>
