<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Book') }}
        </h2>
    </x-slot>

    <x-alert type="success" :message="session('success')" />
    <x-alert type="error" :message="$errors->any() ? implode(', ', $errors->all()) : null" />


    <div class="max-w-7xl mx-auto my-auto sm:px-6 lg:px-8">
        <div class="bg-gray shadow-md rounded-lg p-6">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="title" class="block text-gray-800 dark:text-gray-200">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-800 dark:text-gray-200">Description:</label>
                    <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-gray-800 dark:text-gray-200">Category:</label>
                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block text-gray-800 dark:text-gray-200">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>

                <div class="mb-4">
                    <label for="file_path" class="block text-gray-800 dark:text-gray-200">Upload File (PDF) (Max 10 MB):</label>
                    <input type="file" id="file_path" name="file_path" class="text-gray mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" accept="application/pdf">
                </div>

                <div class="mb-4">
                    <label for="cover_image_path" class="block text-gray-800 dark:text-gray-200">Upload Cover Image (Max 10 MB):</label>
                    <input type="file" id="cover_image_path" name="cover_image_path" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" accept="image/*">
                </div>

                <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-800" style="background-color: #4f46e5 !important;">
                    Create Book
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
