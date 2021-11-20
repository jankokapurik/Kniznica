@extends('layouts.kniznica')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg" >
            <form action="{{ route('register')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="fname" class="sr-only">Name</label>
                    <input type="text" name="fname" placeholder="Tvoje Meno" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('fname') border-red-500 @enderror" value="{{ old('fname') }}">
                    @error('fname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="lname" class="sr-only">Name</label>
                    <input type="text" name="lname" placeholder="Tvoje Priezvysko" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('lname') border-red-500 @enderror" value="{{ old('lname') }}">
                    @error('lname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" placeholder="Užívatelské meno" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('username') border-red-500 @enderror" value="{{ old('username') }}">
                    @error('username')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" placeholder="Tvoj email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" placeholder="Zadaj heslo" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">
                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                
                <div class="mb-4">
                    <label for="password_confirmation" class="sr-only">Password again</label>
                    <input type="password" name="password_confirmation" placeholder="Zadaj znovu heslo" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror" value="">
                </div>
                
                <div class="mb-4">
                    <label for="schools_id" class="sr-only">Trieda</label>
                    <select name="schools_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('schools_id') border-red-500 @enderror" value=""> 
                        <optgroup class="font-bold" label="Škola">
                            <option value=>vyber svoju školu</option>
                        @if($schools->count())
                            @foreach($schools as $school)
                                <option value={{ $school->id }} >{{ $school->name }}</option>
                            @endforeach
                        @else
                            <p>Nie je ziaden post</p>
                        @endif
                        </optgroup>
                        @error('name')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </select>
                </div>

                <div class="mb-4">
                    <label for="classrooms_id   " class="sr-only">Trieda</label>
                    <select name="classrooms_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('classrooms_id') border-red-500 @enderror" value="">
                    <optgroup label="Trieda">
                        <option class="font-bold" value=>Vyber svoju triedu</option>
                        @if($classrooms->count())
                            @foreach($classrooms as $classroom)
                                <option value={{ $classroom->id }} >{{ $classroom->name }}</option>
                            @endforeach
                        @else
                            <p>Nie je ziaden post</p>
                        @endif
                        </optgroup>
                        @error('classrooms_id')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </select>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:opacity-50">Registrovať sa</button>
                </div>

            </form>
            
        </div>
    </div>
@endsection