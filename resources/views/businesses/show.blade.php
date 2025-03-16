<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (session()->has('success'))
        <x-success-alert></x-success-alert>
    @endif

    @if (session()->has('error'))
        <x-error-alert></x-error-alert>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 h-screen">
        <div class="row-span-2 bg-black">
            <x-sidebar></x-sidebar>
        </div>
        <div class="md:col-span-2 p-4">
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $business->name }}</div>
                        <p class="mt-2 text-gray-500">{{ $business->address }}</p>
                        <p class="mt-2 text-gray-500">{{ $business->phone_number }}</p>
                        <a href="{{ route('businesses.deals', $business) }}">
                            <button class="mt-4 bg-orange-500 text-white hover:bg-white hover:text-orange-500 font-bold py-2 px-4 rounded-lg">
                                View Deals
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

