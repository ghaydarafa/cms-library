<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update category') }}
        </h2>
    </x-slot>

    <x-alert type="success" :message="session('success')" />
    <x-alert type="error" :message="$errors->any() ? implode(', ', $errors->all()) : null" />

    <div class="max-w-7xl mx-auto my-auto sm:px-6 lg:px-8">
        <div class="bg-gray shadow-md rounded-lg p-6">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-gray-800 dark:text-gray-200">Name:</label>
                    <input type="text" id="name" name="name" value="{{ $category->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                </div>
                <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-800" style="background-color: #4f46e5 !important;">
                    Update category
                </button>
            </form>
        </div>

    </div>

</x-app-layout>
