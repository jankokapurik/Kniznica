@extends('layouts.kniznica')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg" >
            <div class="mb-4 flex justify-start">
                @if($books->count())
                    @foreach($books as $book)
                        <div class="bg-gray-200 m-2 rounded-lg p-2 w-1/4">
                            <p>{{ $book->authors->firstName }} {{ $book->authors->lastName }}</p>
                            <p>{{ $book->title }}</p>
                            <p>{{ $book->languages->language }}</p>
                            <p>{{ $book->quantity }}</p>
                        </div>
                    @endforeach
                @else
                    <p>Nie je ziadna kniha</p>
                @endif
            </div>
        </div>
    </div>
@endsection