<x-app-layout>
    <div class="py-8 bg-gradient-to-br  dark:from-gray-900 dark:to-gray-800 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header Section --}}
            <div class="text-center mb-8">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-gradient-to-br from-[#E1D5B6] to-[#D5C39A] rounded-2xl flex items-center justify-center shadow-lg ring-4 ring-white/20">
                        <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-4xl font-bold text-gray-800 dark:text-white mb-2">
                            Eco Educational Portal
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 text-lg">
                            Share knowledge, inspire change, and build a sustainable future together
                        </p>
                    </div>
                </div>
                
                {{-- Quick Stats --}}
                <div class="flex justify-center gap-6 mt-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-[#B59F84]">{{ $posts->count() }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Community Posts</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-[#B59F84]">{{ $posts->unique('user_id')->count() }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">Active Contributors</div>
                    </div>
                </div>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-white/80 dark:bg-gray-800/80 border border-[#E9DFC7] dark:border-gray-600 rounded-2xl p-4 mb-6 flex items-center gap-3 shadow-sm backdrop-blur-sm">
                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="text-gray-800 dark:text-gray-200 font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="bg-white/80 dark:bg-gray-800/80 border border-red-200 dark:border-red-800 rounded-2xl p-4 mb-6 shadow-sm backdrop-blur-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <span class="text-red-800 dark:text-red-200 font-semibold">Please check your input</span>
                    </div>
                    <ul class="text-red-700 dark:text-red-300 text-sm space-y-1 ml-11">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center gap-2">
                                <svg class="w-3 h-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- CHANGED: Grid layout from lg:grid-cols-3 to lg:grid-cols-5 for even wider sidebar --}}
            <div class="grid lg:grid-cols-5 gap-8">
                {{-- Left Sidebar - Leaderboard, Create Post & Guidelines --}}
                {{-- CHANGED: Column span from lg:col-span-1 to lg:col-span-2 for much wider sidebar --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Leaderboard --}}
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-[#E9DFC7] dark:border-gray-700 p-6">
                        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#B59F84]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Top Contributors
                        </h4>
                        
                        @php
                            $topContributors = $posts->groupBy('user_id')
                                ->map(function($userPosts) {
                                    return [
                                        'user' => $userPosts->first()->user,
                                        'post_count' => $userPosts->count()
                                    ];
                                })
                                ->sortByDesc('post_count')
                                ->take(5);
                        @endphp

                        <div class="space-y-3">
                            @foreach($topContributors as $index => $contributor)
                                <div class="flex items-center gap-3 p-3 rounded-xl {{ $index === 0 ? 'bg-gradient-to-r from-[#F8F4EC] to-[#F1E9D2] dark:from-gray-700 dark:to-gray-600 border border-[#E9DFC7] dark:border-gray-600' : 'hover:bg-[#F8F4EC]/50 dark:hover:bg-gray-700/50' }} transition-all duration-200">
                                    {{-- Rank Badge --}}
                                    <div class="flex-shrink-0">
                                        @if($index === 0)
                                            <div class="w-8 h-8 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-full flex items-center justify-center shadow-sm">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </div>
                                        @elseif($index === 1)
                                            <div class="w-8 h-8 bg-gradient-to-br from-gray-300 to-gray-400 rounded-full flex items-center justify-center shadow-sm">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </div>
                                        @elseif($index === 2)
                                            <div class="w-8 h-8 bg-gradient-to-br from-orange-400 to-orange-500 rounded-full flex items-center justify-center shadow-sm">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </div>
                                        @else
                                            <div class="w-8 h-8 bg-gradient-to-br from-[#E1D5B6] to-[#D5C39A] rounded-full flex items-center justify-center shadow-sm">
                                                <span class="text-gray-800 font-bold text-sm">{{ $index + 1 }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- User Info --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 bg-gradient-to-br from-[#E1D5B6] to-[#D5C39A] rounded-full flex items-center justify-center">
                                                <span class="text-gray-800 font-semibold text-xs">
                                                    {{ substr($contributor['user']->fname ?? 'A', 0, 1) }}
                                                </span>
                                            </div>
                                            <div class="font-semibold text-gray-800 dark:text-gray-200 text-sm truncate">
                                                {{ $contributor['user']->fname ?? 'Community Member' }}
                                            </div>
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ $contributor['post_count'] }} {{ $contributor['post_count'] === 1 ? 'post' : 'posts' }}
                                        </div>
                                    </div>

                                    {{-- Post Count Badge --}}
                                    <div class="flex-shrink-0">
                                        <div class="bg-[#B59F84] text-white text-xs font-bold px-2 py-1 rounded-full">
                                            {{ $contributor['post_count'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            @if($topContributors->isEmpty())
                                <div class="text-center py-6">
                                    <div class="w-12 h-12 bg-[#F8F4EC] dark:bg-gray-700 rounded-2xl flex items-center justify-center mx-auto mb-3 border border-[#E9DFC7] dark:border-gray-600">
                                        <svg class="w-6 h-6 text-[#B59F84]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        No contributors yet
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Create Post Card --}}
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-[#E9DFC7] dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-[#F8F4EC] to-[#F1E9D2] dark:from-gray-700 dark:to-gray-600 px-6 py-4 border-b border-[#E9DFC7] dark:border-gray-600">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-[#B59F84]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Share Your Knowledge
                            </h3>
                        </div>
                        
                        <form action="{{ route('eco-posts.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                            @csrf

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Post Title
                                </label>
                                <input type="text" name="title" placeholder="What's your topic?" 
                                       class="w-full px-4 py-3 bg-[#F8F4EC] dark:bg-gray-700 border border-[#E9DFC7] dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#B59F84] focus:border-transparent dark:text-white transition-all duration-200"
                                       value="{{ old('title') }}" required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    Your Content
                                </label>
                                <textarea name="content" placeholder="Share your environmental insights, sustainable practices, or eco-friendly discoveries..." 
                                          class="w-full px-4 py-3 bg-[#F8F4EC] dark:bg-gray-700 border border-[#E9DFC7] dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#B59F84] focus:border-transparent dark:text-white transition-all duration-200 resize-none"
                                          rows="4" required>{{ old('content') }}</textarea>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Add Image
                                    </label>
                                    <input type="file" name="image" accept="image/*" 
                                           class="w-full px-4 py-2 bg-[#F8F4EC] dark:bg-gray-700 border border-[#E9DFC7] dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#B59F84] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#E1D5B6] file:text-gray-800 hover:file:bg-[#D5C39A] transition-all duration-200">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Video Link (Optional)
                                    </label>
                                    <input type="url" name="video_link" placeholder="https://youtube.com/..." 
                                           class="w-full px-4 py-3 bg-[#F8F4EC] dark:bg-gray-700 border border-[#E9DFC7] dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#B59F84] focus:border-transparent dark:text-white transition-all duration-200"
                                           value="{{ old('video_link') }}">
                                </div>
                            </div>

                            <button type="submit" 
                                    class="w-full bg-gradient-to-r from-[#E1D5B6] to-[#D5C39A] hover:from-[#D5C39A] hover:to-[#C9B284] text-gray-800 font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
                                </svg>
                                Publish Post
                            </button>
                        </form>
                    </div>

                    {{-- Community Guidelines --}}
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-[#E9DFC7] dark:border-gray-700 p-6">
                        <h4 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#B59F84]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Community Guidelines
                        </h4>
                        <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#B59F84] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Share factual, evidence-based environmental information
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#B59F84] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Be respectful and constructive in discussions
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#B59F84] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Credit sources and provide references when possible
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-[#B59F84] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Focus on solutions and positive environmental actions
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Main Content - Posts Feed --}}
                {{-- CHANGED: Column span from lg:col-span-2 to lg:col-span-3 to maintain balance --}}
                <div class="lg:col-span-3">
                    {{-- Posts Header --}}
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-[#E9DFC7] dark:border-gray-700 p-6 mb-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
                                <svg class="w-6 h-6 text-[#B59F84]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                Community Feed
                            </h3>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $posts->count() }} posts • {{ $posts->unique('user_id')->count() }} contributors
                            </div>
                        </div>
                    </div>

                    {{-- Posts List --}}
                    <div class="space-y-6">
                        @foreach($posts->sortByDesc('created_at') as $post)
                            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-lg border border-[#E9DFC7] dark:border-gray-700 overflow-hidden hover:shadow-xl transition-all duration-300">
                                {{-- Post Header --}}
                                <div class="bg-gradient-to-r from-[#F8F4EC] to-[#F1E9D2] dark:from-gray-700 dark:to-gray-600 px-6 py-4 border-b border-[#E9DFC7] dark:border-gray-600">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-gradient-to-br from-[#E1D5B6] to-[#D5C39A] rounded-full flex items-center justify-center shadow-sm">
                                                <span class="text-gray-800 font-semibold text-sm">
                                                    {{ substr($post->user->fname ?? 'A', 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="font-semibold text-gray-800 dark:text-gray-200">
                                                    {{ $post->user->fname ?? 'Community Member' }}
                                                </div>
                                                <div class="text-gray-600 dark:text-gray-400 text-sm flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    {{ $post->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Edit & Delete Buttons --}}
                                        @if(Auth::id() === $post->user_id)
                                            <div class="flex gap-2">
                                                <a href="{{ route('eco-posts.edit', $post->id) }}" 
                                                   class="flex items-center gap-1 px-3 py-1 bg-white/80 hover:bg-white dark:bg-gray-600/80 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg text-sm font-medium transition-all duration-200 border border-[#E9DFC7] dark:border-gray-500">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit
                                                </a>

                                                <form action="{{ route('eco-posts.destroy', $post->id) }}" method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this post?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="flex items-center gap-1 px-3 py-1 bg-white/80 hover:bg-white dark:bg-gray-600/80 dark:hover:bg-gray-600 text-red-600 dark:text-red-400 rounded-lg text-sm font-medium transition-all duration-200 border border-[#E9DFC7] dark:border-gray-500">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- Post Content --}}
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-3">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4 whitespace-pre-line">{{ $post->content }}</p>

                                    {{-- Post Image --}}
                                    @if($post->image)
                                        <div class="mb-4 rounded-2xl overflow-hidden border border-[#E9DFC7] dark:border-gray-600">
                                            <img 
                                                src="{{ asset('storage/'.$post->image) }}" 
                                                class="w-full object-contain bg-[#F8F4EC] dark:bg-gray-700"
                                                style="max-height: 400px;"
                                                alt="Post Image"
                                            >
                                        </div>
                                    @endif

                                    {{-- Post Video --}}
                                    @if($post->video_link)
                                        <div class="flex items-center gap-2 text-[#B59F84] font-medium">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <a href="{{ $post->video_link }}" target="_blank" class="hover:underline">
                                                Watch Educational Video
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @if($posts->count() === 0)
                            <div class="text-center py-12">
                                <div class="w-24 h-24 bg-[#F8F4EC] dark:bg-gray-700 rounded-3xl flex items-center justify-center mx-auto mb-4 border border-[#E9DFC7] dark:border-gray-600">
                                    <svg class="w-12 h-12 text-[#B59F84]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">Welcome to Our Community!</h3>
                                <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto mb-4">
                                    Be the first to share environmental insights and sustainable practices.
                                </p>
                                <p class="text-sm text-gray-500 dark:text-gray-500">
                                    Your knowledge can inspire positive change in our community.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>