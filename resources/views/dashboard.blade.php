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
        background-color: #4CAF50;Green
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
            <!-- <input type="file" name="image" accept="image/*"> -->
            <!-- deals -->
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            Add Deal
                            <form method="POST" action="{{ route('deals.store') }}">
                                <div class="form-group my-2">
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                </div>
                                <div class="form-group my-2">
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-area id="description" name="description" class="mt-1 block w-full" :value="old('description')" required autocomplete="description" wire:model="description" />
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>
                                <div class="form-group my-2">
                                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Type
                                    </label>
                                    <select id="type" name="type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="free">Free</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <x-input-label for="orig_price" :value="__('Original Price')" />
                                    <x-text-input id="orig_price" name="original_price" type="number" class="mt-1 block w-full" :value="old('orig_price')" required autocomplete="orig_price" />
                                    <x-input-error class="mt-2" :messages="$errors->get('orig_price')" />
                                </div>
                                <div class="form-group my-2">
                                    <x-input-label for="disc_price" :value="__('Discounted Price')" />
                                    <x-text-input id="disc_price" name="discounted_price" type="number" class="mt-1 block w-full" :value="old('disc_price')" required autocomplete="disc_price" />
                                    <x-input-error class="mt-2" :messages="$errors->get('disc_price')" />
                                </div>
                                <div class="form-group my-2">
                                    <x-input-label for="max_usage_limit" :value="__('Maximum Usage Limit')" />
                                    <x-text-input id="max_usage_limit" name="max_usage_limit" type="number" class="mt-1 block w-full" :value="old('max_usage_limit')" required autocomplete="max_usage_limit" />
                                    <x-input-error class="mt-2" :messages="$errors->get('max_usage_limit')" />
                                </div>
                                <div class="form-group my-2">
                                    <x-input-label for="start_date" :value="__('Start Date')" />
                                    <x-date-input id="start_date" name="start_date" class="mt-1 block w-full" :value="old('start_date')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                                </div>
                                <div class="form-group my-2">
                                    <x-input-label for="end_date" :value="__('End Date')" />
                                    <x-date-input id="end_date" name="end_date" class="mt-1 block w-full" :value="old('end_date')" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                                </div>
                                <div class="form-group my-2">
                                    <x-toggle-input id="is_active" name="is_active" :value="old('is_active')" required>
                                        {{ __('Is Active') }}
                                    </x-toggle-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                                </div>
                                <div class="form-group my-2">
                                    <x-toggle-input id="is_featured" name="is_featured" :value="old('is_featured')" required>
                                        {{ __('Is Featured') }}
                                    </x-toggle-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('is_featured')" />
                                </div>
                                <div class="form-group my-2">
                                    <x-image-upload-input id="image" name="image" />
                                    {{-- <label for="image">Deal Image</label>
                                    <input type="file" name="image" id="image" class="form-control"> --}}
                                </div>
                                <div class="form-group my-2">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Save
                                    </button>
                                </div>
                                {{-- <input type="file" class="file-input file-input-bordered w-full max-w-xs" /> --}}
                                {{-- <div>
                                    <x-image-upload-input id="image" name="image" :value="old('image')" required autofocus>
                                        {{ __('Upload Image') }}
                                    </x-image-upload-input>
                                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
