@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg" >
            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('password.email')}}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" placeholder="Tvoj email" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 @error('email') border-red-500 @enderror trasition duration-500" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <span>
                    info: Na tento email Vám bude zaslaný kód na obnovenie hesla
                </span>

                <div>
                    <button type="submit" class="border-2 border-blue-500 bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Odoslať</button>
                </div>

            </form>
            
        </div>
    </div>
@endsection