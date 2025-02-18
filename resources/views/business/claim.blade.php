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
            <form action="{{ route('deals.claim') }}" method="POST">
                @csrf
                <input type="text" name="deal_code" placeholder="Enter Deal Code" required>
                <button type="submit" class="btn btn-primary">Claim Deal</button>
            </form>
        </div>
    </div>
</x-app-layout>
