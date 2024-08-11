<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
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

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Description',
            'Quantity',
            'File path',
            'Cover image path',
            'Category',
            'User'
        ];
    }
}
