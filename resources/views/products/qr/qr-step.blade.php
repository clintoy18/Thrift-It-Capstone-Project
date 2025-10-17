<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Optional QR Code Upload') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

        
                   <x-step-progress :currentStep="$currentStep" />



            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg p-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                    Add an optional QR code for your product
                </h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                    You can skip this step if you don't want to upload a QR code right now.
                </p>

                <form action="{{ route('sell-item.qr.store', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <!-- QR Upload Field -->
                    <div>
                        <label for="qr_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Upload QR Code (optional)
                        </label>
                        <input type="file" name="qr_code" id="qr_code"
                            class="mt-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer
                                   bg-gray-50 dark:bg-gray-700 dark:text-gray-300 focus:outline-none focus:ring-2
                                   focus:ring-[#E1D5B6] focus:border-[#E1D5B6]">
                        @error('qr_code')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('sell-item.qr.skip', $product->id) }}"
                            class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 rounded-lg transition-all duration-300">
                            Skip
                        </a>

                        <button type="submit"
                            class="px-5 py-2.5 bg-[#E1D5B6] hover:bg-[#D5C39A] text-gray-800 font-semibold rounded-lg transition-all duration-300">
                            Save & Proceed
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
