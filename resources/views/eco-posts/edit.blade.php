<x-app-layout>
    <div class="py-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100 mb-6">
                Edit Post
            </h2>

            <form action="{{ route('eco-posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="text" name="title" class="w-full p-2 border rounded mb-2" value="{{ old('title', $post->title) }}" required>
                <textarea name="content" class="w-full p-2 border rounded mb-2" required>{{ old('content', $post->content) }}</textarea>

                <input type="file" name="image" accept="image/*" class="mb-2">
                @if($post->image)
                    <img src="{{ asset('storage/'.$post->image) }}" class="w-full max-h-60 mb-2 object-contain rounded">
                @endif

                <input type="url" name="video_link" class="w-full p-2 border rounded mb-2" value="{{ old('video_link', $post->video_link) }}">

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Update Post
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
