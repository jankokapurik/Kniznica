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

            <div>
                <input type="checkbox" name="language" value="madarsky">
                <label for="madarsky">madarsky</label>
                <input type="checkbox" name="language" value="anglicky">
                <label for="anglicky">anglicky</label>
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
                        <x-book :book="$books->find(32)"/>

                        @php

                            // dd($book);
                            // dd($books->find(32));
                            // dd($books->find('id', 32));
                        @endphp

                    @endforeach

                    {{ $books->links() }}
                @else
                    <p>Nie je ziadna kniha</p>
                @endif
            </div>
        </div>
    </div>


    {{-- <script>
        for(book of @json($books).data){
            console.log(book);
            generate(book);
        }

        function generate(book) {
            box = document.getElementById("mybox");
            box.innerHTML = ""; //clear
            
            child = document.createElement("div");
            child.innerHTML = "Texk";

            box.appendChild(child);
            console.log(box.innerHTML);
        }

    </script> --}}
@endsection