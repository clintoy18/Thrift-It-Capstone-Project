<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight font-sans">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 font-sans">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12 space-y-14">
            <!-- Stats Overview -->
            <section>
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6 flex items-center gap-2">
                    <i class="fas fa-chart-bar text-indigo-500"></i> Overview
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($stats as $key => $value)
                        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg p-6 flex flex-col items-center justify-between">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 capitalize mb-2 text-center">
                                {{ str_replace('_', ' ', $key) }}
                            </h4>
                            <p class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Monthly Sales Chart -->
            <section>
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6 flex items-center gap-2">
                    <i class="fas fa-chart-line text-blue-500"></i> Monthly Sales
                </h3>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
                    <canvas id="monthlySalesChart" class="w-full h-64"></canvas>
                </div>
            </section>

            <!-- Recent Reports -->
            <section>
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6 flex items-center gap-2">
                    <i class="fas fa-flag text-red-500"></i> Recent Reports
                </h3>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            <tr>
                                @foreach(['Reporter', 'Reported User', 'Reason', 'Status', 'Date'] as $header)
                                    <th class="px-6 py-4 text-left">{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($recentReports as $report)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                        <i class="fas fa-user mr-2 text-indigo-400"></i> {{ $report->reporter->fname }} {{ $report->reporter->lname }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                        {{ $report->reportedUser->fname }} {{ $report->reportedUser->lname }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $report->reason }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-4 py-2 inline-flex text-xs font-semibold rounded-full
                                            {{ $report->status === 'pending' ? 'bg-yellow-200 text-yellow-800' : 
                                               ($report->status === 'resolved' ? 'bg-green-200 text-green-900' : 'bg-red-200 text-red-800') }}">
                                            {{ ucfirst($report->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $report->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Recent Products -->
            <section>
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6 flex items-center gap-2">
                    <i class="fas fa-box-open text-green-500"></i> Recent Products
                </h3>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            <tr>
                                @foreach(['Product', 'Seller', 'Category', 'Price', 'Status', 'Date'] as $header)
                                    <th class="px-6 py-4 text-left">{{ $header }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($recentProducts as $product)
                                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $product->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $product->user->fname }} {{ $product->user->lname }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $product->category->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">${{ number_format($product->price, 2) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-4 py-2 inline-flex text-xs font-semibold rounded-full 
                                            {{ $product->status === 'active' ? 'bg-green-100 text-green-800' : 
                                               ($product->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $product->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('monthlySalesChart').getContext('2d');
        const monthlySalesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($salesMonths),
                datasets: [{
                    label: 'Sales ($)',
                    data: @json($salesData),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return '$' + tooltipItem.raw.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Sales ($)'
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
