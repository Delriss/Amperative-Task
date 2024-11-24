<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <!-- Title -->
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kanye Quotes') }}
            </h2>

            <!-- Refresh Button -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center p-3 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-md transition duration-200 transform hover:scale-105">
                <i class="fas fa-sync-alt text-lg"></i>
            </a>
        </div>
    </x-slot>

    <!-- Quotes -->
    <div class="py-12 bg">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-8 space-y-6">
                    <!-- Display Quotes -->
                    @foreach($quotes as $quote)
                    <div class="flex items-center space-x-4 p-4 bg-gradient-to-r from-blue-100 to-blue-50 dark:from-gray-700 dark:to-gray-800 rounded-lg shadow-md">
                        <div class="p-3 bg-blue-500 text-white rounded-full"></div>
                        <p class="text-gray-800 dark:text-gray-200 text-lg font-semibold italic">
                            "{{ $quote }}"
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    <div class="py-12 bg-gray-100 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg">
                <div class="p-8 space-y-6">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Using this App</h2>
                    <hr class="border-gray-200 dark:border-gray-700">
                    <p class="text-gray-800 dark:text-gray-200">Kanye Quotes is a simple web application that fetches random quotes from the Kanye West Quotes API available at <a href="https://kanye.rest" class="text-blue-500 hover:underline">kanye.rest</a>.</p>
                    <p class="text-gray-800 dark:text-gray-200">The application will generate unique randomised quotes on each load and via the refresh button at the top of the page.</p>
                    <p class="text-gray-800 dark:text-gray-200">You are able to access the local API endpoint at <code class="text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 p-1 rounded-md">/api/quotes</code> to get a random Kanye West quote.</p>
                    <p class="text-gray-800 dark:text-gray-200">Further, you are able to retrieve multiple results through adding a query parameter <code class="text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 p-1 rounded-md">count</code> to the endpoint. For example, <code class="text-gray-800 dark:text-gray-200 bg-gray-200 dark:bg-gray-700 p-1 rounded-md">/api/quotes?count=5</code> will return 5 random Kanye West quotes.</p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>