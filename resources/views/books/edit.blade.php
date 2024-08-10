<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Book') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-7xl mx-auto my-auto sm:px-6 lg:px-8">
        <div class="bg-gray shadow-md rounded-lg p-6">
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="title" class="block text-gray-800 dark:text-gray-200">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-800 dark:text-gray-200">Description:</label>
                    <textarea id="description" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $book->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="block text-gray-800 dark:text-gray-200">Category:</label>
                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="quantity" class="block text-gray-800 dark:text-gray-200">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>

                <div class="mb-4">
                    <label for="file_path" class="block text-gray-800 dark:text-gray-200">Upload File (PDF):</label>
                    <input type="file" id="file_path" name="file_path" class="text-gray mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" accept="application/pdf">
                    @if ($book->file_path)
                        <p class="mt-2 text-gray-600">
                            Current file: <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank" class="text-blue-600 hover:underline">{{ basename($book->file_path) }}</a>
                        </p>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="cover_image_path" class="block text-gray-800 dark:text-gray-200">Upload Cover Image:</label>
                    <input type="file" id="cover_image_path" name="cover_image_path" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" accept="image/*">
                    @if ($book->cover_image_path)
                        <div class="mt-2">
                            <p class="text-gray-600">Current cover:</p>
                            <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="Cover Image" class="mt-2 max-w-50 max-h-40 rounded">
                        </div>
                    @endif
                </div>

                <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-800" style="background-color: #4f46e5 !important;">
                    Update Book
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
