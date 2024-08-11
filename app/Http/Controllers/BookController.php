<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BooksExport;
use Barryvdh\DomPDF\Facade\Pdf;

class BookController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();
    $categories = Category::all();

    $query = Book::with(['category', 'user']);

    if ($request->has('category_id') && $request->category_id != '') {
        $query->where('category_id', $request->category_id);
    }

    if ($user->role !== 'admin') {
        $query->where('user_id', $user->id);
    }

    $books = $query->get();

    return view('books.index', compact('books', 'categories'));
}

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'file_path' => 'nullable|file|mimes:pdf|max:10000',
            'cover_image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:1404',
            'category_id' => 'required|exists:categories,id',
        ]);

        $bookData = $request->except(['file_path', 'cover_image_path']);

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $originalFileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('books', $originalFileName, 'public');
            $bookData['file_path'] = $filePath;
        }

        if ($request->hasFile('cover_image_path')) {
            $image = $request->file('cover_image_path');
            $originalImgName = $image->getClientOriginalName();
            $coverImagePath = $image->storeAs('covers', $originalImgName, 'public');
            $bookData['cover_image_path'] = $coverImagePath;
        }

        $bookData['user_id'] = Auth::id();

        Book::create($bookData);

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    public function view($id)
    {
        $book = Book::with('category', 'user')->findOrFail($id);

        Gate::authorize('view', $book);

        return view('books.view', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        Gate::authorize('update', $book);

        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        Gate::authorize('update', $book);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'file_path' => 'nullable|file|mimes:pdf|max:10000',
            'cover_image_path' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
            'category_id' => 'required|exists:categories,id',
        ]);

        $bookData = $request->except(['file_path', 'cover_image_path']);

        if ($request->hasFile('file_path')) {
            if ($book->file_path) {
                Storage::disk('public')->delete($book->file_path);
            }
            $file = $request->file('file_path');
            $originalFileName = $file->getClientOriginalName();
            $filePath = $file->storeAs('books', $originalFileName, 'public');
            $bookData['file_path'] = $filePath;
        }

        if ($request->hasFile('cover_image_path')) {
            $image = $request->file('cover_image_path');
            $originalImgName = $image->getClientOriginalName();
            $coverImagePath = $image->storeAs('covers', $originalImgName, 'public');
            $bookData['cover_image_path'] = $coverImagePath;
        }

        $book->update($bookData);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        Gate::authorize('delete', $book);

        if ($book->file_path) {
            Storage::disk('public')->delete($book->file_path);
        }

        if ($book->cover_image_path) {
            Storage::disk('public')->delete($book->cover_image_path);
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportExcel()
    {
        return Excel::download(new BooksExport, 'books.xlsx');
    }

    public function exportPdf()
    {
        $query = Book::query()
            ->with(['user', 'category'])
            ->select('books.id', 'books.title', 'books.description', 'books.quantity', 'books.file_path', 'books.cover_image_path', 'categories.name as category_name', 'users.name as user_name')
            ->join('users', 'books.user_id', '=', 'users.id')
            ->join('categories', 'books.category_id', '=', 'categories.id');

        $user = Auth::user();
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        $books = $query->get();

        $pdf = Pdf::loadView('books.pdf', compact('books'))
        ->setPaper('a4', 'portrait');

        return $pdf->download('books.pdf');
    }
}
