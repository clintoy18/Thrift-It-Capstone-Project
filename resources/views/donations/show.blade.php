<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $donation->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto rounded-lg p-4 overflow-x-hidden">

            <!-- Mobile: Actions at top -->
            <div class="flex gap-2 text-sm mb-4 md:hidden">
                <a href="{{ route('private.chat', $donation->user->id) }}" class="inline-flex items-center justify-center bg-[#B59F84] text-white px-[20px] py-2 rounded-[25px] text-base font-semibold hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-full text-center">Message</a>
                <a href="{{ route('profile.show', $donation->user->id) }}" class="inline-flex items-center justify-center bg-[#B59F84] text-white px-[20px] py-2 rounded-[25px] text-base font-semibold hover:bg-[#a08e77] hover:scale-105 transition-all duration-200 w-full text-center">Profile</a>
            </div>

            <div class="flex flex-col md:flex-row gap-6">
                <!-- Left Column: Image -->
                <div class="md:w-1/3 flex flex-col gap-6">
                    <div class="swiper mySwiper rounded-lg overflow-hidden">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img 
                                    src="{{ $donation->image ? asset('storage/' . $donation->image) : asset('images/default-placeholder.png') }}" 
                                    alt="{{ $donation->name }}"
                                    class="w-full h-64 sm:h-72 md:h-64 object-cover object-center"
                                >
                            </div>
                            <div class="swiper-slide">
                                <img 
                                    src="{{ $donation->image ? asset('storage/' . $donation->image) : asset('images/default-placeholder.png') }}" 
                                    alt="{{ $donation->name }}"
                                    class="w-full h-64 sm:h-72 md:h-64 object-cover object-center"
                                >
                            </div>
                            <div class="swiper-slide">
                    <img 
                        src="{{ $donation->image ? asset('storage/' . $donation->image) : asset('images/default-placeholder.png') }}" 
                        alt="{{ $donation->name }}"
                                    class="w-full h-64 sm:h-72 md:h-64 object-cover object-center"
                                >
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <hr class="w-full mt-1 h-px bg-gray-800 border-0 dark:bg-gray-700">
                    <div>
                        <h1 class="text-xl  font-bold mb-1">{{ $donation->name }}</h1>
                        <p class="text-xs  text-gray-600">
                            Size: {{ $donation->size }} · 
                            {{ ucfirst($donation->condition) }} condition · 
                            {{ $donation->category->name ?? 'No Category' }}
                            </p>
                   </div>
                    <hr class="w-full mt-1 h-px bg-gray-800 border-0 dark:bg-gray-700">

                    <div class="mt-4">
                        <p class="text-lg font-bold text-[#B59F84]">Free</p>
                        <p class="text-sm text-gray-500">Quantity: {{ $donation->qty }}</p>
                        <p class="text-sm text-gray-500">Status: {{ ucfirst($donation->status) }}</p>

                        @if(Auth::id() === $donation->user_id)
                            <a href="{{ route('donations.edit', $donation->id) }}" 
                               class="inline-block mt-3 px-4 py-2 bg-[#B59F84] text-white rounded-lg  hover:bg-[#a08e77] w-full sm:w-auto text-center">
                                Update donation
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right Column -->
                <div class="md:w-2/3 flex flex-col gap-9">

                    <!-- User Info -->
            
                         <!-- User Profile Card -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                        <!-- Background Image Section -->
                        <div class="relative h-32 bg-center bg-cover" style="background-image: url('{{ asset('images/Rectangle 99.png') }}');">                                        
                            <div class="absolute inset-0 bg-black/20"></div>
                        </div>
                        
                        <!-- User Info Section -->
                        <div class="relative bg-[#E1D5B6] p-4">
                            <!-- Avatar -->
                            <div class="absolute -top-8 left-4 w-16 h-16 bg-white dark:bg-gray-700 rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center">
                                <span class="text-xl font-bold text-gray-800 dark:text-gray-200">
                                    {{ strtoupper(substr($donation->user->fname, 0, 1) . substr($donation->user->lname, 0, 1)) }}
                                </span>
                            </div>
                            
                            <!-- User Details -->
                            <div class="flex items-start justify-between pt-4">
                                <div class="flex-1">
                                <h3 class="font-semibold text-gray-800 dark:text-gray-200 text-lg">
                                        {{ $donation->user->fname }}{{ $donation->user->lname }}
                                    </h3>
                                    <!-- Rating -->
                                    <div class="flex items-center mt-1">
                                        <div class="flex text-yellow-500">
                                            <span>★★★★★</span>
                                        </div>
                                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">(5)</span>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="flex flex-col gap-2 ml-4">
                                    <!-- Add Friend Button -->
                                    <a href="{{ route('private.chat', $donation->user->id) }}"
                                       class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition text-sm font-medium">
                                        Message
                                    </a>
                                    
                                    <!-- Visit Profile Button -->
                                    <a href="{{ route('profile.show', $donation->user->id) }}"
                                       class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition text-sm font-medium">
                                        Visit Profile
                                    </a>
                                </div>
                            </div>
                            </div>
                    </div>

                    <!-- Donation Info -->
                    

                    <!-- Comments -->
                    <div class="border p-6 rounded-lg shadow bg-[#F4F2ED]">
    <h3 class="text-lg font-bold mb-4">Comments</h3>

    <!-- Scrollable Comment List -->
    <div id="comments-container" class="max-h-60 overflow-y-auto overflow-x-hidden space-y-3 pr-2">
        @forelse($donation->comments as $comment)
            <div class="comment-item flex items-start gap-3" data-comment-id="{{ $comment->id }}">
                <!-- Avatar with same style as profile -->
                <div class="w-10 h-10 bg-white dark:bg-gray-700 rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-bold text-gray-800 dark:text-gray-200">
                        {{ strtoupper(substr($comment->user->fname, 0, 1) . substr($comment->user->lname, 0, 1)) }}
                    </span>
                </div>
                
                <!-- Comment container with dynamic width (max 40%) -->
                <div class="max-w-[40%] bg-[#E1D5B6] dark:bg-gray-700 p-3 rounded-lg" style="width: fit-content;">
                    <div class="flex items-center gap-2">
                        <a href="{{ route('profile.show', $comment->user->id) }}" class="text-blue-500 hover:underline flex-shrink-0">
                            <p class="font-semibold text-gray-800 dark:text-gray-200 truncate">
                                {{ $comment->user->fname }} {{ $comment->user->lname }}
                            </p>
                        </a>

                        @if(Auth::id() === $comment->user_id)
                        <div class="ml-auto relative flex-shrink-0">
                            <button type="button" class="p-1 rounded hover:bg-black/10 dark:hover:bg-white/10" onclick="toggleDropdown({{ $comment->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div id="dropdown-{{ $comment->id }}" class="absolute right-0 mt-1 w-28 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow z-10 hidden">
                                <!-- Edit option triggers inline edit -->
                                <button type="button"
                                        onclick="toggleEditForm({{ $comment->id }})"
                                        class="w-full text-left px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">
                                    Edit
                                </button>

                                <!-- Delete option -->
                                <button type="button" onclick="deleteComment({{ $comment->id }})" class="w-full text-left px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700">Delete</button>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Comment content (view mode) with line-clamp -->
                    <div id="comment-content-{{ $comment->id }}" class="mt-2 text-gray-800 dark:text-gray-200 break-words overflow-hidden">
                        <div class="line-clamp-3">{{ $comment->content }}</div>
                    </div>

                    <!-- Inline edit form (hidden by default) -->
                    @if(Auth::id() === $comment->user_id)
                    <form id="inline-edit-form-{{ $comment->id }}" 
                        action="{{ route('comments.update', $comment->id) }}" 
                        method="POST" 
                        class="inline-edit-form hidden mt-2" 
                        data-id="{{ $comment->id }}">
                        @csrf
                        @method('PUT')
                        <textarea name="content" rows="2" class="w-full border rounded p-2">{{ old('content', $comment->content) }}</textarea>
                        <div class="flex gap-2 mt-2">
                            <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded">Save</button>
                            <button type="button" onclick="cancelEdit({{ $comment->id }})" class="px-3 py-1 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</button>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
            <div class="flex flex-col overflow-hidden relative left-[50px]">
                <p class="text-gray-500 dark:text-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
            @if(!$loop->last)
                <hr class="my-2 border-gray-200 dark:border-gray-600">
            @endif
        @empty
            <p class="text-gray-600 dark:text-gray-400 text-sm">No comments yet. Be the first to comment!</p>
        @endforelse
    </div>

    <!-- Comment Form -->
    @auth
    <form id="comment-form" action="{{ route('comments.store') }}" method="POST" class="mt-4">
        @csrf
        <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3 w-full max-w-xl bg-white dark:bg-gray-800 p-3 rounded-2xl border border-gray-200 dark:border-gray-600 shadow-md">
            <input type="hidden" name="donation_id" value="{{ $donation->id }}">
            <textarea
                name="content"
                id="comment-content"
                placeholder="Write a comment..."
                class="flex-1 w-full resize-none overflow-hidden rounded-full px-4 py-2 text-sm text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-[#E1D5B6] border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700"
                rows="1"
                oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px';"
                required></textarea>
            <button type="submit"
                class="mt-2 md:mt-0 md:self-center bg-[#E1D5B6] text-white font-semibold px-4 py-2 rounded-full shadow hover:shadow-md hover:bg-[#d1c29f] transition-all duration-300 ease-in-out w-full md:w-auto">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
        <div id="comment-error" class="text-red-500 mt-2 text-sm hidden"></div>
    </form>
    @else
        <p class="mt-3 text-gray-600">
            <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a> to comment.
        </p>
    @endauth
