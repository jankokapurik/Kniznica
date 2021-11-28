@props(['book' => $book])

<div class="p-2 w-full ">
    <a href="{{ route('books.show', $book) }}">{{ $book->authors->firstName }} {{ $book->authors->lastName }}</a>
    <p>{{ $book->title }}</p>
    <p>{{ $book->languages->language }}</p>
    <p>{{ $book->quantity }}</p>
</div>