<div role="alert" class="rounded-xl border border-red-100 bg-red-50 p-4" x-data="{ show: true }" x-show="show">
    <div class="flex items-start gap-4">
        <span class="text-red-600">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                />
            </svg>
        </span>

        <div class="flex-1">
            <strong class="block font-medium text-gray-900">{{ session()->get('error') }}</strong>

            <p class="mt-1 text-sm text-gray-700">An error occurred while processing your request.</p>
        </div>

        <button class="text-gray-500 transition hover:text-gray-600" @click="show = false">
            <span class="sr-only">Dismiss popup</span>

            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-6"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
{{-- <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
    {{ $message }}
</div> --}}
