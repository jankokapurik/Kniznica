@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-4/12 bg-white p-6 rounded-lg" >
            <form action="{{ route('register')}}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="fname" class="sr-only">Meno</label>
                    <input type="text" name="fname" placeholder="Tvoje Meno" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 @error('fname') border-red-500 @enderror trasition duration-500" value="{{ old('fname') }}">
                    @error('fname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="lname" class="sr-only">Priezvisko</label>
                    <input type="text" name="lname" placeholder="Tvoje Priezvisko" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 @error('lname') border-red-500 @enderror trasition duration-500" value="{{ old('lname') }}">
                    @error('lname')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">  
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="username" placeholder="Užívatelské meno" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 @error('username') border-red-500 @enderror trasition duration-500" value="{{ old('username') }}">
                    @error('username')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                    @enderror
                </div>

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
                
                <div class="mb-4">
                    <label for="school_id" class="sr-only">Trieda</label>
                    <select required name="school_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-600 
                    invalid:text-gray-400  @error('school_id') border-red-500 @enderror trasition duration-500" value=""> 
                        <option value="" disabled selected hidden>Vyber svoju školu</option>
                        <optgroup class="font-bold text-black" label="Škola">
                            @if($schools->count())
                                @foreach($schools as $school)
                                    <option class="text-black" value={{ $school->id }} @if ($school->id == old('school_id')) selected @endif>{{ $school->name }}</option>
                                @endforeach
                            @else
                                <p>Nie je ziaden post</p>
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
                    <label for="classroom_id" class="sr-only">Trieda</label>
                    <select required name="classroom_id" class="bg-gray-100 border-2 w-full p-4 rounded-lg hover:border-gray-300 focus:border-gray-600 
                    invalid:text-gray-400  @error('classroom_id') border-red-500 @enderror trasition duration-500" value=""> 
                        <option value="" disabled selected hidden>Vyber svoju triedu</option>
                        <optgroup class="font-bold text-black" label="Trieda">
                            @if($classrooms->count())
                                @foreach($classrooms as $classroom)
                                    <option class="text-black" value={{ $classroom->id }} @if ($classroom->id == old('classroom_id')) selected @endif>{{ $classroom->name }}</option>
                                @endforeach
                            @else
                                <p>Nie je ziaden post</p>
                            @endif                            
                        </optgroup>
                        
                        @error('classroom_id')
                            <div class="text-red-500 mt-2 text-sm">
                                {{$message}}
                            </div>
                        @enderror
                    </select>
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Registrovať sa</button>
                </div>

            </form>
            
        </div>
    </div>
@endsection