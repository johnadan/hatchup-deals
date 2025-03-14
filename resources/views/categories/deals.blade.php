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
            @if (session()->has('success'))
            <x-success-alert></x-success-alert>
            @endif

            @if (session()->has('error'))
                <x-error-alert></x-error-alert>
            @endif

            <div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-between items-center p-4">
                    <h1 class="font-bold text-xl">Categories</h1>
                    <label class="input input-bordered flex items-center gap-2">
                        <input type="text" class="grow border-gray-100" placeholder="Search Deals" />
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
                    </label>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                        @foreach ($categories as $category)
                        <a href="{{ route('deals.by_category', $category) }}">
                            <button class="p-6 border border-gray-200 rounded w-80 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100">
                                <div class="flex justify-center items-center text-gray-500 mr-4">
                                    @if($category->name == 'Food and Beverages')
                                    <i class="fa-lg fa-solid fa-utensils"></i>
                                    @elseif($category->name == 'Health and Fitness')
                                    <i class="fa-lg fa-solid fa-heart-circle-plus"></i>
                                    @elseif($category->name == 'Professional Services')
                                    <i class="fa-lg fa-solid fa-briefcase"></i>
                                    @elseif($category->name == 'Beauty and Personal Care')
                                    <i class="fa-lg fa-solid fa-hand-holding-heart"></i>
                                    @elseif($category->name == 'Leisure and Entertainment')
                                    <i class="fa-lg fa-solid fa-icons"></i>
                                    @elseif($category->name == 'Home and Household')
                                    <i class="fa-lg fa-solid fa-house"></i>
                                    @elseif($category->name == 'Apparel and Accessories')
                                    <i class="fa-lg fa-solid fa-tshirt"></i>
                                    @elseif($category->name == 'Finance and Banking')
                                    <i class="fa-lg fa-solid fa-money-check-alt"></i>
                                    @endif
                                </div>
                                <ul class="text-left">
                                    <li>
                                        <h1 class="font-bold text-gray-700 text-sm">{{ $category->name }}</h1>
                                    </li>
                                    <li>
                                        <h6 class="text-gray-900 text-sm">
                                            {{ $category->active_deals_count }}
                                            @if($category->active_deals_count > 1)
                                            deals
                                            @else
                                            deal
                                            @endif
                                        </h6>
                                    </li>
                                </ul>
                            </button>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
