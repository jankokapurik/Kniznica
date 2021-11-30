@extends('layouts.userLayout')

@section('content')

    <div class="flex flex-col justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg m-10" >
            <div class="mb-10 bg-gray-200">
                <x-book :book="$book" />                        
            </div>
    <div class="mb-10">

    @if($comments)
        <div class="flex flex-wrap w-8/12">
            <div class="w-full flex">
                <div class="p-1"> 
                    5&nbsp;hviezdicok
                </div>
                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                    <div style="width: {{$rating['star5']}}%" class="bg-green-400 rounded"></div>
                </div>
            </div>
            <div class="w-full flex">
                <div class="p-1"> 
                    4&nbsp;hviezdicky
                </div>
                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                    <div style="width: {{$rating['star4']}}%" class="bg-green-300 rounded"></div>
                </div>
            </div>
            <div class="w-full flex">
                <div class="p-1"> 
                    3&nbsp;hviezdicky
                </div>
                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                    <div style="width: {{$rating['star3']}}%" class="bg-yellow-200 rounded"></div>
                </div>
            </div>
            <div class="w-full flex">
                <div class="p-1"> 
                    2&nbsp;hviezdicky
                </div>
                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                    <div style="width: {{$rating['star2']}}%" class="bg-yellow-300 rounded"></div>
                </div>
            </div>
            <div class="w-full flex">
                <div class="p-1"> 
                    1&nbsp;hviezdicka
                </div>
                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                    <div style="width: {{$rating['star1']}}%" class="bg-red-400 rounded"></div>
                </div>
            </div>
        </div>


        {{-- <table class="table-fixe w-full bg-green-200">
            <tr>
                <td class="w-2/10">5 hviezdicok</td>
                <td class="">
                    
                </td>
            </tr>
        </table> --}}
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
            <div class="w-8/12 bg-white rounded-lg" >
                <x-comment :comment="$comment" />
            </div>
            @endforeach
        </div>
    </div>

    @else
        <div>Nie je ziaden koment</div>
        @auth
        <x-writecomment :book="$book"/>
        @endauth
        
        @guest
        <div class="w-8/12 bg-white p-6 rounded-lg m-10">
            pripojit sa do diskusie
        </div>
        @endguest
    @endif

@endsection