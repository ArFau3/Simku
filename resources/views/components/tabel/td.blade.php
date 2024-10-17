@props(['value', 'cols' => '1'])

<th
    {{ $attributes->merge(['class' => 'text-left font-medium py-2 px-4 sm:px-6  text-sm leading-tight text-gray-900 whitespace-no-wrap border-b border-gray-200', 'cols' => $cols]) }}>
    {{ $value }}
</th>
