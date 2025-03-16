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
            {{-- <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex">
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $deal->title }}</div>
                        <img
                            alt="{{ $deal->title }}"
                            src="{{ asset('storage/' . $deal->image) }}"
                        />
                        <p class="mt-2 text-orange-500"><strong>{{ $deal->max_usage_limit - $deal->current_usage_count }} claim(s) available</strong></p>
                        <p class="mt-2 text-gray-500">{{ $deal->description }}</p>
                        <p class="mt-2 text-gray-500">Price: <del>{{ $deal->original_price }}</del> <strong>{{ $deal->discounted_price }}</strong></p>
                        <p class="mt-2 text-gray-500">Valid Until {{ $deal->end_date->format('F d, Y') }}</p>
                        <button class="mt-4 bg-orange-500 text-white hover:bg-white hover:text-orange-500 font-bold py-2 px-4 rounded-lg">
                            Claim Coupon
                        </button>
                    </div>
                </div>
            </div> --}}
            {{-- <button class="mt-4 bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg"> --}}
            {{-- <button class="mt-4 bg-orange-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg"> --}}
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
                        <!-- Left Column - Image -->
                        <div class="md:w-1/2">
                            <img
                                src="{{ asset('storage/' . $deal->image) }}"
                                alt="{{ $deal->title }}"
                                class="w-full h-full object-cover"
                            >
                        </div>

                        <!-- Right Column - Details -->
                        <div class="p-8 md:w-1/2 space-y-6">
                            <!-- Business Header -->
                            <div class="flex items-center space-x-4">
                                <img
                                    src="{{ $deal->business->logo
                                    ? asset('storage/' . $deal->business->logo)
                                    : asset('logo/sample-business-logo.png') }}"
                                    alt="{{ $deal->business->name }} logo"
                                    class="h-14 w-14 rounded-full border-2 border-gray-200"
                                >
                                <div>
                                    <p class="text-gray-500 text-sm">Offered by</p>
                                    <h3 class="text-xl font-bold">{{ $deal->business->name }}</h3>
                                </div>
                            </div>

                            <!-- Deal Info -->
                            <div class="space-y-4">
                                <h1 class="text-3xl font-bold">{{ $deal->title }}</h1>

                                <div class="flex items-center space-x-4 text-sm">
                                    <div class="bg-green-100 px-3 py-1 rounded-full">
                                        {{ $deal->remaining_claims }} claim(s) remaining
                                    </div>
                                    <div class="text-gray-500">
                                        Valid until {{ $deal->end_date->format('M j, Y') }}
                                    </div>
                                </div>

                                <p class="text-gray-700 leading-relaxed">
                                    {{ $deal->description }}
                                </p>

                                <!-- Pricing -->
                                <div class="space-y-2">
                                    @if($deal->type === 'paid')
                                    <div class="flex items-baseline space-x-3">
                                        <span class="text-2xl font-bold text-gray-900">
                                            ${{ number_format($deal->discounted_price, 2) }}
                                        </span>
                                        <span class="text-gray-500 line-through">
                                            ${{ number_format($deal->original_price, 2) }}
                                        </span>
                                    </div>
                                    @else
                                    <span class="text-2xl font-bold text-green-600">FREE</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-4">
                                @if($deal->remaining_claims > 0)
                                {{-- <form action="{{ route('deals.claim', $deal) }}" method="POST"> --}}
                                    @csrf
                                    <button
                                        type="submit"
                                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors"
                                    >
                                        Claim This Deal
                                    </button>
                                {{-- </form> --}}
                                @else
                                <div class="bg-gray-100 text-gray-500 p-4 rounded-lg text-center">
                                    This deal has expired
                                </div>
                                @endif

                                <a
                                    {{-- href="{{ route('businesses.deals', $deal->business->id) }}') }}" --}}
                                    href="{{ route('businesses.deals', $business) }}') }}"
                                    class="inline-block w-full text-center text-blue-600 hover:text-blue-800"
                                >
                                    ← See More Deals
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

