@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form method="POST" action="/user/{{ $user->id }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="username">Užívateľské meno</label>
                    <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" type="text" id="username" name="username" value="{{ $user->username }}">
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="fname">Meno</label>
                    <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" type="text" id="fname" name="fname" value="{{ $user->fname }}">
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="lname">Priezvisko</label>
                    <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" type="text" id="lname" name="lname" value="{{ $user->lname }}">
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="email">Email</label>
                    <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" type="text" id="email" name="email" value="{{ $user->lname }}">
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="user_type">Typ užívateľa</label>
                    <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" type="text" id="user_type" name="user_type" value="{{ $user->user_type }}">
                </div>
                <button class="bg-blue-500 text-white p-1 rounded">Upraviť</button>
            </form>
        </div>
    </div>
@endsection
