@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="bg-white w-full mt-6 ml-6 p-6 rounded-l-lg" >
            <form action="{{ route("author.create") }}" class="mb-4">
                @csrf
                <button type="submit" class="bg-green-500 border-2 border-green-500 p-2 rounded-md text-white hover:bg-green-600 trasition duration-500">Pridať nového autora</button>
            </form> 
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b-2 border-gray-500">
                        <th class="p-1">Meno</th>
                        <th class="p-1">Priezvisko</th>
                        <th class="p-1">Akcie</th>
                    </tr>
                </thead>
                <thead>
                    @if($authors->count())
                    @foreach($authors as $author)
                    <tr class="even:bg-gray-100 border-t border-gray-500">
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <h2 class="font-bold text-gray-900 p-1">{{ $author->fname }} </h2>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p-1">{{ $author->lname }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <form action="{{ route('author.edit', $author->id) }}" class="m-1">
                                    <button class="bg-blue-500 border border-blue-500 p-1 rounded-md text-white hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Upraviť</button>
                                </form>
                                <form action="{{ route('author.destroy', $author) }}" method="post" class="m-1">
                                    
                                    @csrf   
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 border border-red-500 p-1 rounded-md text-white hover:bg-red-100 hover:text-red-500 trasition duration-500">Vymazať</button>
                                </form>
                            </div>
                        </td>
                        </tr>
                        @endforeach
                        @else
                    <p>Nie sú žiadny autori</p>
                    @endif
                </thead>
            </table>
        </div>
    </div>
@endsection
        