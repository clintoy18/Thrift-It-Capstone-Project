<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Donations Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    {{-- Go Back to Dashboard Button  PALIHOG KO IMPROVE PRE --}}
                    <div class="mb-6">
                        <a href="{{ route('admin.dashboard') }}"
                            class="inline-flex items-center px-4 py-2 bg-[#B59F84] text-white text-sm font-medium rounded-md hover:bg-[#a08e77] transition-all duration-300">
                            ← Back to Dashboard
                        </a>
                    </div>

                    {{-- Tabs --}}
                    <div class="flex border-b border-gray-300 dark:border-gray-700 mb-6">
                        <button id="tab-approval"
                            class="px-4 py-2 font-medium text-sm text-gray-700 dark:text-gray-300 border-b-2 border-[#B59F84]"
                            onclick="switchTab('approval')">
                            Approval Management
                        </button>
                        <button id="tab-reward"
                            class="ml-6 px-4 py-2 font-medium text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 border-b-2 border-transparent"
                            onclick="switchTab('reward')">
                            Reward Management
                        </button>
                    </div>

                    {{-- APPROVAL MANAGEMENT SECTION --}}
                    <div id="approval-section">
                        {{-- Pending donations --}}
                        <h3 class="text-lg font-semibold text-yellow-700 dark:text-yellow-300 mb-4">Pending Donations
                        </h3>
                        <div class="overflow-x-auto">
                            @include('admin.donations._table', ['donations' => $pendingDonations])
                            <div class="mt-4">
                                {{ $pendingDonations->links() }}
                            </div>
                        </div>

                        {{-- Approved donations --}}
                        <h3 class="text-lg font-semibold text-green-700 dark:text-green-300 mt-8 mb-4">Approved
                            Donations</h3>
                        <div class="overflow-x-auto mb-6">
                            @include('admin.donations._table', ['donations' => $approvedDonations])
                            <div class="mt-4">
                                {{ $approvedDonations->links() }}
                            </div>
                        </div>
                        {{-- Rejected donations --}}
                        <h3 class="text-lg font-semibold text-red-700 dark:text-red-300
                        mt-8 mb-4">Rejected Donations</h3>
                        <div class="overflow-x-auto">
                            @include('admin.donations._table', ['donations' => $rejectedDonations])
                            <div class="mt-4">
                                {{ $rejectedDonations->links() }}
                            </div>
                        </div>

                    </div>

                    {{-- REWARD MANAGEMENT SECTION --}}
                    <div id="reward-section" class="hidden">
                        <h3 class="text-lg font-semibold text-yellow-700 dark:text-yellow-300 mb-4">Pending
                            Verifications</h3>
                        @include('admin.donations.reward-management._reward_table', [
                            'donations' => $pendingVerifications,
                            'type' => 'pending',
                        ])

                        <h3 class="text-lg font-semibold text-green-700 dark:text-green-300 mt-8 mb-4">Verified
                            Donations</h3>
                        @include('admin.donations.reward-management._reward_table', [
                            'donations' => $verifiedDonations,
                            'type' => 'verified',
                        ])

                        <h3 class="text-lg font-semibold text-red-700 dark:text-red-300 mt-8 mb-4">Rejected Proofs</h3>
                        @include('admin.donations.reward-management._reward_table', [
                            'donations' => $rejectedProofs,
                            'type' => 'rejected',
                        ])
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Simple tab switcher script --}}
    <script>
        function switchTab(tab) {
            const approvalSection = document.getElementById('approval-section');
            const rewardSection = document.getElementById('reward-section');

            const tabApproval = document.getElementById('tab-approval');
            const tabReward = document.getElementById('tab-reward');

            if (tab === 'approval') {
                approvalSection.classList.remove('hidden');
                rewardSection.classList.add('hidden');
                tabApproval.classList.add('border-[#B59F84]', 'text-gray-700', 'dark:text-gray-300');
                tabReward.classList.remove('border-[#B59F84]', 'text-gray-700', 'dark:text-gray-300');
                tabReward.classList.add('text-gray-500', 'dark:text-gray-400');
            } else {
                approvalSection.classList.add('hidden');
                rewardSection.classList.remove('hidden');
                tabReward.classList.add('border-[#B59F84]', 'text-gray-700', 'dark:text-gray-300');
                tabApproval.classList.remove('border-[#B59F84]', 'text-gray-700', 'dark:text-gray-300');
                tabApproval.classList.add('text-gray-500', 'dark:text-gray-400');
            }
        }
    </script>
</x-app-layout>
