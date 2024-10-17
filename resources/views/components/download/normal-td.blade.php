@props(['value'])

<td {{ $attributes->merge(['class' => 'py-1 px-2 text-sm leading-tight text-black']) }}>
    {{ $value }}
</td>
