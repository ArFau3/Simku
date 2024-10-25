@props(['value'])

<td {{ $attributes->merge(['class' => 'py-1 px-2 text-sm leading-tight border-y-4 border-double text-black']) }}>
    @if ($value >= 0)
        {{ Number::currency($value, 'IDR', 'id') }}
    @else
        {{ '(' . Number::currency($value * -1, 'IDR', 'id') . ')' }}
    @endif
</td>
