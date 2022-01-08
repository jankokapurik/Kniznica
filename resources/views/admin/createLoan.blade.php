@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form action="{{ route('loan.store') }}" method="POST">
                @csrf
                <div class>
                    @if ($errors->any())
                        {{ $errors->first() }}
                    @endif

                    <label for="user_id" class="sr-only">Používateľ</label>
                    <select name="user_id" id="user_id" class="bg-gray-100 border-2 border-gray-300 w-full mb-4 p-4 rounded-lg hover:border-gray-500 focus:border-gray-600 transition duration-500">
                        <optgroup>                            
                            <option value="">Vyber užívateľa</option>
                            @if($users->count())
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                                @endforeach
                            @endif
                        </optgroup>
                        @error('user_id')
                        <div class="text-red-500 mt-2 text-sm">
                            {{$message}}
                        </div>
                        @enderror
                    </select>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-blue-500 trasition duration-500">Pridať</button>
                </div>
            </form>
        </div>
    </div>
@endsection