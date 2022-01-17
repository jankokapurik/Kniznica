@props([
    'name' => $id,
    'values' => $values,
    'books' => $books,
])

<div {{ $attributes->merge(['class' => 'relative']) }}>
    {{-- <form id="{{ $name }}-input-form" autocomplete="off" 
     method="get" class="flex items-center">
        @csrf --}}
            <div class="relative">
                <label for="search" class="sr-only">Name</label>
                <input autocomplete="off" id="{{ $name }}-input" type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500">
            </div>
        <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-1 rounded font-medium  hover:bg-blue-100 hover:text-blue-500 trasition duration-500">pridat</button>
    {{-- </form> --}}

    <div id="{{ $name }}-input-container" class="absolute transition bg-white inset-x-0 divide-y border-2 rounded-md">
        <div class="flex flex-col hover:bg-gray-200">
            {{-- <div>Meno knihy</div>
            <div> autor </div> --}}
        </div>
    </div>
</div>

<script>
    
    let oldbooks = [];
    @json($books).forEach(inp => {
        obj = new Object();
        // properties.forEach(property => {
        obj['id'] = inp['id'];
        obj['title'] = inp['title'];
        // });    
        values.push(obj);
    });

    console.log(oldbooks);



    autocomplete2(document.getElementById("{{$name}}-input"), @json($values), ['title', 'authors_lname', 'authors_fname']); //new version
</script>