</div>
                    <!-- Back Link -->
                   
                </div>
            </div>
            
            <h2 class=" text-xl  font-semibold text-gray-800 dark:text-gray-200 ">More for this Seller</h2>
           
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
              
                    <!-- Slide 1 -->
                    <div class="grid grid-cols-4 md:grid-cols-3 gap-6 p-4">
                    <div class="rounded-lg overflow-hidden">
                    <img 
                                    src="{{ $donation->image ? asset('storage/' . $donation->image) : asset('images/default-placeholder.png') }}" 
                                    alt="{{ $donation->name }}"
                                    class="w-full h-64 sm:h-72 md:h-64 object-cover object-center"
                                >
                    </div>
                    <div class="rounded-lg overflow-hidden">
                    <img 
                                    src="{{ $donation->image ? asset('storage/' . $donation->image) : asset('images/default-placeholder.png') }}" 
                                    alt="{{ $donation->name }}"
                                    class="w-full h-64 sm:h-72 md:h-64 object-cover object-center"
                                >
                    </div>
                    <div class="rounded-lg overflow-hidden">
                    <img 
                                    src="{{ $donation->image ? asset('storage/' . $donation->image) : asset('images/default-placeholder.png') }}" 
                                    alt="{{ $donation->name }}"
                                    class="w-full h-64 sm:h-72 md:h-64 object-cover object-center"
                                >
                    </div>
                    </div>


                </div>
                </div>

                <div class="flex flex-col overflow-hidden ml-[60px]">
            <a 
                href="{{ route('donations.index') }}" 
                class="flex items-center gap-2 text-[#B59F84] hover:underline"
            >
                <svg xmlns="http://www.w3.org/2000/svg" 
                    class="w-4 h-4" 
                    fill="none" viewBox="0 0 24 24" 
                    stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7 7-7M3 12h18" />
                            </svg>
                            <span>Back to donations</span>
                        </a>
                    </div>

            </div>
        </div>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".mySwiper", {
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
});// JavaScript to expand comments on hover
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.comment-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            const lineClamp = this.querySelector('.line-clamp-3');
            if (lineClamp) {
                lineClamp.style['-webkit-line-clamp'] = 'unset';
                lineClamp.style.display = 'block';
            }
        });
        
        item.addEventListener('mouseleave', function() {
            const lineClamp = this.querySelector('.line-clamp-3');
            if (lineClamp) {
                lineClamp.style['-webkit-line-clamp'] = '3';
                lineClamp.style.display = '-webkit-box';
            }
        });
    });
});

