@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg" >
            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login')}}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" placeholder="Tvoj email" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:outline-none @error('email') border-red-500 @enderror trasition duration-500" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" placeholder="Zadaj heslo" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:outline-none @error('password') border-red-500 @enderror trasition duration-500" value="">
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                @if (session('status')==='Invalid login details')
                <a href="{{ route('password.request') }}" class="rounded-lg mb-6 text-red-600 text-center">
                    Forgotten password??
                </a>
                @endif

                <div class="mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2 trasition duration-500">
                        <label for="remember">Remeber me</label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="border-2 border-blue-500 bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Prihlásiť sa</button>
                </div>

            </form>
            
        </div>
    </div>
@endsection