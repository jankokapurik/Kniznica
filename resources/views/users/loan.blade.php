@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center w-full ">
        <div class="w-8/12 bg-white ml-6 mt-6 p-6 rounded-l-lg" >
            @if ($user->loan)
                <h1 class="font-bold text-3xl mb-2">Tvoja vypozicka</h1>
                <div class="mb-4 ml-4"> 
                    <p>Vypozicanych knih: {{ $user->loan->books->count() }}</p>
                    <p>Vypozicane od: {{ $user->loan->from }}</p>
                    <p>Vypozicane do: {{ $user->loan->to }}</p>
                </div>
                <h1 class="font-bold text-3xl mb-2">Vypozicane knihy</h1>
                @foreach ($user->loan->books as $book)
                    <div class="p-2 w-full flex"><img src="{{ asset('/images/'.$book->image) }}" height="200" width="100"alt="kniha" class="mr-4">
                        <div>
                            <a href="{{ route('books.show', $book) }}"><strong>{{ $book->author->fname }} {{ $book->author->lname }}</strong></a>
                            <p><strong>{{ $book->title }}</strong></p>
                    
                            <div class="flex">            
                                @if ($book->countComments())
                                    <span class="pr-1">{{ round($a = $book->rating(),1) }}</span>
                                    <x-ratingbar :rating="round($a)"/>    
                                @else
                                    <span>nie je hodnotene</span>
                                @endif    
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
                        @if($user->loan->approved == 0)
                            <form action="{{ route('loan.deletebook', ['user' => auth()->user(), 'book' => $book]) }}" method="get">
                                <button class="p-2 bg-blue-500 text-white border-2 border-blue-500 rounded-lg hover:text-blue-500 hover:bg-blue-100">Odstranit</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @else
                <h1 class="font-bold text-3xl mb-4">Nemate vypozicane knihy</h1>
                <form action="{{ route('books') }}" method="get">
                    <button class="bg-blue-500 text-white border-2 border-blue-500 p-2 rounded-lg hover:bg-blue-100 hover:text-blue-500">Katalog knih</button>
                </form>
            @endif
    </div>
@endsection
