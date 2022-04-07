@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg" >
            
            {{-- <x-searchbar id="meno" class="w-64" :values="$allBooks"></x-searchbar> --}}
            

            <div id="filter">
                <div class="flex justify-center mb-4">
                    <x-search :values="$allBooks"></x-search>
                </div>
                <div class="flex">
                    <div class="mr-5">
                        <p>Filtrovať podľa jazyka</p>
                        <div id="filter_language">
                            @foreach ($languages as $language)
                            <input type="checkbox" name="language" value="{{$language->id}}">
                            <label for="{{$language->name}}">{{$language->name}}</label>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <p>Filtrovať podľa žáneru</p>                
                        <div id="filter_genre">
                            @foreach ($genres as $genre)
                            <input type="checkbox" name="genre" value="{{$genre->id}}">
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
                    @else
                    <p>Nie je žiadna kniha</p>
                @endif
            </div> 
        </div>
    </div>


    <script>
        let results = [];
        let bookgenres = [];
        let input_text = "";
        bookgenres = new Object();

        @foreach ($books as $book)
            bookgenres[@json($book->id)] = @json($book->genres->pluck("id")->toArray());
        @endforeach

        document.getElementById("filter").addEventListener("change", updateBooks);

        

        function updateBooks () {
            for(book of @json($books)){
                if(filter(book)) 
                    show(document.getElementById("book" + book.id));
                else 
                    hide(document.getElementById("book" + book.id));
            }
        }

        function filter(book){
            console.log("Trigger");
            // console.log(book);
            languages = [];
            genres = [];
            book_genres = bookgenres[book.id];
            console.log(input_text);
            input_text = document.getElementById("searchInput").value;
            
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

            key_filter = false;
            if(input_text.length > 0){
                if(book.title.toLowerCase().includes(input_text.toLowerCase())){
                    key_filter = true;
                    console.log("T");
                }
                // else if(book.author.fname.toLowerCase().includes(input_text.toLowerCase())) key_filter = true;
                // else if(book.author.lname.toLowerCase().includes(input_text.toLowerCase())) key_filter = true;
            } 
            else key_filter = true;

            return (lan_filter && gen_filter) && key_filter;
        }
        
        function hide(element) {
            if(element.style.display != "none") element.style.display = "none";
        }

        function show(element) {
            if(element.style.display != "flex") element.style.display = "flex";
        }
    </script>
    
@endsection