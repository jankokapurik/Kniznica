@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg" >
            {{-- <div class="mb-4 flex flex-none flex-wrap w-full">
                @if($books->count())
                    @foreach($books as $book)
                        <div class="bg-gray-300 m-2 rounded-lg p-2 w-72 h-72">
                            <p>{{ $book->authors->firstName }} {{ $book->authors->lastName }}</p>
                            <p>{{ $book->title }}</p>
                            <p>{{ $book->languages->language }}</p>
                            <p>{{ $book->quantity }}</p>
                        </div>
                    @endforeach
                @else
                    <p>Nie je ziadna kniha</p>
                @endif
            </div> --}}

            <div class="p-4 mb-4 w-full divide-y divide-gray-300">
                @if($books->count())
                    @foreach($books as $book)
                        <x-book :book="$book" />
                    @endforeach

                    {{ $books->links() }}
                @else
                    <p>Nie je ziadna kniha</p>
                @endif
            </div>
        </div>
    </div>
@endsection