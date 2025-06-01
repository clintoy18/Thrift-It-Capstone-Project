@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-[#636363] dark:text-[#636363] ']) }}>
    {{ $value ?? $slot }}
</label>
