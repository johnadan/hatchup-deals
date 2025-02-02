{{-- <div {{ $attributes->merge(['class' => 'flex flex-col items-center']) }}>
    <input type="file" accept="image/*" {{ $attributes->merge(['class' => 'hidden']) }}>
    <label {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
        <span {{ $attributes->merge(['class' => 'text-gray-600']) }}>
            {{ $slot }}
        </span>
        <img src="{{ $attributes->get('preview') ?? '' }}" {{ $attributes->merge(['class' => 'w-32 h-32 object-cover rounded-md mt-2']) }}>
    </label>
</div> --}}
<input type="file" accept="image/*" {{ $attributes->merge(['class' => 'file-input file-input-bordered w-full max-w-xs']) }}>
