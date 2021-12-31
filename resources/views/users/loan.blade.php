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
                    <p><x-book :book="$book" /></p>
                @endforeach
            @else
                <h1 class="font-bold text-3xl mb-4">Nemate vypozicane knihy</h1>
                <form action="{{ route('books') }}" method="get">
                    <button class="bg-blue-500 text-white border-2 border-blue-500 p-2 rounded-lg hover:bg-blue-100 hover:text-blue-500">Katalog knih</button>
                </form>
            @endif
    </div>
@endsection
