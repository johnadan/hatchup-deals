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
                {{-- <label class="input input-bordered flex items-center gap-2">
                    <input type="text" class="grow border-gray-100" placeholder="Search Businesses" id="search-input" x-model="searchQuery"/>
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 16 16"
                    fill="currentColor"
                    class="h-4 w-4 opacity-70">
                    <path
                        fill-rule="evenodd"
                        d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                        clip-rule="evenodd" />
                    </svg>
                </label> --}}
                <h1 class="text-xl">Businesses in <strong>{{ $category->name }}</strong></h1>
            </div>
            <div class="container mx-auto p-4 sm:p-6 lg:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
                    {{-- && $businesses->currentPage() > 1 --}}
                    @if(!empty($businesses)  && $businesses->count() > 0 )
                        @foreach ($businesses as $business)
                    <div class="cards-container">
                        <div class="card">
                            <a href="{{ route('businesses.show', $business) }}" class="group relative block bg-black rounded-lg">
                                <img
                                alt=""
                                src="https://images.unsplash.com/photo-1603871165848-0aa92c869fa1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=772&q=80"
                                class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50"
                                />
                                <div class="relative p-4 sm:p-6 lg:p-8">
                                <p class="text-sm font-medium uppercase tracking-widest text-pink-500">{{ $business->name }}</p>
                                <p class="text-xl font-bold text-white sm:text-2xl">UNA Pizza + Wine</p>
                                <div class="mt-32 sm:mt-48 lg:mt-64">
                                    <div>
                                        <p class="text-sm text-white">
                                            Insert bio here: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis perferendis hic asperiores
                                            quibusdam quidem voluptates doloremque reiciendis nostrum harum. Repudiandae?
                                        </p>
                                    </div>
                                </div>
                                </div>
                            </a>
                        </div>
                    </div>
                        @endforeach
                    @else
                    <p>No businesses found.</p>
                    @endif
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
