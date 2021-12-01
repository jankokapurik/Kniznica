@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form action="{{ route('book.create') }}" class="mb-4">
                @csrf
                <button type="submit" class="bg-green-500 border-2 border-green-500 p-2 rounded-md text-white hover:bg-green-100 hover:text-green-500 trasition duration-500">Pridať novú knihu</button>
            </form> 
            <table class="border border-gray-800 w-full">
                <tr>
                    <th class="border border-gray-600 p-1">Autor</th>
                    <th class="border border-gray-600 p-1">Názov</th>
                    <th class="border border-gray-600 p-1">Dátum vydania</th>
                    <th class="border border-gray-600 p-1">Množstvo</th>
                    <th class="border border-gray-600 p-1">Jazyk</th>
                    <th class="border border-gray-600 p-1">Žánre</th>
                    <th class="border border-gray-600 p-1">Fotka</th>
                    <th class="border border-gray-600 p-1">Akcie</th>
                </tr>
                @if($books->count())
                    @foreach($books as $book)
                        <tr>
                            <td class="border border-gray-600">
                                <h2 class="font-bold text-gray-900 p-1">{{ $book->author->fname }} {{ $book->author->lname }}</h2>
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
                                <p class="text-gray-600 p-1">{{ $book->language->name }}</p>
                            </td>
                            <td class="border border-gray-600">
                                <div class="flex flex-row divide-x divide-red-300">
                                    @forelse ($book->genres as $genre)
                                        <p class="text-gray-600 p-1">{{ $genre->name, }}</p>
                                    @empty
                                        <p class="text-gray-600 p-1">Nie sú pridané žánre</p>
                                    @endforelse  
                                </div>
                            </td>
                            <td class="border border-gray-600">
                                <img src="{{ asset('/storage/images/knihy/'.$book->image) }}" height="100" width="50"alt="kniha">
                            </td>
                            <td class="border border-gray-600 flex">
                                <form action="{{ route('book.edit', $book->id) }}" class="m-1">
                                    <button class="bg-blue-500 border border-blue-500 p-1 rounded-md text-white hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Upraviť</button>
                                </form>
                                <form action="{{ route('book.destroy', $book) }}" method="post" class="m-1">
                                
                                    @csrf   
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 border border-red-500 p-1 rounded-md text-white hover:bg-red-100 hover:text-red-500 trasition duration-500">Vymazať</button>
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
