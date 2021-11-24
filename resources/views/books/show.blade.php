@extends('layouts.kniznica')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg" >
            <x-book :book="$book" />
        </div>
    </div>
@endsection