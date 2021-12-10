@extends('layouts.userLayout')

@section('content')

<div class="flex justify-center">
    <div class="w-4/12 bg-white p-6 rounded-lg">            
        <form action="{{ route('forgotten.send') }}" method="post">
            @csrf
            <div class='mb-4'>
                <label for="">Zadaj email</label>
                <input type="text" name="email" placeholder="Tvoj email" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300">
            </div>
            <div>
                <button class="border-2 border-blue-500 bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Odoslat</button>
            </div>
        </form>
    </div>
</div>


@endsection