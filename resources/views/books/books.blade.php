@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg" >
            {{-- <form action="{{ route("books") }}" method="GET" class="p-4 border-b border-gray-500">
                <label for="filter">Zoradiť podľa</label>
                <select name="filter">
                    <optgroup label="Zoradiť">
                        <option value="title|ASC">A-Z</option>
                        <option value="title|DESC">Z-A</option>
                        <option value="fname|ASC">Autori A-Z</option>
                        <option value="fname|DESC">Autori Z-A</option>
                    </optgroup>
                </select>
                <button>Zorad</button>
            </form> --}}
            {{-- <div class="bg-red-200 w-full"> --}}                
            {{-- </div> --}}
            {{-- <x-searchbar id="meno" class="w-64" :values="$allBooks"></x-searchbar> --}}
                {{-- <x-search :values="$allBooks"></x-search> --}}

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
                <form action="" method="GET" class="mr-4 space-x-6">
                    
                    <button name="filter" value="title|ASC" class="hover:text-blue-500 transition duration-500 hover:underline">Názov ↓</button>
                    <button name="filter" value="title|DESC" class="hover:text-blue-500 transition duration-500 hover:underline">Názov ↑</button>
                    <button name="filter" value="fname|ASC" class="hover:text-blue-500 transition duration-500 hover:underline">Autor ↓</button>
                    <button name="filter" value="fname|DESC" class="hover:text-blue-500 transition duration-500 hover:underline">Autor ↑</button>
                </form>

            </div>
            <div id="mybox" class="p-4 mb-4 w-full divide-y divide-gray-300">
                @if($books->count())
                    
                    @foreach($books->sortByDesc('authors.fname') as $book)

                            {{-- {{dd($book->genres->pluck("name")->toArray())}} --}}
                            {{-- {{dd($book->genres->pluck("name"))}} --}}
                        <x-book :book="$book"/>
                    @endforeach

                    {{ $books->links() }}
                @else
                    <p>Nie je ziadna kniha</p>
                @endif
            </div>
        </div>
    </div>


    <script>
        let results = [];
        let box = document.getElementById("mybox");
        let bookgenres = [];

        bookgenres = new Object();  
        @foreach ($books as $book)
            bookgenres[@json($book->id)] = @json($book->genres->pluck("id")->toArray());
        @endforeach

        console.log(bookgenres);

        document.getElementById("filter").addEventListener("change", filterBooks);

        for(book of @json($books).data){
            results = [];
            if(book.language.name != 'Slovensky'){
                results.push("book" + book.id); //to hide
            }
        }

        function filterBooks() {
            for (let index = 0; index < box.childElementCount; index++) {
                box.children[index].style.display = "none";
            }

            for(book of @json($books).data){
                if(filter(book)){
                    elem = document.getElementById("book"+book.id);
                    elem.style.display = "flex";
                }
            }
        }




        function filter(book){
            languages = [];
            lang_inputs = document.getElementById("filter_language").getElementsByTagName("input");
            for (lang_input of lang_inputs) {
                if(lang_input.checked){
                    languages.push(lang_input.value);
                }
            }



            genre_inputs = document.getElementById("filter_genre").getElementsByTagName("input");
            for (genre_input of genre_inputs) {
                if(genre_input.checked){
                    languages.push(genre_input.value);
                }
            }


            if(languages.length > 0){
                if(!languages.includes(book.language.id.toString())) return false;
            }


            // if(genres.length > 0){
            //     if(!genres.includes(book.genre.id.toString())) return false;
            // }

            return true;
        }

    </script>
    
@endsection