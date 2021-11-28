@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg" >
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