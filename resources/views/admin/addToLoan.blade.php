@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form action="{{ route('author.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="fname" class="sr-only">Meno</label>
                    <input type="text" name="fname" placeholder="Meno" class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('fname') border-red-500 @enderror trasition duration-500" value="{{ old('fname') }}">
                    @error('fname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="lname" class="sr-only">Meno</label>
                    <input type="text" name="lname" placeholder="Priezvisko" class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('fname') border-red-500 @enderror trasition duration-500" value="{{ old('lname') }}">
                    @error('lname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-blue-500 trasition duration-500">Pridať autora</button>
                </div>
            </form>
        </div>
    </div>
@endsection
