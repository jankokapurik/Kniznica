@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form method="POST" action="{{ route('genre.update', $genre) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="font-bold text-gray-800 sr-only" for="name">Názov</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('name') border-red-500 @enderror" type="text" id="name" name="name" value="{{ $genre->name }}">
                    @error('name')
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
