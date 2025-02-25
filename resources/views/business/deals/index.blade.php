<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 h-screen">
        <div class="row-span-2 bg-black">
            <x-sidebar></x-sidebar>
        </div>
        <div class="md:col-span-2 p-4">
            <div class="container">
                @if (session()->has('success'))
                    <x-success-alert></x-success-alert>
                @endif

                @if (session()->has('error'))
                    <x-error-alert></x-error-alert>
                @endif
                <h1>Deals</h1>
                <a href="{{ route('business.deals.create') }}" class="btn btn-primary mb-3">Create New Deal</a>
                <div class="row">
                    @if(!($deals->isEmpty()))
                    @foreach ($deals as $deal)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if ($deal->image)
                            <img src="{{ asset('storage/' . $deal->image) }}" class="card-img-top" alt="{{ $deal->title }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $deal->title }}</h5>
                                <p class="card-text">{{ $deal->description }}</p>
                                <p class="card-text"><strong>Category:</strong> {{ $deal->category->name }}</p>
                                <p class="card-text"><strong>Original Price:</strong> ${{ $deal->original_price }}</p>
                                <p class="card-text"><strong>Discounted Price:</strong> ${{ $deal->discounted_price }}</p>
                                <p class="card-text"><strong>Valid Until:</strong> {{ $deal->end_date }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>No deals found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
