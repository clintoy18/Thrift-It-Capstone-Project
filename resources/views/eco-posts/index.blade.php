<x-app-layout>
    <div class="py-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Page Title --}}
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100 mb-6">
                Eco Educational Portal
            </h2>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Create Post Form --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md mb-6 p-4">
                <form action="{{ route('eco-posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="text" name="title" placeholder="Post Title" class="w-full p-2 border rounded mb-2" value="{{ old('title') }}" required>
                    <textarea name="content" placeholder="What's on your mind?" class="w-full p-2 border rounded mb-2" required>{{ old('content') }}</textarea>

                    <input type="file" name="image" accept="image/*" class="mb-2">
                    <input type="url" name="video_link" placeholder="Video URL (optional)" class="w-full p-2 border rounded mb-2" value="{{ old('video_link') }}">

                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                        Post
                    </button>
                </form>
            </div>

            {{-- Display Posts --}}
            @foreach($posts->sortByDesc('created_at') as $post)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md mb-6 p-4">
                    
                    {{-- Post Header --}}
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="font-semibold text-gray-800 dark:text-gray-200">
                                {{ $post->user->fname ?? 'Anonymous' }}
                            </div>
                            <div class="text-gray-500 text-sm ml-2">
                                {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>

                        {{-- Edit & Delete Buttons --}}
                        @if(Auth::id() === $post->user_id)
                            <div class="flex gap-2">
                                <a href="{{ route('eco-posts.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700 text-sm font-semibold mr-2">
                                    Edit
                                </a>

                                <form action="{{ route('eco-posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-semibold">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    {{-- Post Content --}}
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $post->title }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-2">{{ $post->content }}</p>

                    {{-- Post Image --}}
                    @if($post->image)
                        <img 
                            src="{{ asset('storage/'.$post->image) }}" 
                            class="rounded-lg mb-2 w-full object-contain"
                            style="max-height: 500px;"
                            alt="Post Image"
                        >
                    @endif

                    {{-- Post Video --}}
                    @if($post->video_link)
                        <a href="{{ $post->video_link }}" target="_blank" class="text-blue-500 hover:underline">
                            Watch Video
                        </a>
                    @endif
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
