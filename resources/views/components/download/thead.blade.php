@props(['value'])

<th
    {{ $attributes->merge(['class' => 'px-4 py-1 text-xs border-y-4 border-double leading-tiny font-bold text-center text-black uppercase']) }}>
    {{ $value }}
</th>
