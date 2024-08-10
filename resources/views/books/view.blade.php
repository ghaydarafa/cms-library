<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View category') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto my-auto sm:px-6 lg:px-8">
        <div class="bg-gray shadow-md rounded-lg p-6">
            <div class="mb-4">
                <label for="name" class="block text-gray-800 dark:text-gray-200">Name:</label>
                <input type="text" id="name" name="name" disabled value="{{ $category->name }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required>
            </div>
        </div>

    </div>

</x-app-layout>
