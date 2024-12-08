<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Collection;

class BookRepository
{
    public function getAllBooksWithAuthors(): Collection
    {
        return Book::with('authors')->get();
    }

    public function getBooksByAuthorId($authorId): Collection
    {
        return Book::whereHas('authors', function ($query) use ($authorId) {
            $query->where('authors.id', $authorId);
        })->get();
    }
}
