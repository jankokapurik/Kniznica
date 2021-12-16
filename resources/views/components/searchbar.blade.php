@props([
    'name' => $id,
    'values' => $values
])

<div {{ $attributes }}>
    <form autocomplete="off" action="{{ route('search2') }}" method="get" class="flex items-center">
        @csrf
            <div class="relative">
                <label for="search" class="sr-only">Name</label>
                <input id="{{ $name }}-input" type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500">
            </div>
        <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-1 rounded font-medium  hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Hľadaj</button>
    </form>
</div>

<script src="{{ URL::asset('js/autocomplete.js') }}"></script>
<script>
    autocomplete(document.getElementById("{{$name}}-input"), @json($values));
</script>