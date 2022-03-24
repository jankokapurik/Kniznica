@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg" >
            
            {{-- <x-searchbar id="meno" class="w-64" :values="$allBooks"></x-searchbar> --}}
            <x-search :values="$allBooks"></x-search>

            <div id="filter">
                <p>Filtrovať podľa jazyka</p>
                <div id="filter_language">
                    @foreach ($languages as $language)
                        <input type="checkbox" name="language" value="{{$language->id}}">
                        <label for="{{$language->name}}">{{$language->name}}</label>
                    @endforeach
                </div>

                <p>Filtrovať podľa žáneru</p>                
                <div id="filter_genre">
                    @foreach ($genres as $genre)
                        <input type="checkbox" name="genre" value="{{$genre->id}}">
                        <label for="{{$genre->name}}">{{$genre->name}}</label>
                    @endforeach
                </div>
            </div>

            <div class=" w-full flex flex-row align-middle p-4 border-b border-gray-300">
                {{-- <form action="" method="GET" class="mr-4 space-x-6">                    
                    <button name="filter" value="title|ASC" class="hover:text-blue-500 transition duration-500 hover:underline">Názov ↓</button>
                    <button name="filter" value="title|DESC" class="hover:text-blue-500 transition duration-500 hover:underline">Názov ↑</button>
                    <button name="filter" value="fname|ASC" class="hover:text-blue-500 transition duration-500 hover:underline">Autor ↓</button>
                    <button name="filter" value="fname|DESC" class="hover:text-blue-500 transition duration-500 hover:underline">Autor ↑</button>
                </form> --}}

            </div>
            <div id="mybox" class="p-4 mb-4 w-full divide-y divide-gray-300 flex flex-col-reverse">
                @if($books->count())
                    @foreach($books as $book)
                        <x-book :book="$book"/> 
                    @endforeach 
                    @else
                    <p>Nie je ziadna kniha</p>
                @endif
            </div> 


        </div>
    </div>


    <script>
        let results = [];
        let bookgenres = [];
        bookgenres = new Object();

        @foreach ($books as $book)
            bookgenres[@json($book->id)] = @json($book->genres->pluck("id")->toArray());
        @endforeach

        document.getElementById("filter").addEventListener("change", function () {
            for(book of @json($books)){
                if(filter(book)) 
                    show(document.getElementById("book" + book.id));
                else 
                    hide(document.getElementById("book" + book.id));
            }
        });

        function filter(book){
            languages = [];
            genres = [];
            book_genres = bookgenres[book.id]
            
            // lang_inputs = ;
            for (lang_input of document.getElementById("filter_language").getElementsByTagName("input")) {
                if(lang_input.checked){
                    languages.push(parseInt(lang_input.value));
                }
            }

            for (genre_input of document.getElementById("filter_genre").getElementsByTagName("input")) {
                if(genre_input.checked){
                    genres.push(parseInt(genre_input.value));
                }
            }

            lan_filter = false;
            if(languages.length > 0){
                if(languages.includes(book.language.id)) lan_filter = true;    
            } 
            else lan_filter = true;
            
            gen_filter = false;
            if(genres.length > 0){
                for (book_genre of book_genres) {
                    if(genres.includes(book_genre)) gen_filter = true;
                }
            } 
            else gen_filter = true;

            return lan_filter && gen_filter;
        }
        
        function hide(element) {
            if(element.style.display != "none") element.style.display = "none";
        }

        function show(element) {
            if(element.style.display != "flex") element.style.display = "flex";
        }
    </script>
    
@endsection