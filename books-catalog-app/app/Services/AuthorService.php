<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    public function getFullName(Author $author): string
    {
        return $author->first_name . ' ' . $author->last_name;
    }
}
