<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Book $book): Response
    {
        return $user->role === 'admin' || $user->id === $book->user_id
            ? Response::allow()
            : Response::deny('You do not own this book.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Book $book): Response
    {
        return $user->role === 'admin' || $user->id === $book->user_id
            ? Response::allow()
            : Response::deny('You do not own this book.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Book $book): Response
    {
        return $user->role === 'admin' || $user->id === $book->user_id
            ? Response::allow()
            : Response::deny('You do not own this book.');
    }
}
