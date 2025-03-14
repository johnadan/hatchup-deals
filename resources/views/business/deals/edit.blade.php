<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Deal') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 h-screen">
        <div class="row-span-2 bg-black">
            <x-sidebar></x-sidebar>
        </div>
        <div class="md:col-span-2 p-4">
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900 dark:text-gray-100">
                            {{-- Keep the session alerts the same --}}
                            @if (session()->has('success'))
                                <x-success-alert></x-success-alert>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('business.deals.update', $deal) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') {{-- Changed to PUT for updates --}}

                                {{-- Existing Image Preview --}}
                                <div class="form-group my-2">
                                    <x-input-label :value="__('Current Image')" />
                                    <img src="{{ asset('storage/' . $deal->image) }}" alt="Current deal image" class="h-32 w-32 object-cover mb-2">
                                    {{-- <input type="file" id="image" name="image"> --}}
                                    <x-image-upload-input id="image" name="image" />
                                    <small class="text-gray-500">Leave blank to keep existing image</small>
                                </div>

                                {{-- All form fields with existing values --}}
                                <div class="form-group my-2">
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                        :value="old('title', $deal->title)" required autofocus />
                                </div>

                                <div class="form-group my-2">
                                    <x-input-label for="description" :value="__('Description')" />
                                    <x-text-area id="description" name="description" class="mt-1 block w-full"
                                        >{{ old('description', $deal->description) }}</x-text-area>
                                </div>

                                <div class="form-group my-2">
                                    <x-input-label for="type" :value="__('Type')" />
                                    <select id="type" name="type" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                                        <option value="free" {{ old('type', $deal->type) === 'free' ? 'selected' : '' }}>Free</option>
                                        <option value="paid" {{ old('type', $deal->type) === 'paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                </div>

                                {{-- Numeric fields with existing values --}}
                                <div class="form-group my-2">
                                    <x-input-label for="original_price" :value="__('Original Price')" />
                                    <x-text-input id="original_price" name="original_price" type="number"
                                        :value="old('original_price', $deal->original_price)"
                                        step="0.01" required />
                                </div>

                                <div class="form-group my-2">
                                    <x-input-label for="discounted_price" :value="__('Discounted Price')" />
                                    <x-text-input id="discounted_price" name="discounted_price" type="number"
                                        :value="old('discounted_price', $deal->discounted_price)"
                                        step="0.01" required />
                                </div>

                                <!-- Add these missing fields -->
                                <div class="form-group my-2">
                                    <x-input-label for="max_usage_limit" :value="__('Maximum Usage Limit')" />
                                    <x-text-input id="max_usage_limit" name="max_usage_limit" type="number"
                                        :value="old('max_usage_limit', $deal->max_usage_limit)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('max_usage_limit')" />
                                </div>

                                {{-- <div class="form-group my-2">
                                    <x-input-label for="current_usage_count" :value="__('Current Usage Count')" />
                                    <x-text-input id="current_usage_count" name="current_usage_count" type="number"
                                        :value="old('current_usage_count', $deal->current_usage_count)" required autocomplete="current_usage_count)" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('current_usage_count')" />
                                </div> --}}

                                <div class="form-group my-2">
                                    <x-input-label for="start_date" :value="__('Start Date')" />
                                    <x-date-input id="start_date" name="start_date"
                                        value="{{ old('start_date', $deal->start_date->format('Y-m-d')) }}" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                                </div>

                                <div class="form-group my-2">
                                    <x-input-label for="end_date" :value="__('End Date')" />
                                    <x-date-input id="end_date" name="end_date"
                                        value="{{ old('end_date', $deal->end_date->format('Y-m-d')) }}" required />
                                    <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                                </div>

                                <!-- Fixed Checkboxes -->
                                <div class="form-group my-2">
                                    <input type="hidden" name="is_active" value="0">
                                    <x-toggle-input id="is_active" name="is_active" value="1"
                                        :checked="old('is_active', $deal->is_active)">
                                        {{ __('Is Active') }}
                                    </x-toggle-input>
                                </div>

                                <div class="form-group my-2">
                                    <input type="hidden" name="is_featured" value="0">
                                    <x-toggle-input id="is_featured" name="is_featured" value="1"
                                        :checked="old('is_featured', $deal->is_featured)">
                                        {{ __('Is Featured') }}
                                    </x-toggle-input>
                                </div>

                                {{-- Keep the rest of the form fields similar with old() fallback to $deal --}}
                                {{-- ... other fields ... --}}

                                <div class="form-group my-2">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Update Deal
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
