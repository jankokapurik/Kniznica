@props([
    'values' => $values,
    'oldbooks' => $books,
])

<div id="book_list" class="flex flex-col">
    @foreach ($oldbooks as $book)
        <div class="bg-gray-200 p-1 rounded mt-2">
            <p>{{$book->title}}</p>
        </div>
    @endforeach

    <div id="new_book" class="bg-gray-500 text-white p-1 rounded mt-2">  
        <p id="info">pridat knihu</p>

        <div id="form" class="hidden">
            <input id="input_field" type="text" class="text-black"> 
            <button onclick="add_book()" class="bg-white text-black rounded-sm text-sm p-0.5">pridat</button>
        </div>
    </div>
</div>
<script>
    var global_books = [];
    @json($values).forEach(inp => {
        global_books.push(inp['title']);
    });

    console.log(global_books);
    
    document.getElementById("new_book").onclick = open_search;

    document.getElementById("input_field").onkeypress = function(e){
        if (e.code == "Enter") add_book();
    }


    function open_search(e){
        e.preventDefault();
        parent = document.getElementById("new_book");
        info = document.getElementById("info");
        form = document.getElementById("form");
        input_field = document.getElementById("input_field");

        parent.onclick = "";
        info.className = "hidden"; 
        form.className = "block";    
        input_field.focus();

        return false;
    }

    function close_search(e){
        parent = document.getElementById("new_book");
        info = document.getElementById("info");
        form = document.getElementById("form");        

        setTimeout(() => {
            parent.onclick = open_search;    
        }, 50);

        info.className = "block"; //switchblock
        form.className = "hidden"; //switch   
    }

    function add_book(){
        book_list = document.getElementById("book_list");
        new_book =  document.getElementById("new_book");

        value = document.getElementById("input_field").value;

        div = document.createElement("div");
        div.className = "bg-blue-200 p-1 rounded mt-2";
        p = document.createElement("p");
        p.innerHTML = value;

        div.appendChild(p);
        book_list.insertBefore(div, new_book);

        close_search();

        global_books.push(value);

        document.getElementById("input_field").value = "";

        console.log(global_books);
    }

</script>





{{-- <div id='add' class="bg-green-200 p-1 rounded mt-2">
    pridat                    
</div> --}}

{{-- <div {{ $attributes->merge(['class' => 'relative']) }}>

            <div class="relative">
                <label for="search" class="sr-only">Name</label>
                <input autocomplete="off" id="{{ $name }}-input" type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500">
            </div>
        <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-1 rounded font-medium  hover:bg-blue-100 hover:text-blue-500 trasition duration-500">pridat</button>


    <div id="{{ $name }}-input-container" class="absolute transition bg-white inset-x-0 divide-y border-2 rounded-md">
        <div class="flex flex-col hover:bg-gray-200">

        </div>
    </div>
</div> --}}

{{-- // let oldbooks = [];
// @json($books).forEach(inp => {
//     obj = new Object();
//     // properties.forEach(property => {
//     obj['id'] = inp['id'];
//     obj['title'] = inp['title'];
//     // });    
//     values.push(obj);
// });



// autocomplete2(document.getElementById("{{$name}}-input"), @json($values), ['title', 'authors_lname', 'authors_fname']); //new version --}}
