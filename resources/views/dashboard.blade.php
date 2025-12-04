<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 flex items-center justify-between transition duration-300 hover:shadow-2xl">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Total Products
                        </p>
                        <p class="text-4xl font-bold text-gray-900">
                            {{ number_format($totalProducts) }}
                        </p>
                    </div>
                    
                    <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 flex items-center justify-between transition duration-300 hover:shadow-2xl">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Total Categories
                        </p>
                        <p class="text-4xl font-bold text-gray-900">
                            {{ number_format($totalCategories) }}
                        </p>
                    </div>
                    
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                </div>

            </div>

            
            
        </div>
    </div>
</x-app-layout>