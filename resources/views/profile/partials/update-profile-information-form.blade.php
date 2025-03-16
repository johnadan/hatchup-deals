<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_picture" :value="__('Profile Picture')" />
            <img
            src="{{ auth()->user()->profile_picture
            ? asset('storage/' . auth()->user()->profile_picture)
            : asset('default-avatar.jpg') }}"
            alt="Profile picture"
            class="h-32 w-32 object-cover mb-2"
            >
            <x-image-upload-input id="profile_picture" name="profile_picture" />
            <small class="text-gray-500">Leave blank to keep existing image</small>
            <x-input-error class="mt-2" :messages="$errors->get('profile_picture')" />
        </div>

        <div>
            <x-input-label for="full_name" :value="__('Full Name')" />
            <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $user->full_name)" required autofocus autocomplete="full_name" />
            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
        </div>

        <div>
            <x-input-label for="display_name" :value="__('Display Name')" />
            <x-text-input id="display_name" name="display_name" type="text" class="mt-1 block w-full" :value="old('display_name', $user->display_name)" required autofocus autocomplete="display_name" />
            <x-input-error class="mt-2" :messages="$errors->get('display_name')" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)" required autofocus autocomplete="phone_number" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <div>
            <x-input-label for="role" :value="__('Role')" />
            <x-text-input disabled id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', $user->role)" required autofocus autocomplete="role" />
            <x-input-error class="mt-2" :messages="$errors->get('role')" />
        </div>

        @if($user->role === 'business')
        <div>
            <x-input-label for="category" :value="__('Category')" />
            <x-text-input disabled id="category" name="category" type="text" class="mt-1 block w-full" :value="old('category', $user->business->category->name)" required autofocus autocomplete="category" disabled/>
            <x-input-error class="mt-2" :messages="$errors->get('category')" />
        </div>
        @endif

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="full_name" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
