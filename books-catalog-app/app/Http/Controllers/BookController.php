<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFilterRequest;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Services\AuthorService;
use Illuminate\Contracts\View\View;

class BookController extends Controller
{
    private BookRepository $bookRepository;
    private AuthorRepository $authorRepository;
    private AuthorService $authorService;

    public function __construct(
        AuthorRepository $authorRepository,
        BookRepository $bookRepository,
        AuthorService $authorService
    ) {
        $this->authorRepository = $authorRepository;
        $this->bookRepository = $bookRepository;
        $this->authorService = $authorService;
    }

    public function index(BookFilterRequest $request): View
    {
        $data = $request->validated();
        $authors = $this->authorRepository->getAllAuthors();
        $books = $this->bookRepository->getAllBooksWithAuthors();

        foreach ($authors as $author) {
            $author->full_name = $this->authorService->getFullName($author);
        }

        if (isset($data['author_id'])) {
            $books = $this->bookRepository->getBooksByAuthorId($data['author_id']);
        }

        foreach ($books as $book) {
            $book->full_authors = $book->authors->map(function (Author $author): string {
                return $this->authorService->getFullName($author);
            })->implode(', ');
        }

        return view('books.index', compact('books', 'authors'));
    }
}
