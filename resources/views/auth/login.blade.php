
 
<x-guest-layout containerClass="max-w-[400px]">
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
<div class="max-w-[300px] mx-auto">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4 text-center">
            <h1 class="text-3xl font-bold text-black dark:text-black">Login</h1>
        </div>
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1  w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mt-4 text-center">
        <x-primary-button class="w-full flex items-center justify-center">
            <i class="fas fa-sign-in-alt"></i>
            {{ __('Log in') }}
        </x-primary-button>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>
        <div class="flex items-center justify-center mt-4">
            <a></a>
                <i class="fas fa-user-plus"></i>
                {{ __('Don\'t have an account?') }} &nbsp;
            </a>
            <a href="{{ route('register') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Sign Up ') }}
            </a>
        </div>
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))

                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }} 
                </a>
            @endif
        </div>
    </form>
</div> 
</x-guest-layout>
