@extends('layouts.userLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form method="POST" action="{{ route('user.update', $user) }}">
                @csrf
                @method('PATCH')
                USER {{ route('user.update', $user) }}
                
                @error('notChanged')
                    <div class="bg-red-500 w-full p-4 text-gray-600 rounded-lg mb-6">{{$message}}</div>
                {{-- @enderror --}}

                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="username">Užívateľské meno</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('username') border-red-500 @enderror trasition duration-500" type="text" id="username" name="username" value="{{ $user->username }}">
                    @error('username')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="fname">Meno</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('fname') border-red-500 @enderror trasition duration-500" type="text" id="fname" name="fname" value="{{ $user->fname }}">
                    @error('fname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="lname">Priezvisko</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('lname') border-red-500 @enderror trasition duration-500" type="text" id="lname" name="lname" value="{{ $user->lname }}">
                    @error('lname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="email">Email</label>
                    <input class="bg-gray-100 border-2 w-full p-4 text-gray-600 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 @error('email') border-red-500 @enderror trasition duration-500" type="text" id="email" name="email" value="{{ $user->email }}">
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="school_id" class="font-bold text-gray-800">Škola</label>
                    <select name="school_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-600 @error('school_id') border-red-500 @enderror trasition duration-500" value="">
                        <optgroup label="Škola">
                            @if($schools->count())
                            @foreach($schools as $school)
                            <option value="{{ $school->id }}" {{ ($user->school == $school) ? 'selected' : '' }}>{{ $school->name}}</option>
                            @endforeach
                            @else
                            <p>Nie je ziaden jazyk</p>
                            @endif
                        </optgroup>
                        @error('school_id')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                        @enderror
                    </select>
                </div>
                <div class="mb-4">
                    <label for="classroom_id" class="font-bold text-gray-800">Trieda</label>
                    <select name="classroom_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-600 @error('classroom_id') border-red-500 @enderror trasition duration-500" value="">
                        <optgroup label="Trieda">
                            @if($classrooms->count())
                            @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ ($user->classroom == $classroom) ? 'selected' : '' }}>{{ $classroom->name}}</option>
                            @endforeach
                            @else
                            <p>Nie je ziadna trieda</p>
                            @endif
                        </optgroup>
                        @error('classroom_id')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                        @enderror
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-blue-500 trasition duration-500">Upraviť</button>
                </div>
            </form>
        </div>
    </div>
@endsection
