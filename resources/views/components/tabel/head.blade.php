@props(['value'])

<th
    {{ $attributes->merge(['class' => 'px-4 sm:px-6  py-2 text-xs font-bold leading-tight tracking-wider text-left text-gray-900 uppercase border-b border-gray-200']) }}>
    {{ $value }}
</th>
