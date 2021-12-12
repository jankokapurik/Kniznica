@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg" >
            <form action="{{ route('password.update')}}" method="POST">
                @csrf

                <input type="hidden" name='token' value="{{ $token }}">

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" placeholder="Tvoj email" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 @error('email') border-red-500 @enderror trasition duration-500" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" placeholder="Zadaj heslo" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 @error('password') border-red-500 @enderror trasition duration-500" value="">
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                
                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password again</label>
                    <input type="password" name="password_confirmation" placeholder="Zadaj znovu heslo" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 @error('password') border-red-500 @enderror trasition duration-500" value="">
                </div>                                        

                <div>
                    <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Registrovať sa</button>
                </div>

            </form>
            
        </div>
    </div>
@endsection