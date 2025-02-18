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
            {{-- <div class="container">
                <h1>Create a New Deal</h1>
                <form action="{{ route('deals.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="original_price">Original Price</label>
                        <input type="number" name="original_price" id="original_price" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="discounted_price">Discounted Price</label>
                        <input type="number" name="discounted_price" id="discounted_price" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="max_usage_limit">Max Usage Limit</label>
                        <input type="number" name="max_usage_limit" id="max_usage_limit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Deal Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Create Deal</button>
                </form>
            </div> --}}
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            Add Deal
                            <form method="POST" action="{{ route('business.deals.store') }}" enctype="multipart/form-data">
                                @csrf
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
</x-app-layout>
