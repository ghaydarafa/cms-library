<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @if(auth()->user()->role === 'admin')
                    <h1 class="text-2xl font-bold mb-6">{{ __("You're logged in as admin!") }}</h1>
                    @else
                    <h1 class="text-2xl font-bold mb-6">{{ __("You're logged in!") }}</h1>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Books Card -->
                        <a href="{{ route('books.index') }}" class="block bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                            <div class="p-6">
                                <svg class="w-12 h-12 mb-4 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023" />
                                </svg>
                                <h3 class="text-lg font-semibold mb-2">Books</h3>
                                <p class="text-sm">Manage and view all books in the library.</p>
                            </div>
                        </a>

                        <!-- Categories Card -->
                        <a href="{{ route('categories.index') }}" class="block bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                            <div class="p-6">
                                <svg class="w-12 h-12 mb-4 mx-auto text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6Zm4.996 2a1 1 0 0 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 8a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 11a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Zm-4.004 3a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01ZM11 14a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2h-6Z" />
                                </svg>
                                <h3 class="text-lg font-semibold mb-2">Categories</h3>
                                <p class="text-sm">View and manage all categories in the library.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
