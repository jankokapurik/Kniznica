@props(['book' => $book])

<div class="p-2 w-full flex">
    <img src="{{ asset('/storage/images/knihy/'.$book->image) }}" height="200" width="100"alt="kniha" class="mr-4">
    <div>
        <a href="{{ route('books.show', $book) }}"><strong>{{ $book->author->fname }} {{ $book->author->lname }}</strong></a>
        <p><strong>{{ $book->title }}</strong></p>
        <p>{{ $book->language->name }}</p>
        <p>{{ $book->quantity }}</p>
        <p class="text-gray-600 p-1">
            @forelse ($book->genres as $genre)
                {{ $genre->name, }}
            @empty
                Nie sú pridané žánre
            @endforelse  
        </p>
        <p>Hodnotenie: </p>
    </div>
</div>