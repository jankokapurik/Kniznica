@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="author_id   " class="sr-only">Autor</label>
                    <select name="author_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-600 @error('author_id') border-red-500 @enderror trasition duration-500" value="">
                    <optgroup label="Autor">
                        <option class="font-bold" value=>Vyber autora</option>
                        @if($authors->count())
                            @foreach($authors as $author)
                                <option value={{ $author->id }} >{{ $author->fname}} {{ $author->lname}}</option>
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
                    <label for="title" class="sr-only">Názov</label>
                    <input type="text" name="title" placeholder="Názov knihy" class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('title') border-red-500 @enderror trasition duration-500" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="releaseDate" class="sr-only">Dátum vydania</label>
                    <input type="date" name="releaseDate" placeholder="Dátum vydania" class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('releaseDate') border-red-500 @enderror trasition duration-500" value="{{ old('releaseDate') }}">
                    @error('releaseDate')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="quantity" class="sr-only">Množstvo</label>
                    <input type="number" name="quantity" placeholder="Množstvo" min="1"class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('quantity') border-red-500 @enderror trasition duration-500" value="{{ old('quantity') }}">
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
                                <option value={{ $language->id }} >{{ $language->name}}</option>
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
                <div class="mb-4">
                    <label for="image" class="sr-only">Fotka</label>
                    <input type="file" name="image" id="image" placeholder="Fotka" class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('image') border-red-500 @enderror trasition duration-500" value="{{ old('image') }}">
                    @error('image')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <h1 class="text-2xl">Vyber zanre knihy</h1>
                <div class="m-2 flex">
                    @if ($genres->count())
                    @foreach ($genres as $genre)   
                    <div class="cursor-pointer m-1">
                        <label for="genre" class="cursor-pointer">
                            <input type="checkbox" name="genre" id="genre" value="{{ $genre->id }}" class="">
                            <span class="">{{ $genre->name }}</span>
                        </label>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-blue-500 trasition duration-500">Pridať</button>
                </div>
            </form>
        </div>
    </div>
@endsection
