<table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
    <thead>
        <tr>
            <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Work Title</th>
            <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Upcycler</th>
            <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Description</th>
            <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Upcycling Type</th>
            <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Status</th>

            <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Date</th>
            <th
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:text-gray-200 dark:divide-gray-700">
        @forelse($works as $work)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                    {{ $work->title }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                    {{ $work->user->fname }} {{ $work->user->lname }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                    {{ $work->description }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                    {{ $work->upcycle_type }}

                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span
                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $work->approval_status === 'approved'
                            ? 'bg-green-100 text-green-800'
                            : ($work->approval_status === 'pending'
                                ? 'bg-yellow-100 text-yellow-800'
                                : 'bg-red-100 text-red-800') }}">
                        {{ ucfirst($work->approval_status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                    {{ $work->created_at->format('M d, Y') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.works.show', $work) }}"
                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">
                        View
                    </a>

                    @if ($work->approval_status === 'pending')
                        {{-- Approve Button --}}
                        <form action="{{ route('admin.works.approve', $work) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 mr-3"
                                onclick="return confirm('Approve this work?')">
                                Approve
                            </button>
                        </form>

                        {{-- Reject Button --}}
                        <button type="button"
                            class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                            onclick="openRejectModal({{ $work->id }})">
                            Reject
                        </button>
                    @else
                        {{-- Delete Button only if not pending --}}
                        <form action="{{ route('admin.works.destroy', $work) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                onclick="return confirm('Delete this work?')">
                                Delete
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-gray-500 py-4">No works found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
{{-- Modal to add admin notes --}}
<div id="rejectModal" 
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md mx-4">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">
            Reject Work
        </h2>

        <form id="rejectForm" method="POST">
            @csrf
            @method('PUT')

            <textarea name="admin_notes" 
                      class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:bg-gray-700 dark:text-gray-100" 
                      rows="5" 
                      placeholder="Add rejection notes..."></textarea>

            <div class="flex justify-end mt-4 space-x-2">
                <button type="button" onclick="closeRejectModal()"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Reject
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('rejectModal');

    function openRejectModal(workId) {
        document.getElementById('rejectForm').action = `/admin/works/${workId}/reject`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeRejectModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Close modal when clicking outside content
    modal.addEventListener('click', function(e) {
        if (e.target === modal) closeRejectModal();
    });
</script>

