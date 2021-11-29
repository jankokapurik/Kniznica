@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form method="POST" action="{{ route('school.update', $school) }}">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="font-bold text-gray-800" for="name">Názov</label>
                    <input class="h-10 bg-white border border-gray-300 rounded py-4 px-3 mr-4 w-full text-gray-600 text-sm focus:outline-none focus:border-gray-400 focus:ring-0" type="text" id="name" name="name" value="{{ $school->name }}">
                </div>
                
                <button type="submit" class="bg-blue-500 text-white p-1 rounded">Upraviť</button>
            </form>
        </div>
    </div>
@endsection
