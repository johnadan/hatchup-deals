<style>
    /* .icon-background {
        display: inline-block;
        width: 40px;
        height: 40px; */
        /* background-color: #4CAF50; Green */
        /* border-radius: 50%;
        text-align: center;
        line-height: 40px;
    } */

    /* i {
        position: relative;
    }

    i::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        background-color: #4CAF50; /* Green */
        border-radius: 50%;
        z-index: -1;
    } */
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
            {{-- @if(auth()->user()->role === 'admin')
            {{ __('User Accounts') }}
            @elseif(auth()->user()->role === 'business')
            {{ __('Deals') }}
            @else
            {{ __('Local Businesses') }}
            @endif --}}
        </h2>
    </x-slot>

    @if (session()->has('success'))
        <x-success-alert></x-success-alert>
        {{-- session()->forget('success') --}}
    @endif

    @if (session()->has('error'))
        <x-error-alert></x-error-alert>
        {{-- session()->forget('error') --}}
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 h-screen">
        <div class="row-span-2 bg-black">
            <x-sidebar></x-sidebar>
        </div>
        {{-- <div class="md:col-span-2 p-4 flex flex-col justify-center"> --}}
        {{-- <div class="md:col-span-2 p-4 min-h-screen"> --}}
        <div class="md:col-span-2 p-4">
        {{-- <div class="md:col-span-2 p-4"> --}}
            @if(auth()->user()->role === 'admin')
            <!--
            Heads up! 👋

            This component comes with some `rtl` classes. Please remove them if they are not needed in your project.
            -->
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <div class="mb-4 flex justify-end">
                                <button @click="openModal('create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Create Category
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="table-auto min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                                    <thead class="ltr:text-left rtl:text-right">
                                        <tr>
                                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Full Name</th>
                                            <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Display Name</th>
                                            <!-- <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Role</th> -->
                                            <!-- <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">Salary</th> -->
                                            <th class="px-4 py-2 text-left">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($categories as $category)
                                        <tr>
                                            <td class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">{{ $category->full_name }}</td>
                                            <td class="whitespace-nowrap px-4 py-2 text-gray-700">{{ $category->display_name }}</td>
                                            <!-- <td class="whitespace-nowrap px-4 py-2 text-gray-700">Web Developer</td> -->
                                            <!-- <td class="whitespace-nowrap px-4 py-2 text-gray-700">$120,000</td> -->
                                            <td class="whitespace-nowrap px-4 py-2">
                                                {{-- <a
                                                    href="{{ route('categories.update', $category->id) }}"
                                                    class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
                                                >
                                                    Edit
                                                </a> --}}
                                                {{-- <a
                                                    href="#"
                                                    class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
                                                >
                                                    Delete
                                                </a> --}}
                                                {{-- <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        type="submit"
                                                        class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700"
                                                    >
                                                        Delete
                                                    </button>
                                                </form> --}}
                                                <button @click="openModal('edit', {{ $category->id }})" class="text-blue-500 hover:text-blue-700">Edit</button>
                                                <button @click="openModal('delete', {{ $category->id }})" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                                                {{-- <button @click="showEditModal = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button> --}}
                                                {{-- <button @click="showDeleteModal = true" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button> --}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            <form method="POST" action="{{ route('categories.store') }}">
                                @csrf
                                <!-- categories -->
                                <div class="flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100 dark:bg-gray-900">
                                    <div class="mb-6 w-full sm:max-w-md mt-6 px-6 py-4 dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                                    ADD CATEGORY
                                        <!-- Full Name -->
                                        <div>
                                            <x-input-label for="full_name" :value="__('Full Name')" />
                                            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name')" required autofocus autocomplete="full_name" />
                                            <!-- <x-input-error :messages="$errors->get('full_name')" class="mt-2" /> -->
                                            {{-- @error('full_name')
                                                <div class="text-red-500">{{ $message }}</div>
                                            @enderror --}}
                                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                                        </div>
                                        <!-- Display Name -->
                                        <div>
                                            <x-input-label for="display_name" :value="__('Display Name')" />
                                            <x-text-input id="display_name" class="block mt-1 w-full" type="text" name="display_name" :value="old('display_name')" required autofocus autocomplete="display_name" />
                                            <!-- <x-input-error :messages="$errors->get('display_name')" class="mt-2" /> -->
                                            {{-- @error('display_name')
                                                <div class="text-red-500">{{ $message }}</div>
                                            @enderror--}}
                                            <x-input-error :messages="$errors->get('display_name')" class="mt-2" />
                                        </div>
                                        <!-- Checkbox to Copy Full Name to Display Name -->
                                        {{-- <div>
                                            <x-checkbox id="copy_fullname" type="checkbox" name="copy_fullname" x-model="copy_fullname"/>
                                            <x-input-label for="copy_fullname" :value="__('Copy Full Name to Display Name')" />
                                            <label for="copy_fullname" class="flex cursor-pointer items-start gap-4">
                                                <div class="flex items-center">
                                                    &#8203;
                                                    <input type="checkbox" class="size-4 rounded border-gray-300" id="copy_fullname" name="copy_fullname"/>
                                                </div>

                                                <div>
                                                    <strong class="font-medium text-gray-900"> Copy Full Name to Display Name </strong>
                                                </div>
                                            </label>
                                        </div> --}}
                                        {{-- <div x-data="{ full_name: '', display_name: '', copy_fullname: false }">
                                            <template x-if="copy_fullname">
                                                <input type="hidden" x-model="display_name" :value="full_name">
                                            </template>
                                        </div> --}}
                                        {{-- <div x-data="{ full_name: '', display_name: '', copy_fullname: false }" x-init="display_name = copy_fullname ? full_name : display_name">
                                            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" x-model="full_name" required autofocus autocomplete="full_name" />
                                            <x-text-input id="display_name" class="block mt-1 w-full" type="text" name="display_name" x-model="display_name" required autofocus autocomplete="display_name" />
                                            <x-checkbox id="copy_fullname" name="copy_fullname" x-model="copy_fullname" @click="display_name = copy_fullname ? full_name : display_name" />
                                        </div> --}}
                                        <x-primary-button class="ms-0 mt-3">
                                            {{ __('Save') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @elseif(auth()->user()->role === 'business')
            <!-- deals -->
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            Add Deal
                            {{-- <input type="text" name="business_id" value="{{ auth()->user()->business()->id }}" hidden> --}}
                            {{-- <input type="text" name="category_id" value="{{ auth()->user()->business()->category()->id }}" hidden> --}}
                            <div>
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
                            <div>
                                <x-input-label for="description" :value="__('Description')" />
                                <x-text-area id="description" name="description" class="mt-1 block w-full" :value="old('description')" required autofocus autocomplete="description" wire:model="description" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Type
                                </label>
                                <select id="type" name="type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                    <option value="free">Free</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" name="price" type="number" class="mt-1 block w-full" :value="old('price')" required autofocus autocomplete="price" />
                                <x-input-error class="mt-2" :messages="$errors->get('price')" />
                            </div>
                            <div>
                                <x-input-label for="expiry_date" :value="__('Expiry Date')" />
                                <x-date-input id="expiry_date" name="expiry_date" class="mt-1 block w-full" :value="old('expiry_date')" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('expiry_date')" />
                            </div>
                            <div>
                                <x-toggle-input id="is_featured" name="is_featured" :value="old('is_featured')" required autofocus>
                                    {{ __('Is Featured') }}
                                </x-toggle-input>
                                <x-input-error class="mt-2" :messages="$errors->get('is_featured')" />
                            </div>
                            {{-- <div>
                                <x-image-upload-input id="image" name="image" :value="old('image')" required autofocus>
                                    {{ __('Upload Image') }}
                                </x-image-upload-input>
                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div> --}}
                            <div>
                                <x-image-upload-input id="image" name="image" />
                                {{-- <input type="file" class="file-input file-input-bordered w-full max-w-xs" /> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- browse businesses and deals -->
            {{-- <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                        Browse Businesses and Deals
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="py-6"> --}}
            <div>
                {{-- <div class="flex justify-between items-center p-4"> --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-between items-center p-4">
                    <h1 class="font-bold text-xl">Categories</h1>
                    <label class="input input-bordered flex items-center gap-2">
                        <input type="text" class="grow border-gray-100" placeholder="Search Businesses" />
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
                {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
                {{-- <div class="flex flex-col items-center justify-center min-h-screen"> --}}
                <div class="flex flex-col items-center justify-center">
                    {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{ __("Hello, ") }} {{ auth()->user()->role }} {{ auth()->user()->full_name }}!
                        </div>
                    </div> --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                        {{-- <button class="p-4 border border-gray-200 rounded w-64 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100"> --}}
                        <a href="{{ route('food-businesses') }}">
                            <button class="p-6 border border-gray-200 rounded w-80 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100">
                            <div class="flex justify-center items-center text-gray-500 mr-4">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg> --}}
                                {{-- <span class="icon-background"> --}}
                                <i class="fa-lg fa-solid fa-utensils"></i>
                                {{-- </span> --}}
                            </div>
                            <ul class="text-left">
                                <li>
                                    <h1 class="font-bold text-gray-700 text-sm">Food & Beverages</h1>
                                </li>
                                <li>
                                    <h6 class="text-gray-900 text-sm">5 businesses</h6>
                                </li>
                            </ul>
                            </button>
                        </a>
                        <button class="p-6 border border-gray-200 rounded w-80 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100">
                            <div class="flex justify-center items-center text-gray-500 mr-4">
                                {{-- <i class="fa-solid fa-square-plus"></i> --}}
                                <i class="fa-lg fa-solid fa-heart-circle-plus"></i>
                            </div>
                            <ul class="text-left">
                                <li>
                                    <h1 class="font-bold text-gray-700 text-sm">Health & Fitness</h1>
                                </li>
                                <li>
                                    <h6 class="text-gray-900 text-sm">4 businesses</h6>
                                </li>
                            </ul>
                        </button>
                        <button class="p-6 border border-gray-200 rounded w-80 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100">
                            <div class="flex justify-center items-center text-gray-500 mr-4">
                                <i class="fa-lg fa-solid fa-briefcase"></i>
                            </div>
                            <ul class="text-left">
                                <li>
                                    <h1 class="font-bold text-gray-700 text-sm">Professional Services</h1>
                                </li>
                                <li>
                                    <h6 class="text-gray-900 text-sm">10 businesses</h6>
                                </li>
                            </ul>
                        </button>
                        <button class="p-6 border border-gray-200 rounded w-80 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100">
                            <div class="flex justify-center items-center text-gray-500 mr-4">
                                <i class="fa-lg fa-solid fa-hand-holding-heart"></i>
                            </div>
                            <ul class="text-left">
                                <li>
                                    <h1 class="font-bold text-gray-700 text-sm">Beauty & Personal Care</h1>
                                </li>
                                <li>
                                    <h6 class="text-gray-900 text-sm">5 businesses</h6>
                                </li>
                            </ul>
                        </button>
                        <button class="p-6 border border-gray-200 rounded w-80 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100">
                            <div class="flex justify-center items-center text-gray-500 mr-4">
                                <i class="fa-lg fa-solid fa-icons"></i>
                            </div>
                            <ul class="text-left">
                                <li>
                                    <h1 class="font-bold text-gray-700 text-sm">Leisure & Entertainment</h1>
                                </li>
                                <li>
                                    <h6 class="text-gray-900 text-sm">3 businesses</h6>
                                </li>
                            </ul>
                        </button>
                        <button class="p-6 border border-gray-200 rounded w-80 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100">
                            <div class="flex justify-center items-center text-gray-500 mr-4">
                                <i class="fa-lg fa-solid fa-house"></i>
                            </div>
                            <ul class="text-left">
                                <li>
                                    <h1 class="font-bold text-gray-700 text-sm">Home & Household</h1>
                                </li>
                                <li>
                                    <h6 class="text-gray-900 text-sm">5 businesses</h6>
                                </li>
                            </ul>
                        </button>
                        <button class="p-6 border border-gray-200 rounded w-80 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100">
                            <div class="flex justify-center items-center text-gray-500 mr-4">
                                <i class="fa-lg fa-solid fa-building-columns"></i>
                            </div>
                            <ul class="text-left">
                                <li>
                                    <h1 class="font-bold text-gray-700 text-sm">Finance & Banking</h1>
                                </li>
                                <li>
                                    <h6 class="text-gray-900 text-sm">5 businesses</h6>
                                </li>
                            </ul>
                        </button>
                        <button class="p-6 border border-gray-200 rounded w-80 bg-white hover:bg-gray-50 hover:border-b-4 hover:border-b-blue-500 flex items-center active:bg-gray-100">
                            <div class="flex justify-center items-center text-gray-500 mr-4">
                                <i class="fa-lg fa-solid fa-bag-shopping"></i>
                            </div>
                            <ul class="text-left">
                                <li>
                                    <h1 class="font-bold text-gray-700 text-sm">Apparel & Accessories</h1>
                                </li>
                                <li>
                                    <h6 class="text-gray-900 text-sm">5 businesses</h6>
                                </li>
                            </ul>
                        </button>
                    </div>
                </div>
            </div>
            {{-- <div class="flex flex-col items-center justify-center">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                    <a href="#" class="group relative block bg-black">
                        <img
                        alt=""
                        src="https://images.unsplash.com/photo-1603871165848-0aa92c869fa1?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=772&q=80"
                        class="absolute inset-0 h-full w-full object-cover opacity-75 transition-opacity group-hover:opacity-50"
                        />

                        <div class="relative p-4 sm:p-6 lg:p-8">
                            <p class="text-sm font-medium uppercase tracking-widest text-pink-500">Developer</p>

                            <p class="text-xl font-bold text-white sm:text-2xl">Tony Wayne</p>

                            <div class="mt-32 sm:mt-48 lg:mt-64">
                                <div
                                class="translate-y-8 transform opacity-0 transition-all group-hover:translate-y-0 group-hover:opacity-100"
                                >
                                    <p class="text-sm text-white">
                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis perferendis hic asperiores
                                        quibusdam quidem voluptates doloremque reiciendis nostrum harum. Repudiandae?
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div> --}}
            @endif
        </div>
    </div>

    <!-- sidenav -->
    <div class="grid grid-cols-10 grid-rows-2">
        <div class="grid-cols-span-2 grid-rows-span-1">
            <!-- Your grid item content goes here -->
        </div>
    </div>

    <div x-data="{ modalOpen: false, modalType: '', categoryId: null, formData: {} }" x-cloak>
        <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded shadow-lg p-6 w-96">
                <h2 x-text="modalType === 'create' ? 'Create Category' : (modalType === 'edit' ? 'Edit Category' : 'Delete Category')"></h2>
                <template x-if="modalType === 'create' || modalType === 'edit'">
                    <form @submit.prevent="submitForm">
                        <div class="mb-2">
                            <label for="full_name" class="block text-gray-700 text-sm font-bold mb-2">Full Name:</label>
                            <input type="text" id="full_name" x-model="formData.full_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-2">
                            <label for="display_name" class="block text-gray-700 text-sm font-bold mb-2">Display Name:</label>
                            <textarea id="display_name" x-model="formData.display_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                        </div>
                        {{-- <div class="mb-2">
                            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                            <input type="number" id="price" x-model="formData.price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div> --}}
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
                    </form>
                </template>
                <template x-if="modalType === 'delete'">
                    <p>Are you sure you want to delete this category?</p>
                    <button @click="deleteCategory()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</button>
                    <button @click="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded ml-2">Cancel</button>
                </template>
                <button @click="closeModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mt-2">Close</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('modalData', () => ({
                openModal(type, id) {
                    this.modalOpen = true;
                    this.modalType = type;
                    this.categoryId = id;
                    if (type === 'edit') {
                        // Fetch data for editing (replace with your actual API call)
                        fetch(`/categories/${id}/edit`)
                            .then(response => response.json())
                            .then(data => this.formData = data);
                    } else {
                        this.formData = {}; // Clear form data for create
                    }
                },
                closeModal() {
                    this.modalOpen = false;
                    this.formData = {};
                },
                submitForm() {
                    // Handle form submission (replace with your actual API call)
                    fetch(this.modalType === 'create' ? '/categories' : `/categories/${this.categoryId}`, {
                        method: this.modalType === 'create' ? 'POST' : 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(this.formData)
                    })
                        .then(response => response.json())
                        .then(data => {
                            this.closeModal();
                            // Refresh the table or update the data
                            location.reload();
                        });
                },
                deleteCategory() {
                    // Handle product deletion (replace with your actual API call)
                    fetch(`/categories/${this.categoryId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            this.closeModal();
                            // Refresh the table or update the data
                            location.reload();
                        });
                }
            }));
        });
    </script>

</x-app-layout>
