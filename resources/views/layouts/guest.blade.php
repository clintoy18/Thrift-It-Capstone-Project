<x-guest-layout containerClass="max-w-[400px]">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex items-center justify-center h-screen">
        <div class="max-w-[300px] w-full">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4 text-center">
                    <h1 class="text-3xl font-bold text-black dark:text-black">Login</h1>
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Login Button -->
                <div class="mt-4 text-center">
                    <x-primary-button class="w-full flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer select-none gap-2">
                        <input id="remember_me" type="checkbox" class="h-5 w-5 rounded border-gray-300 text-[#B59F84] focus:ring-[#B59F84] transition-all duration-150 shadow-sm" name="remember">
                        <span class="text-base text-gray-700 font-medium">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Sign Up -->
                <div class="flex items-center justify-center mt-4 gap-2">
                    <span class="text-gray-700">{{ __('Don\'t have an account?') }}</span>
                    <a href="{{ route('register') }}" class="underline text-sm text-[#B59F84] hover:text-[#a08e77]">
                        <i class="fas fa-user-plus mr-1"></i>{{ __('Sign Up') }}
                    </a>
                </div>

                <!-- Forgot Password -->
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-[#B59F84] hover:text-[#a08e77]" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
