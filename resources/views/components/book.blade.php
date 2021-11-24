@props(['book' => $book])

<div class="p-2 w-full ">
    <p>{{ $book->authors->firstName }} {{ $book->authors->lastName }}</p>
    <p>{{ $book->title }}</p>
    <p>{{ $book->languages->language }}</p>
    <p>{{ $book->quantity }}</p>
</div>