<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="text-2xl font-extrabold tracking-tight text-gray-900 dark:text-gray-100">
                {{ __('Category') }}
            </h2>
            <a href="{{ route('appointments.myAppointments') }}" 
             class="ml-auto inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-full bg-[#B59F84] text-white shadow-sm hover:bg-[#a08e77] active:scale-[.98] transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                My Appointments
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach ($upcyclers as $upcycler)
                    <div class="group relative overflow-hidden bg-[#F4F2ED] dark:bg-gray-800/90 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
                        <div class="h-16 bg-gradient-to-r from-[#E1D5B6] to-[#cbbda2] dark:from-gray-700 dark:to-gray-600"></div>
                        <div class="p-6">
                            <div class="-mt-10 mb-3 w-16 h-16 mx-auto rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 flex items-center justify-center text-gray-800 dark:text-gray-200 font-bold shadow">
                                {{ strtoupper(substr($upcycler->fname,0,1).substr($upcycler->lname,0,1)) }}
                            </div>
                            <div class="text-center">
                                <a href="{{ route('profile.show', $upcycler->id) }}" class="inline-block">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 group-hover:text-[#6f5e49] transition-colors">
                                        {{ $upcycler->fname }} {{ $upcycler->lname }}
                                    </h3>
                                </a>
                                <div class="mt-1 inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4a2 2 0 0 0-2 2v.01L12 13l10-6.99V6a2 2 0 0 0-2-2Zm0 4.236-8 5.59-8-5.59V18a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8.236Z"/></svg>
                                    <a href="mailto:{{ $upcycler->email }}" class="hover:underline">{{ $upcycler->email }}</a>
                                </div>
                                <div class="mt-3 flex items-center justify-center gap-2 flex-wrap">
                                    <span class="px-2.5 py-1 text-xs rounded-full bg-white text-gray-700 border border-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">Specialization</span>
                                    <span class="px-2.5 py-1 text-xs rounded-full bg-[#E1D5B6]/30 text-[#6f5e49] ring-1 ring-[#E1D5B6]/40">{{ $upcycler->specialization ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="mt-5 space-y-3">
                                <a href="{{ route('appointments.create', ['upcycler_id' => $upcycler->id]) }}" 
                                   class="w-full inline-flex items-center justify-center gap-2 bg-[#B59F84] hover:bg-[#a08e77] active:scale-[.99] text-white font-semibold py-2.5 px-4 rounded-full shadow-sm transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                    Request Appointment
                                </a>
                             
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>