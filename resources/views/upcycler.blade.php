<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <!-- Icon-like image -->
            <div class="flex-shrink-0">
                <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Upcycler Dashboard') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Transform waste into wonder • Create sustainable beauty • Redefine recycling
                </p>
            </div>
        </div>
    </x-slot>

    <!-- Cinematic Hero Section -->
<div class="relative bg-[#F4F2ED] overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-[#B59F84] to-[#8A7B66] opacity-20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center">
            <!-- Main Icon -->
            <div class="mb-6">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-[#634600] rounded-full shadow-lg transform hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-[#F4F2ED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                </div>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-bold text-[#634600] mb-6 tracking-tight">
                Welcome to Your <span class="text-[#B59F84]">Creative</span> Hub
            </h1>
            <p class="text-xl md:text-2xl text-[#603E14] mb-8 max-w-3xl mx-auto leading-relaxed">
                Where discarded materials find new life as extraordinary creations. 
                Your vision transforms trash into treasure, one sustainable masterpiece at a time.
            </p>
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12 max-w-2xl mx-auto">
                <div class="bg-white/80 backdrop-blur-sm rounded-lg p-6 border border-[#B59F84] shadow-lg">
                    <div class="text-2xl font-bold text-[#634600] mb-2">∞</div>
                    <div class="text-[#603E14] font-semibold">Unlimited Creativity</div>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-lg p-6 border border-[#B59F84] shadow-lg">
                    <div class="text-2xl font-bold text-[#634600] mb-2">♻️</div>
                    <div class="text-[#603E14] font-semibold">Eco-Friendly</div>
                </div>
                <div class="bg-white/80 backdrop-blur-sm rounded-lg p-6 border border-[#B59F84] shadow-lg">
                    <div class="text-2xl font-bold text-[#634600] mb-2">⚡</div>
                    <div class="text-[#603E14] font-semibold">Fast Results</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Animated background elements -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute -top-4 -left-4 w-8 h-8 bg-[#B59F84] rounded-full opacity-30 animate-pulse"></div>
        <div class="absolute top-1/4 right-10 w-6 h-6 bg-[#8A7B66] rounded-full opacity-40 animate-bounce"></div>
        <div class="absolute bottom-20 left-20 w-4 h-4 bg-[#634600] rounded-full opacity-30 animate-ping"></div>
        <div class="absolute top-1/2 left-1/4 w-3 h-3 bg-[#603E14] rounded-full opacity-50 animate-pulse"></div>
        <div class="absolute bottom-10 right-20 w-5 h-5 bg-[#B59F84] rounded-full opacity-25 animate-bounce delay-300"></div>
    </div>
</div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Enhanced Description Section with Icons -->
            <div class="mb-12">
                <div class="text-center mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-4">
                        Your Upcycling Journey Starts Here
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                        Discover powerful tools and resources to transform ordinary materials into extraordinary creations. 
                        Join a community of eco-innovators making a difference.
                    </p>
                </div>

                <!-- Feature Grid with Icons -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                    <!-- Feature 1 -->
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Sustainable Impact</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Track your environmental contribution and see how your creations reduce waste.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-800 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Creative Community</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Connect with fellow upcyclers, share ideas, and get inspired by innovative projects.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-purple-100 dark:bg-purple-800 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Smart Tools</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Access advanced tools for material matching, project planning, and design optimization.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="text-center group">
                        <div class="w-16 h-16 bg-orange-100 dark:bg-orange-800 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">Progress Tracking</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Monitor your projects, set milestones, and celebrate your upcycling achievements.
                        </p>
                    </div>
                </div>

                <!-- Call to Action Section -->
                <div class="bg-gradient-to-r from-green-500 to-teal-600 rounded-2xl p-8 text-center text-white shadow-xl">
                    <div class="max-w-2xl mx-auto">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold mb-4">Ready to Create Something Amazing?</h3>
                        <p class="text-green-100 text-lg mb-6">
                            Join thousands of upcyclers turning waste into wonder. Start your first project today and make a positive impact on our planet.
                        </p>
                       
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Content -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Dashboard Overview</h3>
                        <span class="px-3 py-1 bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 rounded-full text-sm font-medium">
                            Active Upcycler
                        </span>
                    </div>
                    {{ __("You're logged in!") }}
                    <p class="mt-4 text-gray-600 dark:text-gray-400">
                        Ready to transform ordinary materials into extraordinary creations? Start your next upcycling project today!
                    </p>
                    
                    <!-- Quick Stats -->
                    
                        
                        
                        
                      
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>