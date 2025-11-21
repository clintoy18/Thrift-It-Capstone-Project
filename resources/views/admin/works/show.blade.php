<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ __('Work Details') }}
            </h2>
            <a href="{{ route('admin.works.index') }}"
               class="px-4 py-2 text-sm font-medium rounded-lg bg-white/20 dark:bg-gray-800/40 border border-white/10
                      text-gray-800 dark:text-gray-100 backdrop-blur-md hover:bg-white/30 dark:hover:bg-gray-700/50
                      transition duration-200 shadow-md">
                ← Back to Works
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 rounded-2xl backdrop-blur-xl bg-white/15 dark:bg-gray-900/30 border border-white/10 shadow-xl overflow-hidden">

                {{-- LEFT: Swiper Gallery --}}
                <div class="relative swiper mySwiper h-[34rem] rounded-r-2xl overflow-hidden">
                    <div class="swiper-wrapper h-full">
                        @if ($work->images && $work->images->count() > 0)
                            @foreach ($work->images as $image)
                                <div class="swiper-slide">
                                    <img src="{{ Storage::disk('s3')->url($image->image) }}" alt="{{ $work->title }}"
                                         class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-105">
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide flex items-center justify-center bg-gray-100 dark:bg-gray-700">
                                <img src="{{ asset('images/default-placeholder.png') }}" alt="No image"
                                     class="w-full h-full object-cover">
                            </div>
                        @endif
                    </div>

                    <div class="swiper-pagination absolute bottom-3 left-1/2 transform -translate-x-1/2 z-10"></div>
                    <div class="swiper-button-next !text-white text-lg"></div>
                    <div class="swiper-button-prev !text-white text-lg"></div>
                </div>

                {{-- RIGHT: Work details --}}
                <div class="flex flex-col justify-between p-6 space-y-4">
                    {{-- Work Info --}}
                    <div class="space-y-2">
                        <div class="flex items-start justify-between">
                            <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 leading-tight">
                                {{ $work->title }}
                            </h3>
                            <span class="px-3 py-1 text-xs rounded-md bg-gray-100/30 dark:bg-gray-700/40 border border-white/10 text-gray-800 dark:text-gray-200">
                                {{ $work->upcycle_type }}
                            </span>
                        </div>

                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Posted on: {{ $work->created_at->format('M d, Y') }}
                        </div>

                        <div class="text-sm text-gray-800 dark:text-gray-200">
                            <span class="font-medium">Upcycler:</span>
                            {{ $work->user->fname ?? $work->user->first_name }}
                            {{ $work->user->lname ?? $work->user->last_name }}
                        </div>

                        @if ($work->description)
                            <p class="mt-2 text-sm leading-relaxed text-gray-700 dark:text-gray-300">
                                {{ $work->description }}
                            </p>
                        @endif

                        <div class="mt-2">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $work->approval_status === 'approved' ? 'bg-green-100 text-green-800' :
                                   ($work->approval_status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                   'bg-red-100 text-red-800') }}">
                                {{ ucfirst($work->approval_status) }}
                            </span>
                        </div>
                    </div>

                    {{-- Seller Info --}}
                    <div class="border-t border-white/10 pt-3 mt-3 text-sm text-gray-800 dark:text-gray-300">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-1">
                            <p>
                                <span class="font-medium text-gray-900 dark:text-gray-100">Email:</span>
                                {{ $work->user->email }}
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
