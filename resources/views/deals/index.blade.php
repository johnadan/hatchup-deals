<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 h-screen">
        {{-- <div class="row-span-2 bg-black lg:w-20rem"> --}}
        <div class="row-span-2 bg-black">
            <x-sidebar></x-sidebar>
        </div>
        {{-- <div class="md:col-span-2 p-4 min-h-screen"> --}}
        <div class="md:col-span-2 p-4">
            @if (session()->has('success'))
                <x-success-alert></x-success-alert>
            @endif

            @if (session()->has('error'))
                <x-error-alert></x-error-alert>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-between items-center p-4">
                <a href="{{ route('categories.businesses') }}">
                    <h1 class="font-bold text-xl">Back</h1>
                </a>
                <h1 class="text-xl">Deals in <strong>{{ $category->name }}</strong></h1>
            </div>
            {{-- && $deals->currentPage() > 1 --}}
            {{-- <div class="container mx-auto p-4 sm:p-6 lg:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                    @if(!empty($deals)  && $deals->count() > 0 )
                        @foreach ($deals as $deal)
                    <div class="cards-container">
                        <div class="card">
                            <a href="{{ route('deals.show', $deal) }}" class="group relative block bg-black rounded-lg">
                                <img
                                alt=""
                                src="{{ asset('storage/' . $deal->image) }}"
                                class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50"
                                />
                                <div class="relative p-4 sm:p-6 lg:p-8">
                                <p class="text-sm font-medium uppercase tracking-widest text-pink-500">{{ $deal->title }}</p>
                                <p class="text-xl font-bold text-white sm:text-2xl">{{ $deal->title }}</p>
                                <div class="mt-32 sm:mt-48 lg:mt-64">
                                    <div>
                                        <p class="text-sm text-white">
                                            {{ $deal->description }}
                                        </p>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                    </div>
                        @endforeach
                    @else
                    <p>No deals found.</p>
                    @endif --}}
                    <!-- Cards container -->
                    {{-- <div x-data="{ searchQuery: '', cards: [
                        { title: 'Tony Wayne', content: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis perferendis hic asperiores quibusdam quidem voluptates doloremque reiciendis nostrum harum. Repudiandae?' },
                        { title: 'Tony Wayne', content: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis perferendis hic asperiores quibusdam quidem voluptates doloremque reiciendis nostrum harum. Repudiandae?' },
                        { title: 'Tony Wayne', content: 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis perferendis hic asperiores quibusdam quidem voluptates doloremque reiciendis nostrum harum. Repudiandae?' },
                        { title: 'Tony Wayne', content: 'hoy' },
                    ]}" class="cards-container">
                        <template x-for="card in cards" :key="card.title">
                            <div class="card" x-show="card.title.toLowerCase().includes(searchQuery.toLowerCase()) || card.content.toLowerCase().includes(searchQuery.toLowerCase())">
                                <a href="#" class="group relative block bg-black rounded-lg">
                                <img
                                alt=""
                                src="https://images.unsplash.com/photo-1603871165848-0aa92c869fa1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=772&q=80"
                                class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50"
                                />
                                <div class="relative p-4 sm:p-6 lg:p-8">
                                <p class="text-sm font-medium uppercase tracking-widest text-pink-500">Developer</p>
                                <p class="text-xl font-bold text-white sm:text-2xl" x-text="card.title"></p>
                                <div class="mt-32 sm:mt-48 lg:mt-64">
                                    <div
                                    class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100"
                                    >
                                    <p class="text-sm text-white" x-text="card.content"></p>
                                    </div>
                                </div>
                                </div>
                                </a>
                            </div>
                        </template>
                    </div> --}}
                {{-- </div>
            </div> --}}
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @if(!empty($deals)  && $deals->count() > 0 )
                            @foreach($deals as $deal)
                                <a href="{{ route('deals.show', $deal) }}" class="group relative block h-96 overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-shadow">
                                    <!-- Deal Image Background -->
                                    <div
                                        class="absolute inset-0 bg-cover bg-center transition-transform duration-300 group-hover:scale-105"
                                        style="background-image: url('{{ asset('storage/' . $deal->image) }}"
                                    ></div>

                                    <!-- Dark Overlay -->
                                    <div class="absolute inset-0 bg-black/40"></div>

                                    <!-- Content Overlay -->
                                    <div class="relative h-full flex flex-col justify-between p-6">
                                        <!-- Business Logo -->
                                        <div class="flex items-center space-x-3">
                                            <img
                                                src="{{ $deal->business->logo
                                                ? asset('storage/' . $deal->business->logo)
                                                : asset('logo/sample-business-logo.png') }}"
                                                alt="{{ $deal->business->name }} logo"
                                                class="h-10 w-10 rounded-full border-2 border-white"
                                            >
                                            <span class="text-white font-semibold">{{ $deal->business->name }}</span>
                                        </div>

                                        <!-- Deal Info -->
                                        <div class="text-white">
                                            <h3 class="text-2xl font-bold mb-2">{{ $deal->title }}</h3>
                                            <p class="text-gray-200 line-clamp-3">
                                                {{ $deal->description }}
                                            </p>
                                        </div>

                                        <!-- Remaining Claims -->
                                        <div class="bg-white/10 backdrop-blur-sm rounded-lg p-3">
                                            <p class="text-white text-sm font-medium">
                                                {{ $deal->max_usage_limit - $deal->current_usage_count }} claims remaining
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                        <p>No deals found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get the search input element
        const searchInput = document.getElementById('search-input');

        // Get the cards container element
        const cardsContainer = document.querySelector('.cards-container');

        // Get all the card elements
        const cards = document.querySelectorAll('.card');

        // Add an event listener to the search input element
        searchInput.addEventListener('input', () => {
            // Get the search query
            const searchQuery = searchInput.value.toLowerCase();

            // Initialize a flag to track if any matches are found
            let matchesFound = false;

            // Loop through each card
            cards.forEach((card) => {
                // Get the card's text content
                const cardText = card.textContent.toLowerCase();

                // Check if the card's text content contains the search query
                if (cardText.includes(searchQuery)) {
                    // Show the card
                    card.style.display = 'block';
                    matchesFound = true;
                } else {
                    // Hide the card
                    card.style.display = 'none';
                }
            });

            // Check if any matches were found
            if (!matchesFound && searchQuery !== '') {
                // Display a "No matches found" message
                const noMatchesMessage = document.createElement('p');
                noMatchesMessage.textContent = 'No matches found';
                noMatchesMessage.style.color = 'red';
                cardsContainer.appendChild(noMatchesMessage);
            } else {
                // Remove any existing "No matches found" message
                const existingMessage = cardsContainer.querySelector('p');
                if (existingMessage) {
                    existingMessage.remove();
                }
            }
        });
    </script>
</x-app-layout>
