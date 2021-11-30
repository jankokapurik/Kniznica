@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form method="POST" action="{{ route('user.update', $user) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="font-bold text-gray-800 sr-only" for="username">Užívateľské meno</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('username') border-red-500 @enderror" type="text" id="username" name="username" value="{{ $user->username }}">
                    @error('username')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800 sr-only" for="fname">Meno</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('fname') border-red-500 @enderror" type="text" id="fname" name="fname" value="{{ $user->fname }}">
                    @error('fname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800 sr-only" for="lname">Priezvisko</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('lname') border-red-500 @enderror" type="text" id="lname" name="lname" value="{{ $user->lname }}">
                    @error('lname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800 sr-only" for="email">Email</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('email') border-red-500 @enderror" type="text" id="email" name="email" value="{{ $user->email }}">
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800 sr-only" for="user_type">Typ užívateľa</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('user_type') border-red-500 @enderror" type="text" id="user_type" name="user_type" value="{{ $user->user_type }}">
                    @error('user_type')
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
