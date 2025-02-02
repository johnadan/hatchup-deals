<div {{ $attributes->merge(['class' => 'flex items-center']) }}>
    <input type="checkbox" {{ $attributes->merge(['class' => 'appearance-none w-4 h-4 border border-gray-300 rounded-md checked:bg-indigo-500 checked:border-indigo-500 focus:outline-none focus:ring-0']) }}>
    <span {{ $attributes->merge(['class' => 'ml-2']) }}>
        {{ $slot }}
    </span>
</div>
