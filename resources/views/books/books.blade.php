@extends('layouts.userLayout')

@section('content')

    <form class="flex justify-center" action={{ route("books") }}>
        <div class="w-8/12 bg-white p-6 rounded-lg" >

            <div>
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
            </div>

            <div class="w-full flex flex-row align-middle p-4 border-b border-gray-300">

            </div>
            <div id="mybox" class="p-4 mb-4 w-full flex flex-col divide-y divide-gray-300">
                @if($books->count())

                    @foreach($books as $book)
                        <x-book :book="$book"/> 
                    @endforeach 

                    {{-- {{ $books->links() }} --}}

                    {{-- {{dd($paginator['pagesCount'])}} --}}

                    <div>
                        @foreach ($paginator['pages'] as $page)
                            @if ($page == $paginator['actualPage'])
                                <input type="radio" id={{ $page }} name="page" value={{ $page }}>
                                <label for={{ $page }}><strong>{{ $page }}</strong></label>
                            @else
                                <input type="radio" id={{ $page }} name="page" value={{ $page }}>
                                <label for={{ $page }}>{{ $page }}</label>
                            @endif
                        @endforeach
                    </div>
                     
                    @else
                    <p>Nie je žiadna kniha</p>
                @endif
            </div> 
        </div>
    </form>
@endsection