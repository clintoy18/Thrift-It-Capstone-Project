<x-guest-layout containerClass="max-w-[400px]" reverseColumns="true">

    {{-- Removed wrapper for smaller form size --}}
    <div class="max-w-[300px] mx-auto"> 
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-4 text-center">
            <h1 class="text-3xl font-bold text-black dark:text-black">Register</h1>
        </div>
        <!-- Name -->
        <div>
            <x-input-label for="fname" :value="__('First Name')" />
            <x-text-input id="fname" class="block mt-1 w-full" type="text" name="fname" :value="old('fname')" required autofocus autocomplete="fname" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="lname" :value="__('Last Name')" />
            <x-text-input id="lname" class="block mt-1 w-full" type="text" name="lname" :value="old('lname')" required autofocus autocomplete="lname" />
            <x-input-error :messages="$errors->get('lname')" class="mt-2" />
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Role Selection -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')" />
            <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>User</option>
                <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Upcycler</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
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
        <div class="mt-4">
            <x-primary-button class="w-full flex items-center justify-center">
              <i class="fas fa-user-plus mr-2"></i>
              {{ __('Register') }}
            </x-primary-button>
          </div>
          
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-[#B59F84] hover:text-[#a08e77] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-[#B59F84] focus:ring-offset-2" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</div>
</x-guest-layout>