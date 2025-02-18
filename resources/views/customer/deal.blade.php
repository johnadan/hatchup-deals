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
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Gift $100, Get $20</div>
                        <p class="mt-2 text-gray-500">This is a description of the deal.</p>
                        <div class="mt-4">
                            <span class="text-gray-900 font-bold">$19.99</span>
                            <span class="ml-2 text-gray-600 line-through">$29.99</span>
                        </div>
                        <form action="{{ route('deals.purchase') }}" method="POST">
                            @csrf
                            <input type="hidden" name="deal_id" value="{{ $deal->id }}">
                            <!-- <button type="submit" class="btn btn-primary">Purchase Deal</button> -->
                            <button type="submit" class="mt-4 px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">Claim Coupon</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="Deal QR Code"> -->
</x-app-layout>

