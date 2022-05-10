@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-l-lg" >            
            <div class="flex flex-row mb-4">                    
                <form action="{{ route('book.create') }}" class="mr-2">
                    @csrf
                    <button type="submit" class="bg-green-500 border-2 border-green-500 p-2 rounded-md text-white hover:bg-green-100 hover:text-green-500 trasition duration-500">Pridať novú knihu</button>
                </form>            
                <a href="{{ route('book.index_restore') }}" class="bg-blue-500 border-2 border-blue-500 p-2 rounded-md text-white hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Obnoviť knihy</a>
            </div>
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b-2 border-gray-500">
                        <th class=" p-1">Autor</th>
                        <th class=" p-1">Názov</th>
                        <th class=" p-1">Dátum vydania</th>
                        <th class=" p-1">Množstvo</th>
                        <th class=" p-1">Jazyk</th>
                        <th class=" p-1">Žánre</th>
                        <th class=" p-1">Fotka</th>
                        <th class=" p-1">Akcie</th>
                    </tr>
                </thead>
                <tbody>
                    @if($books->count())
                    @foreach($books as $book)
                    <tr class="even:bg-gray-100 border-t border-gray-500 ">
                        <td class="">
                            <div class="flex flex-row justify-center align-middle">
                                <h2 class="text-gray-600 p-1">{{ $book->author->fname }} {{ $book->author->lname }}</h2>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p-1">{{ $book->title }}</p>
                            </div>                        </td>
                        <td class="">
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p1">{{ $book->releaseDate }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p-1">{{ $book->quantity}}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p-1">{{ $book->language->name }}</p>
                            </div>
                        </td>
                        <td class="">
                            <div class="flex flex-row justify-center align-middle divide-x divide-red-300">
                                @forelse ($book->genres as $genre)
                                <p class="text-gray-600 p-1">{{ $genre->name, }}</p>
                                @empty
                                <p class="text-gray-600 p-1">Nie sú pridané žánre</p>
                                @endforelse  
                            </div>
                        </td>
                        <td class="">
                            <div class="flex flex-row justify-center align-middle">
                                <img src="{{ asset('/images/'.$book->image) }}" alt="kniha" class="max-h-10 w-10">
                            </div>
                        </td>
                        <td class="">
                            <div class="flex flex-row justify-center align-middle">
                                <form action="{{ route('book.edit', $book->id) }}" class="m-1">
                                    <button class="bg-blue-500 border border-blue-500 p-1 rounded-md text-white hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Upraviť</button>
                                </form>
                                <form action="{{ route('book.destroy', $book) }}" method="post" class="m-1">
                                    @csrf   
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 border border-red-500 p-1 rounded-md text-white hover:bg-red-100 hover:text-red-500 trasition duration-500">Vymazať</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <p>Nie sú žiadne knihy</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
