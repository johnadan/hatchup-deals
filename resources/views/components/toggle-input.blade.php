{{-- <div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input type="checkbox" {{ $attributes->merge(['class' => 'appearance-none w-4 h-4 border border-gray-300 rounded-md checked:bg-indigo-500 checked:border-indigo-500 focus:outline-none focus:ring-0']) }}>
    <span {{ $attributes->merge(['class' => 'ml-2']) }}>
        {{ $slot }}
    </span>
</div> --}}
{{-- <div {{ $attributes->merge(['class' => 'flex items-center']) }}> --}}
    <!-- Hidden input to ensure a value is always submitted -->
    {{-- <input type="hidden" name="{{ $attributes->get('name') }}" value="0"> --}}
    <!-- Checkbox input -->
    {{-- <input
        type="checkbox"
        id="{{ $attributes->get('id') }}"
        name="{{ $attributes->get('name') }}"
        value="1"
        {{ $attributes->merge(['class' => 'appearance-none w-4 h-4 border border-gray-300 rounded-md checked:bg-indigo-500 checked:border-indigo-500 focus:outline-none focus:ring-0']) }}
        {{ old($attributes->get('name'), $attributes->get('value')) ? 'checked' : '' }}
    >
    <span {{ $attributes->merge(['class' => 'ml-2']) }}>
        {{ $slot }}
    </span>
</div> --}}
@props(['checked' => false])

<label class="flex items-center space-x-2">
    <input
        type="checkbox"
        {{ $attributes->merge(['class' => 'rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500']) }}
        @if($checked) checked @endif
    >
    <span class="text-sm text-gray-600">{{ $slot }}</span>
</label>
