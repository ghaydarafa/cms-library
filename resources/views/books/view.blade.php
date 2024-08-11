<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Book') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto my-auto sm:px-6 lg:px-8">
        <div class="bg-gray shadow-md rounded-lg p-6">
            <div class="mb-4">
                <label for="title" class="block text-gray-800 dark:text-gray-200">Title:</label>
                <input disabled type="text" id="title" name="title" value="{{ old('title', $book->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-800 dark:text-gray-200">Description:</label>
                <textarea disabled id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="category_id" class="block text-gray-800 dark:text-gray-200">Category:</label>
                <input disabled type="text" id="category_id" name="category_id" value="{{ old('category_id', $book->category->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>

            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-gray-800 dark:text-gray-200">Quantity:</label>
                <input disabled type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>

            <div class="mb-4">
                <label for="file_path" class="block text-gray-800 dark:text-gray-200">File (PDF):</label>
                @if ($book->file_path)
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($book->file_path) }}</a>
                </p>
                @else
                No PDF
                @endif
            </div>

            <div class="mb-4">
                <label for="cover_image_path" class="block text-gray-800 dark:text-gray-200">Cover Image:</label>
                @if ($book->cover_image_path)
                <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="Cover Image" class="max-w-44 max-h-52 rounded">
                @else
                No cover image
                @endif
            </div>

            @if (auth()->user()->role === 'admin')
            <div class="mb-4">
                <label for="user" class="block text-gray-800 dark:text-gray-200">User Name:</label>
                <input disabled type="text" id="user" name="user" value="{{ $book->user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
