<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\Book;

class BooksAndAuthorsSeeder extends Seeder
{
    public function run()
    {
        $authorsData = [
            ['first_name' => 'Стив', 'last_name' => 'Макконнелл'],
            ['first_name' => 'Михаил', 'last_name' => 'Фленов'],
            ['first_name' => 'Мэтт', 'last_name' => 'Стаффер'],
            ['first_name' => 'Дэвид', 'last_name' => 'Скляр'],
            ['first_name' => 'Адам', 'last_name' => 'Трахтенберг'],
            ['first_name' => 'Бэрон', 'last_name' => 'Шварц'],
            ['first_name' => 'Вадим', 'last_name' => 'Ткаченко'],
            ['first_name' => 'Петр', 'last_name' => 'Зайцев'],
            ['first_name' => 'Ральф', 'last_name' => 'Джонсон'],
            ['first_name' => 'Джон', 'last_name' => 'Влиссидес'],
            ['first_name' => 'Ричард', 'last_name' => 'Хелм'],
            ['first_name' => 'Эрих', 'last_name' => 'Гамма'],
        ];

        foreach ($authorsData as $authorData) {
            Author::create($authorData);
        }

        $createdAuthors = Author::all();

        $book1 = Book::create(['title' => 'Совершенный код']);
        $book1->authors()->attach($createdAuthors->where('first_name', 'Стив')->where('last_name', 'Макконнелл')->first()->id);

        $book2 = Book::create(['title' => 'PHP глазами хакера']);
        $book2->authors()->attach($createdAuthors->where('first_name', 'Михаил')->where('last_name', 'Фленов')->first()->id);

        $book3 = Book::create(['title' => 'Laravel. Полное руководство']);
        $book3->authors()->attach($createdAuthors->where('first_name', 'Мэтт')->where('last_name', 'Стаффер')->first()->id);

        $book4 = Book::create(['title' => 'PHP. Рецепты программирования']);
        $book4->authors()->attach([
            $createdAuthors->where('first_name', 'Дэвид')->where('last_name', 'Скляр')->first()->id,
            $createdAuthors->where('first_name', 'Адам')->where('last_name', 'Трахтенберг')->first()->id,
        ]);

        $book5 = Book::create(['title' => 'MySQL по максимуму']);
        $book5->authors()->attach([
            $createdAuthors->where('first_name', 'Бэрон')->where('last_name', 'Шварц')->first()->id,
            $createdAuthors->where('first_name', 'Вадим')->where('last_name', 'Ткаченко')->first()->id,
            $createdAuthors->where('first_name', 'Петр')->where('last_name', 'Зайцев')->first()->id,
        ]);

        $book6 = Book::create(['title' => 'Паттерны объектно-ориентированного программирования']);
        $book6->authors()->attach([
            $createdAuthors->where('first_name', 'Ральф')->where('last_name', 'Джонсон')->first()->id,
            $createdAuthors->where('first_name', 'Джон')->where('last_name', 'Влиссидес')->first()->id,
            $createdAuthors->where('first_name', 'Ричард')->where('last_name', 'Хелм')->first()->id,
            $createdAuthors->where('first_name', 'Эрих')->where('last_name', 'Гамма')->first()->id,
        ]);
    }
}
