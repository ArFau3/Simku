@props(['value'])

<td {{ $attributes->merge(['class' => 'py-1 px-2 text-sm leading-tight border-y-4 border-double text-black']) }}>
    {{ $value }}
</td>
