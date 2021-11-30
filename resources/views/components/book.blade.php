@props(['book' => $book])

<div class="p-2 w-full ">
    <a href="{{ route('books.show', $book) }}">{{ $book->authors->fname }} {{ $book->authors->lname }}</a>
    <p>{{ $book->title }}</p>
    <p>{{ $book->languages->name }}</p>
    <p>{{ $book->quantity }}</p>
</div>