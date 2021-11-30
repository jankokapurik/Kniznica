@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form action="" method="post" class="mb-4">
                @csrf
                <button type="submit" class="bg-green-500 p-2 rounded-md text-white">Pridať novú knihu</button>
            </form> 
            <table class="border border-gray-800 w-full">
                <tr>
                    <th class="border border-gray-600 p-1">Autor</th>
                    <th class="border border-gray-600 p-1">Názov</th>
                    <th class="border border-gray-600 p-1">Dátum vydania</th>
                    <th class="border border-gray-600 p-1">Množstvo</th>
                    <th class="border border-gray-600 p-1">Jazyk</th>
                    <th class="border border-gray-600 p-1">Akcie</th>
                </tr>
                @if($books->count())
                    @foreach($books as $book)
                        <tr>
                            <td class="border border-gray-600">
                                <h2 class="font-bold text-gray-900 p-1">{{ $book->authors->fname }} {{ $book->authors->lname }}</h2>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p-1">{{ $book->title }}</p>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p1">{{ $book->releaseDate }}</p>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p-1">{{ $book->quantity}}</p>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p-1">{{ $book->languages->name }}</p>
                            </td>
                            <td class="border border-gray-600 flex flex-row">
                                <form action="{{ route('book.edit', $book->id) }}" class="m-1">
                                    <button class="bg-blue-500 p-1 rounded-md text-white">Upraviť</button>
                                </form>
                                <form action="{{ route('book.destroy', $book) }}" method="post" class="m-1">
                                
                                    @csrf   
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 p-1 rounded-md text-white">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p>Nie sú žiadne knihy</p>
                @endif
                </div>
            </table>
    </div>
@endsection