// Your other JavaScript functions remain the same
function toggleDropdown(commentId) {
    const dropdown = document.getElementById('dropdown-' + commentId);
    if (dropdown.classList.contains('hidden')) {
        // Close all other dropdowns first
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            el.classList.add('hidden');
        });
        // Open this dropdown
        dropdown.classList.remove('hidden');
    } else {
        dropdown.classList.add('hidden');
    }
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('[onclick^="toggleDropdown"]') && !event.target.closest('[id^="dropdown-"]')) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
            el.classList.add('hidden');
        });
    }
});

function toggleEditForm(commentId) {
    const contentDiv = document.getElementById(`comment-content-${commentId}`);
    const form = document.getElementById(`inline-edit-form-${commentId}`);
    const dropdown = document.getElementById(`dropdown-${commentId}`);

    if (dropdown) dropdown.classList.add('hidden'); // hide dropdown when editing
    contentDiv.classList.toggle('hidden');
    form.classList.toggle('hidden');
}

function cancelEdit(commentId) {
    const contentDiv = document.getElementById(`comment-content-${commentId}`);
    const form = document.getElementById(`inline-edit-form-${commentId}`);

    contentDiv.classList.remove('hidden');
    form.classList.add('hidden');
}

function deleteComment(commentId) {
    if (!confirm('Are you sure you want to delete this comment?')) {
        return;
    }

    fetch(`/comments/${commentId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the comment from DOM
            const commentElement = document.querySelector(`[data-comment-id="${commentId}"]`);
            if (commentElement) {
                // Also remove the timestamp and hr elements
                const nextElement = commentElement.nextElementSibling;
                const hrElement = nextElement ? nextElement.nextElementSibling : null;
                
                commentElement.remove();
                if (nextElement) nextElement.remove();
                if (hrElement) hrElement.remove();
            }
        } else {
            alert('Failed to delete comment.');
        }
    })
    .catch(error => {
        console.error('Error deleting comment:', error);
        alert('Something went wrong while deleting the comment.');
    });
}

window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
        // Add cache-busting parameter and reload
        const url = new URL(window.location);
        url.searchParams.set('_t', Date.now());
        window.location.href = url.toString();
    }
});

// Force refresh on back/forward navigation
window.addEventListener("popstate", function (event) {
    const url = new URL(window.location);
    url.searchParams.set('_t', Date.now());
    window.location.href = url.toString();
});
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".inline-edit-form").forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            let formData = new FormData(this);
            formData.append('_method', 'PUT'); // Important!

            let commentId = this.dataset.id;
            let url = this.action;

            fetch(url, {
                method: "POST", // Still POST, Laravel sees _method=PUT
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // ✅ Update the DOM immediately
                    const contentDiv = document.getElementById("comment-content-" + commentId);
                    contentDiv.innerText = data.comment.content;

                    this.classList.add("hidden");
                    contentDiv.classList.remove("hidden");
                } else {
                    alert(data.error || "Failed to update comment.");
                }
            })
            .catch(error => {
                console.error("Error updating comment:", error);
                alert("Something went wrong while updating the comment.");
            });
        });
    });
});

     // Optional: Add JavaScript to expand comments on hover/click
document.querySelectorAll('.comment-item').forEach(item => {
    item.addEventListener('mouseenter', function() {
        this.querySelector('.line-clamp-3').style['-webkit-line-clamp'] = 'unset';
    });
    
    item.addEventListener('mouseleave', function() {
        this.querySelector('.line-clamp-3').style['-webkit-line-clamp'] = '3';
    });
});
   // AJAX comment submission
   document.addEventListener('DOMContentLoaded', function() {
        const commentForm = document.getElementById('comment-form');
        if (commentForm) {
            commentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const errorDiv = document.getElementById('comment-error');
                const submitButton = this.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                
                // Show loading state
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                submitButton.disabled = true;
                errorDiv.classList.add('hidden');
                
                fetch("{{ route('comments.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async (response) => {
                    const contentType = response.headers.get('content-type') || '';
                    if (!response.ok) {
                        if (contentType.includes('application/json')) {
                            const errorData = await response.json();
                            const msg = errorData.message || errorData.errors?.content?.[0] || 'Error';
                            throw new Error(msg);
                        } else {
                            throw new Error('Request failed (maybe login required).');
                        }
                    }
                    if (!contentType.includes('application/json')) {
                        throw new Error('Unexpected response from server.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Clear the textarea
                        document.getElementById('comment-content').value = '';
                        
                        // Add the new comment to the list
                        addCommentToDOM(data.comment);
                        
                        // If there was a "no comments" message, remove it
                        const noCommentsMsg = document.querySelector('#comments-container > p');
                        if (noCommentsMsg) {
                            noCommentsMsg.remove();
                        }
                    } else {
                        throw new Error(data.message || 'An error occurred');
                    }
                })
                .catch(error => {
                    errorDiv.textContent = error.message || 'Failed to post comment. Please try again.';
                    errorDiv.classList.remove('hidden');
                })
                .finally(() => {
                    submitButton.innerHTML = originalButtonText;
                    submitButton.disabled = false;
                });
            });
        }
    });

    function addCommentToDOM(commentData) {
        const commentsContainer = document.getElementById('comments-container');
        const commentHtml = `
            <div class="comment-item flex items-start gap-3" data-comment-id="${commentData.id}">
                <!-- Avatar with same style as profile -->
                <div class="w-10 h-10 bg-white dark:bg-gray-700 rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-bold text-gray-800 dark:text-gray-200">
                        ${commentData.user.fname ? (commentData.user.fname.charAt(0) + commentData.user.lname.charAt(0)).toUpperCase() : 'U'}
                    </span>
                </div>
                <div class="inline-block max-w-full bg-[#E1D5B6] dark:bg-gray-700 p-3 rounded-lg ">
                    <div class="flex items-center gap-2">
                        <a href="/profile/${commentData.user.id}" class="text-blue-500 hover:underline">
                            <p class="font-semibold text-gray-800 dark:text-gray-200">
                                ${commentData.user.fname} ${commentData.user.lname}
                            </p>
                        </a>
                        <div class="ml-auto relative">
                            <button type="button" class="p-1 rounded hover:bg-black/10 dark:hover:bg-white/10" onclick="toggleDropdown(${commentData.id})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 dark:text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </button>
                            <div id="dropdown-${commentData.id}" class="absolute right-0 mt-1 w-28 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded shadow z-10 hidden">
                                <a href="/comments/${commentData.id}/edit" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700">Edit</a>
                                <button type="button" onclick="deleteComment(${commentData.id})" class="w-full text-left px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700">Delete</button>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 text-gray-800 dark:text-gray-200 break-words">${commentData.content}</p>
                    
                    <!-- Engagement buttons -->
                    <div class="mt-3 flex items-center gap-4 text-sm">
                        <!-- Like button -->
                        <button onclick="toggleLike(${commentData.id})" 
                                class="flex items-center gap-1 hover:text-blue-500 transition-colors duration-200 text-gray-500"
                                id="like-btn-${commentData.id}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span id="like-count-${commentData.id}">0</span>
                        </button>

                        <!-- Reply button -->
                        <button onclick="toggleReplyForm(${commentData.id})" 
                                class="flex items-center gap-1 hover:text-blue-500 transition-colors duration-200 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <span>Reply</span>
                        </button>
                    </div>

                    <!-- Reply form (hidden by default) -->
                    <div id="reply-form-${commentData.id}" class="hidden ml-12 mt-2">
                        <form class="reply-form" data-parent-id="${commentData.id}">
                            <div class="flex gap-2">
                                <textarea name="content" 
                                        placeholder="Write a reply..." 
                                        class="flex-1 p-2 border border-gray-300 dark:border-gray-600 rounded-lg resize-none focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                        rows="2"
                                        required></textarea>
                                <button type="submit" 
                                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 self-end">
                                    Reply
                                </button>
                                <button type="button" 
                                        onclick="toggleReplyForm(${commentData.id})"
                                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors duration-200 self-end">
                                    Cancel
                                </button>
                            </div>
                            <input type="hidden" name="parent_id" value="${commentData.id}">
                            <input type="hidden" name="donation_id" value="{{ $donation->id }}">
                        </form>
                    </div>

                    <!-- Replies container (hidden by default) -->
                    <div id="replies-${commentData.id}" class="hidden ml-12 mt-2 space-y-2">
                        <!-- Replies will be added here dynamically -->
                    </div>
                </div>
            </div>
            <div class="flex flex-col overflow-hidden relative left-[50px]">
                <p class="text-gray-500 dark:text-gray-400 text-xs">Just now</p>
            </div>
            <hr class="my-2 border-gray-200 dark:border-gray-600">
        `;
        
        // Add the new comment at the top of the comments container
        commentsContainer.insertAdjacentHTML('afterbegin', commentHtml);
        
        // Scroll to the new comment
        const newComment = commentsContainer.querySelector('.comment-item');
        if (newComment) {
            newComment.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    // Toggle like functionality
    function toggleLike(commentId) {
        fetch(`/comments/${commentId}/like`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                reaction_type: 'like'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const likeBtn = document.getElementById(`like-btn-${commentId}`);
                const likeCount = document.getElementById(`like-count-${commentId}`);
                
                // Update button appearance
                if (data.is_liked) {
                    likeBtn.classList.remove('text-gray-500');
                    likeBtn.classList.add('text-blue-500');
                    likeBtn.querySelector('svg').setAttribute('fill', 'currentColor');
                } else {
                    likeBtn.classList.remove('text-blue-500');
                    likeBtn.classList.add('text-gray-500');
                    likeBtn.querySelector('svg').setAttribute('fill', 'none');
                }
                
                // Update count
                likeCount.textContent = data.likes_count;
            }
        })
        .catch(error => {
            console.error('Error toggling like:', error);
        });
    }

    // Toggle reply form
    function toggleReplyForm(commentId) {
        const replyForm = document.getElementById(`reply-form-${commentId}`);
        if (replyForm) {
            replyForm.classList.toggle('hidden');
            if (!replyForm.classList.contains('hidden')) {
                replyForm.querySelector('textarea').focus();
            }
        }
    }

    // Toggle replies display
    function toggleReplies(commentId) {
        const repliesContainer = document.getElementById(`replies-${commentId}`);
        if (repliesContainer) {
            repliesContainer.classList.toggle('hidden');
        }
    }

    // Handle reply form submission
    document.addEventListener('DOMContentLoaded', function() {
        document.addEventListener('submit', function(e) {
            if (e.target.classList.contains('reply-form')) {
                e.preventDefault();
                
                const formData = new FormData(e.target);
                const parentId = e.target.dataset.parentId;
                const submitButton = e.target.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                
                // Show loading state
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                submitButton.disabled = true;
                
                fetch("{{ route('comments.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(async (response) => {
                    const contentType = response.headers.get('content-type') || '';
                    if (!response.ok) {
                        if (contentType.includes('application/json')) {
                            const errorData = await response.json();
                            const msg = errorData.message || errorData.errors?.content?.[0] || 'Error';
                            throw new Error(msg);
                        } else {
                            throw new Error('Request failed (maybe login required).');
                        }
                    }
                    if (!contentType.includes('application/json')) {
                        throw new Error('Unexpected response from server.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Clear the textarea
                        e.target.querySelector('textarea').value = '';
                        
                        // Hide the reply form
                        toggleReplyForm(parentId);
                        
                        // Show the replies container if it's hidden
                        const repliesContainer = document.getElementById(`replies-${parentId}`);
                        if (repliesContainer && repliesContainer.classList.contains('hidden')) {
                            repliesContainer.classList.remove('hidden');
                        }
                        
                        // Add the new reply to the replies container
                        addReplyToDOM(data.comment, parentId);
                        
                        // Update replies count
                        updateRepliesCount(parentId);
                    } else {
                        throw new Error(data.message || 'An error occurred');
                    }
                })
                .catch(error => {
                    alert(error.message || 'Failed to post reply. Please try again.');
                })
                .finally(() => {
                    submitButton.innerHTML = originalButtonText;
                    submitButton.disabled = false;
                });
            }
        });
    });

    // Add reply to DOM
    function addReplyToDOM(replyData, parentId) {
        const repliesContainer = document.getElementById(`replies-${parentId}`);
        if (!repliesContainer) return;
        
        const replyHtml = `
            <div class="reply-item flex items-start gap-2" data-comment-id="${replyData.id}">
                <div class="w-8 h-8 bg-white dark:bg-gray-700 rounded-full border-2 border-white dark:border-gray-800 flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-bold text-gray-800 dark:text-gray-200">
                        ${replyData.user.fname ? (replyData.user.fname.charAt(0) + replyData.user.lname.charAt(0)).toUpperCase() : 'U'}
                    </span>
                </div>
                <div class="max-w-[35%] bg-gray-100 dark:bg-gray-600 p-2 rounded-lg" style="width: fit-content;">
                    <div class="flex items-center gap-2">
                        <a href="/profile/${replyData.user.id}" class="text-blue-500 hover:underline text-sm font-semibold">
                            ${replyData.user.fname} ${replyData.user.lname}
                        </a>
                    </div>
                    <p class="mt-1 text-sm text-gray-800 dark:text-gray-200">${replyData.content}</p>
                    
                    <!-- Reply engagement -->
                    <div class="mt-2 flex items-center gap-3 text-xs">
                        <button onclick="toggleLike(${replyData.id})" 
                                class="flex items-center gap-1 hover:text-blue-500 transition-colors duration-200 text-gray-500"
                                id="like-btn-${replyData.id}">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span id="like-count-${replyData.id}">0</span>
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        repliesContainer.insertAdjacentHTML('beforeend', replyHtml);
    }

    // Update replies count
    function updateRepliesCount(commentId) {
        const repliesContainer = document.getElementById(`replies-${commentId}`);
        if (repliesContainer) {
            const repliesCount = repliesContainer.querySelectorAll('.reply-item').length;
            const repliesButton = document.querySelector(`button[onclick="toggleReplies(${commentId})"]`);
            if (repliesButton) {
                repliesButton.textContent = `${repliesCount} ${repliesCount === 1 ? 'reply' : 'replies'}`;
            }
        }
    }
    </script>
</x-app-layout>
