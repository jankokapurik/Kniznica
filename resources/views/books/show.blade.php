@extends('layouts.userLayout')

@section('content')

    <div class="flex flex-col justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg m-10" >
            <x-book :book="$book" />            
        </div>

        @auth
            <x-writecomment :book="$book"/>
        @endauth

        @guest
            <div class="w-8/12 bg-white p-6 rounded-lg m-10">
                pripojit sa do diskusie
            </div>
        @endguest
        
        @foreach ($comments as $comment)
            <div class="w-8/12 bg-white p-6 rounded-lg m-10" >
                <x-comment :comment="$comment" />
            </div>
        @endforeach
    </div>

@endsection