@props(['book' => $book])

<div class="p-2 w-full flex">
    <img src="{{ asset('/images/'.$book->image) }}" height="200" width="100"alt="kniha" class="mr-4">
    <div>
        <a href="{{ route('books.show', $book) }}"><strong>{{ $book->author->fname }} {{ $book->author->lname }}</strong></a>
        <p><strong>{{ $book->title }}</strong></p>

        <div class="flex">
            <span class="pr-1">{{ round($a = $book->rating(),1) }}</span>
            <x-ratingbar :rating="round($a)"/>
        </div>



        <p>{{ $book->language->name }}</p>
        <p @if (!$book->quantity)
            class="text-red-400"
            @else
            class="text-green-700"
        @endif>{{ $book->quantity }} ks</p>

        <p class="text-gray-600 p-1">
            @forelse ($book->genres as $genre)
                {{ $genre->name, }}
            @empty
                Nie sú pridané žánre
            @endforelse  
        </p>
    </div>
</div>