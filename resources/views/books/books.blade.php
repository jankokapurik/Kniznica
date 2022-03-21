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

            <div id="filter">
                <div id="filter_language">
                    <input type="checkbox" name="language" value="madarsky">
                    <label for="madarsky">madarsky</label>
                    <input type="checkbox" name="language" value="anglicky">
                    <label for="anglicky">anglicky</label>
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
                        {{-- <x-book :book="$books->find(32)"/> --}}
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

        document.getElementById("filter").addEventListener("change",filter);

        for(book of @json($books).data){
            console.log(book.language.name);
        
            if(book.language.name != 'Slovensky'){
                results.push("book"+book.id);
            }
        }

        // filter();
        function filter() {
            

            for (let index = 0; index < box.childElementCount; index++) {
                box.children[index].style.display = "flex";
            }

            for(result of results){
                elem = document.getElementById(result);
                elem.style.display = "none";
            }
        }

    </script>
    
@endsection