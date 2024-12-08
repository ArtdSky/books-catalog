<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Support\Collection;

class AuthorRepository
{

    public function getAllAuthors(): Collection
    {
        return Author::all();
    }

}
