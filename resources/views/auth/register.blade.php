<x-guest-layout>
    {{-- <div class="my-2"> --}}
    <form method="POST" action="{{ route('auth.register') }}">
    {{-- <form method="POST" action="{{ route('register') }}"> --}}
        @csrf

        <!-- Full Name -->
        <div>
            <x-input-label for="full_name" :value="__('Full Name')" />
            <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name')" required autofocus autocomplete="full_name" />
            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
        </div>

        <!-- Display Name -->
        <div>
            <x-input-label for="display_name" :value="__('Display Name (Visible to Businesses if you are a Customer)')" />
            <x-text-input id="display_name" class="block mt-1 w-full" type="text" name="display_name" :value="old('display_name')" required autocomplete="display_name" />
            <x-input-error :messages="$errors->get('display_name')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autocomplete="phone_number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        {{-- <input type="text" name="role" value="admin" hidden> --}}
        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            Register As
        </label>
        <select id="role" name="role" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
            <option value="customer">Customer</option>
            <option value="business">Business</option>
            <option value="admin">Admin</option>
        </select>

        <!-- Business-specific fields -->
        <div id="business-fields" style="display: none;">
            {{-- <div class="form-group"> --}}
                <!-- <label for="business_name">Business Name</label>
                <input type="text" name="business_name" id="business_name" class="form-control"> -->
                {{-- <label for="name">Business Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div> --}}
            <div>
                <x-input-label for="business_name" :value="__('Business Name')" />
                <x-text-input id="business_name" class="block mt-1 w-full" type="text" name="name" :value="old('business_name')" />
                <x-input-error :messages="$errors->get('business_name')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="business_address" :value="__('Business Address')" />
                {{-- <x-text-input id="business_address" class="block mt-1 w-full" type="text" name="address" :value="old('business_address')" /> --}}
                <x-text-area id="business_address" name="address" class="mt-1 block w-full" :value="old('business_address')" required autocomplete="business_address" wire:model="business_address" />
                <x-input-error :messages="$errors->get('business_address')" class="mt-2" />
            </div>
            {{-- <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" class="form-control">
            </div> --}}
            {{-- <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control">
            </div> --}}
            <div>
                <x-input-label for="buss_phone_number" :value="__('Business Phone Number')" />
                <x-text-input id="buss_phone_number" class="block mt-1 w-full" type="text" name="buss_phone_number" :value="old('buss_phone_number')" />
                <x-input-error :messages="$errors->get('buss_phone_number')" class="mt-2" />
            </div>
            {{-- <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div> --}}
            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Business Category
            </label>
            <select id="category_id" name="category_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('business.create') }}">
                {{ __('Register as a business') }}
            </a>&nbsp; or &nbsp; --}}

            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Go to Login') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    {{-- </div> --}}
    <script>
        // Show/hide business-specific fields based on role selection
        document.getElementById('role').addEventListener('change', function () {
            const businessFields = document.getElementById('business-fields');
            businessFields.style.display = this.value === 'business' ? 'block' : 'none';
        });
    </script>
</x-guest-layout>
