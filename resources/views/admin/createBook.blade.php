@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="author_id   " class="sr-only">Autor</label>
                    <select name="author_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-500 @error('author_id') border-red-500 @enderror trasition duration-500" value="">
                    <optgroup label="Autor">
                        <option class="font-bold" value=>Vyber autora</option>
                        @if($authors->count())
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ (old('author_id') == $author->id ? "selected":"") }}>{{ $author->fname}} {{ $author->lname}}</option>
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
                    <input type="text" name="title" placeholder="Názov knihy" class="bg-gray-100 border-2 w-full p-4 text-gray-500 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('title') border-red-500 @enderror trasition duration-500" value="{{ old('title') }}">
                    @error('title')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="releaseDate" class="sr-only">Dátum vydania</label>
                    <input type="date" name="releaseDate" placeholder="Dátum vydania" class="bg-gray-100 border-2 w-full p-4 text-gray-500 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('releaseDate') border-red-500 @enderror trasition duration-500" value="{{ old('releaseDate') }}">
                    @error('releaseDate')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="quantity" class="sr-only">Množstvo</label>
                    <input type="number" name="quantity" placeholder="Množstvo" min="1"class="bg-gray-100 border-2 w-full p-4 text-gray-500 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('quantity') border-red-500 @enderror trasition duration-500" value="{{ old('quantity') }}">
                    @error('quantity')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="language_id   " class="sr-only">Jazyk</label>
                    <select name="language_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-500 @error('language_id') border-red-500 @enderror trasition duration-500">
                    <optgroup label="Jazyk">
                        <option class="font-bold">Vyber jazyk</option>
                        @if($languages->count())
                            @foreach($languages as $language    )
                                <option value="{{ $language->id}}" {{ (old('language_id') == $language->id ? "selected":"") }}>{{ $language->name}}</option>
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
                    <label for="description" class="sr-only">Obsah</label>
                    <textarea name="description" class="bg-gray-100 border-2 border-gray-200 rounded-lg p-4 w-full hover:border-gray-300 focus:outline-none focus:border-gray-500" rows="3" placeholder="Napíš stručný obsah"
                  ></textarea>
                </div>
                <div class="mb-4">
                    <label for="image" class="sr-only">Fotka</label>
                    <input type="file" name="image" id="image" placeholder="Fotka" class="bg-gray-100 border-2 w-full p-4 text-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 hover:border-gray-300 trasition duration-500">
                </div>
                <h1 class="text-3xl mb-2">Vyber žánre</h1>
                <div class="flex mb-6">
                    @if ($genres->count())
                    @foreach ($genres as $genre)   
                    <div class="cursor-pointer">
                        <label class="cursor-pointer">
                            <input type="checkbox" name="genre[]" id="genre" value="{{ $genre->id }}" class="peer hidden">
                            <span class="block m-1 bg-gray-200 text-gray-400 py-2 px-3 rounded-full transition duration-500 overflow-hidden text-lg peer-checked:bg-blue-500 peer-checked:text-white peer-checked:shadow-2xl peer-checked:ring-blue-500
                            ">{{ $genre->name }}</span>
                        </label>
                    </div>
                    @endforeach
                    @endif
                </div>
                <h1 class="text-3xl mb-2">Vyber typ</h1>
                <div class="mb-4">
                    <select required name="cathegory" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-600 
                    invalid:text-gray-400  @error('cathegory') border-red-500 @enderror trasition duration-500" value=""> 
                        <option value="" disabled selected hidden>Vyber typ</option>
                        <optgroup class="font-bold text-black" label="Trieda">
                            <option class="text-black" value="kniha" @if (old('cathegory') == "kniha") {{ 'selected' }} @endif>Kniha</option>
                            <option class="text-black" value="časopis" @if (old('cathegory') == "časopis") {{ 'selected' }} @endif>Časopis</option>                               
                        </optgroup>
                        
                        @error('classroom_id')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </select>
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-green-500 border-2 border-green-500 text-white p-4 rounded-lg hover:bg-green-100 hover:text-green-500 trasition duration-500">Pridať</button>
                </div>
            </form>
        </div>
    </div>
@endsection
