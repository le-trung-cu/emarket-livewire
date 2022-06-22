<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input icon="user" label="Name" placeholder="your name" :value="old('name')" required autofocus
                    name="name"
                    type="text" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input icon="user" label="Email" placeholder="your email" :value="old('email')" required
                    name="email"
                    type="email" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input icon="key" label="Password" placeholder="your password" :value="old('password')" required
                autofocus name="password" type="password" autocomplete="new-password"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input icon="key" label="Confirm Password" placeholder="confirm password" :value="old('password')" required
                autofocus name="password_confirmation" type="password" autocomplete="new-password"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
