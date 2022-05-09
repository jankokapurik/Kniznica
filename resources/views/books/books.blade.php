@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg" >

            <form id="filter" action={{ route("books") }}>
                <div class="flex justify-center mb-4">
                    <x-search :values="$allBooks"></x-search>
                </div>
                <div class="flex">
                    <div class="mr-5">
                        <p>Filtrovať podľa jazyka</p>
                        <div id="filter_language">
                            @foreach ($languages as $language)
                                <input type="checkbox" name="language[]" value="{{ $language->id }}" >
                                <label for="{{$language->name}}">{{$language->name}}</label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p>Filtrovať podľa žánra</p>                
                        <div id="filter_genre">
                            @foreach ($genres as $genre)
                                <input type="checkbox" name="genre[]" value="{{ $genre->id }}" >
                                <label for="{{$genre->name}}">{{$genre->name}}</label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>

            <div class="w-full flex flex-row align-middle p-4 border-b border-gray-300">

            </div>
            <div id="mybox" class="p-4 mb-4 w-full flex flex-col divide-y divide-gray-300">
                @if($books->count())

                    @foreach($books as $book)
                        <x-book :book="$book"/> 
                    @endforeach 

                    {{ $books->links() }}
                     
                    @else
                    <p>Nie je žiadna kniha</p>
                @endif
            </div> 
        </div>
    </div>
@endsection