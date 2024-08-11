<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <x-alert type="success" :message="session('success')" />
    <x-alert type="error" :message="$errors->any() ? implode(', ', $errors->all()) : null" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 dark:text-white shadow sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-300">Manage Books</h3>

                    <!-- Filter by category -->
                    <form method="GET" action="{{ route('books.index') }}" class="max-w-sm mx-auto mb-4 text-center">
                        <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Filter by category
                        </label>
                        <select id="category_id" name="category_id" onchange="this.form.submit()"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </form>

                    <div class="flex items-center">
                        <!-- Export Dropdown -->
                        <div class="relative inline-block text-left mr-2">
                            <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                Export
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                    <li>
                                        <a href="{{ route('books.export-excel') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export to Excel</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('books.export-pdf') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export to PDF</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <a href="{{ route('books.create') }}">
                            <button type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M5 12h14m-7 7V5" />
                                </svg>
                                Create book
                            </button>
                        </a>
                    </div>
                </div>

                @if ($books->isEmpty())
                <p class="text-gray-600 dark:text-gray-400 text-center py-4">No books found.</p>
                @else
                <div class="overflow-x-auto">
                    <table id="books-table" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1">
                                    Title
                                </th>
                                <th data-priority="2">
                                    Description
                                </th>
                                <th data-priority="3">
                                    Category
                                </th>
                                <th data-priority="4">
                                    Quantity
                                </th>
                                <th data-priority="5">
                                    Cover Image
                                </th>
                                <th data-priority="6">
                                    File
                                </th>
                                @if (auth()->user()->role === 'admin')
                                <th data-priority="7">
                                    User Name
                                </th>
                                @endif
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td>
                                    {{ $book->title }}
                                </td>
                                <td>
                                    {{ $book->description }}
                                </td>
                                <td>
                                    {{ $book->category->name }}
                                </td>
                                <td>
                                    {{ $book->quantity }}
                                </td>
                                <td>
                                    @if ($book->cover_image_path)
                                    <a href="{{ asset('storage/' . $book->cover_image_path) }}"
                                        target="_blank">
                                        <img src="{{ asset('storage/' . $book->cover_image_path) }}"
                                            alt="Cover Image" class="mt-2 w-20 h-20 rounded">
                                    </a>
                                    @else
                                    No Image
                                    @endif
                                </td>
                                <td>
                                    @if ($book->file_path)
                                    <a href="{{ asset('storage/' . $book->file_path) }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        {{ basename($book->file_path) }}
                                    </a>
                                    @else
                                    No PDF
                                    @endif
                                </td>
                                @if (auth()->user()->role === 'admin')
                                <td>
                                    {{ $book->user->name }}
                                </td>
                                @endif
                                <td>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('books.view', $book->id) }}">
                                            <button type="button"
                                                class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="w-[18px] h-[18px] me-2 text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                View
                                            </button>
                                        </a>
                                        <a href="{{ route('books.edit', $book->id) }}">
                                            <button type="button"
                                                class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-800">
                                                <svg class="w-[18px] h-[18px] me-2 text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                </svg>
                                                Edit
                                            </button>
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this book?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-400 rounded-lg hover:bg-red-500 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-400 dark:hover:bg-red-500 dark:focus:ring-red-800">
                                                <svg class="w-[18px] h-[18px] me-2 text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="1.5"
                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#books-table').DataTable({
                    responsive: true,
                    searching: true,
                    columnDefs: [{
                        targets: -1,
                        orderable: false
                    }]
                }).columns.adjust()
                .responsive.recalc();
        });

        // function exportToPDF() {
        //     window.location.href = "{{ route('books.export-pdf') }}";
        // }
    </script>
</x-app-layout>
