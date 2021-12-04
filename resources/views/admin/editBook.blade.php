@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form method="POST" action="{{ route('book.update', $book) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="author_id   " class="sr-only">Autor</label>
                    <select name="author_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-600 @error('author_id') border-red-500 @enderror trasition duration-500" value="{{ $book->author->id }}">
                    <optgroup label="Autor">
                        <option class="font-bold" value="">Vyber autora</option>
                        @if($authors->count())
                            @foreach($authors as $author)
                                <option value={{ $author->id }} {{ ($book->author == $author) ? 'selected' : '' }}>{{ $author->fname}} {{ $author->lname}}</option>
                            @endforeach
                        @else   
                            <p>Nie je ziaden autor</p>
                        @endif
                        </optgroup>
                        @error('author_id')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </select>
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800 sr-only" for="title">Názov</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('title') border-red-500 @enderror" type="text" id="title" name="title" value="{{ $book->title }}">
                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800 sr-only" for="releaseDate">Dátum vydania</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('releaseDate') border-red-500 @enderror" type="date" id="releaseDate" name="releaseDate" value="{{ $book->releaseDate }}">
                    @error('releaseDate')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>                
                <div class="mb-4">
                    <label class="font-bold text-gray-800 sr-only" for="quantity">Množstvo</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('quantity') border-red-500 @enderror" type="number" id="quantity" name="quantity" value="{{ $book->quantity }}">
                    @error('quantity')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="language_id   " class="sr-only">Jazyk</label>
                    <select name="language_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-600 @error('language_id') border-red-500 @enderror trasition duration-500" value="">
                    <optgroup label="Jazyk">
                        <option class="font-bold" value=>Vyber jazyk</option>
                        @if($languages->count())
                            @foreach($languages as $language    )
                                <option value="{{ $language->id }}" {{ ($book->language == $language) ? 'selected' : '' }}>{{ $language->name}}</option>
                            @endforeach
                        @else
                            <p>Nie je ziaden jazyk</p>
                        @endif
                        </optgroup>
                        @error('language_id')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </select>
                </div>
                <label for="image" class="font-bold text-2xl mb-4">Zmeniť fotku</label>
                <div class="mb-4 flex">
                    <img src="{{ asset('/images/'.$book->image) }}" height="100" width="50" alt="kniha" class="mr-2">
                    <input type="file" name="image" id="image" class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-600 hover:border-gray-300 trasition duration-500 @error('image') border-red-500 @enderror">
                    @error('image')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-blue-500">Upraviť</button>
            </form>
        </div>
        </div>
    @endsection
