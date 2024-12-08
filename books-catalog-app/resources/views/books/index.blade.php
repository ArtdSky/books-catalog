<?php
/**
 * @var \Illuminate\Support\Collection $authors
 * @var \Illuminate\Support\Collection $books - Коллекция книг
 */
?>

@include('layouts.header')

<h1>Каталог книг</h1>
<form method="GET" action="{{ route('books.index') }}">
    <label for="authorFilter">Фильтр по автору:</label>
    <select id="authorFilter" name="author_id">
        <option value="">Все авторы</option>
        @foreach($authors as $author)
            <option value="{{ $author->id }}" {{ request('author_id') == $author->id ? 'selected' : '' }}>
                {{ $author->full_name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Применить</button>
</form>

<table>
    <thead>
    <tr>
        <th>Название книги</th>
        <th>Авторы</th>
        <th>Количество</th>
    </tr>
    </thead>
    <tbody>
    @forelse($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->full_authors }}</td>
            <td>{{ $book->authors->count() }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3">Нет книг для отображения.</td>
        </tr>
    @endforelse
    </tbody>
</table>

@include('layouts.footer')
