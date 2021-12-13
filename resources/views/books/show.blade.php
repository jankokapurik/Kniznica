@extends('layouts.userLayout')

@section('content')

    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg m-10 flex flex-col justify-around">
            <div class="flex mb-8">
                <img src="{{ asset('/images/'.$book->image) }}" alt="Obrázok knihy" class="max-w-3xl">
                <div class="ml-8 width-max">
                    <a href="{{ route('books.show', $book) }}" class="font-bold text-3xl">{{ $book->author->fname }} {{ $book->author->lname }}</a>
                    <p class="text-3xl border-bottom mb-4">{{ $book->title }}</p>
                    <p class="text-2xl">Jazyk: {{ $book->language->name }}</p>
                    <p class="text-2xl">Množstvo: {{ $book->quantity }} ks</p>
                    <p class="text-gray-600 text-2xl">
                        @forelse ($book->genres as $genre)
                        {{ $genre->name, }}
                        @empty
                        Nie sú pridané žánre
                        @endforelse  
                    </p>
                    <p text-2xl>{{ $book->description }}</p>
                </div>
            </div>  
            <div class="min-w-full flex justify-center ">
                <div class="mb-10 w-full flex justify-center">
                    <div class="flex flex-col w-8/12">

                        @if($comments)
                        <div>
                            <div class="w-full flex">
                                <div class="p-1"> 
                                    <span class="text-yellow-500">&#9733&#9733&#9733&#9733&#9733</span>
                                </div>
                                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                                    <div style="width: {{$rating['star5']}}%" class="bg-green-400 rounded"></div>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="p-1"> 
                                    <span class="text-yellow-500">&#9733&#9733&#9733&#9733</span>&#9733
                                </div>
                                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                                    <div style="width: {{$rating['star4']}}%" class="bg-green-300 rounded"></div>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="p-1"> 
                                    <span class="text-yellow-500">&#9733&#9733&#9733</span>&#9733&#9733
                                </div>
                                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                                    <div style="width: {{$rating['star3']}}%" class="bg-yellow-200 rounded"></div>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="p-1"> 
                                    <span class="text-yellow-500">&#9733&#9733</span>&#9733&#9733&#9733
                                </div>
                                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                                    <div style="width: {{$rating['star2']}}%" class="bg-yellow-300 rounded"></div>
                                </div>
                            </div>
                            <div class="w-full flex">
                            <div class="p-1"> 
                                <span class="text-yellow-500">&#9733</span>&#9733&#9733&#9733&#9733
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
                    @auth
                    <x-writecomment :book="$book"/>
                    @endauth
                    @guest
                    <div class="bg-white p-6 rounded-lg m-10">
                        pripojit sa do diskusie
                    </div>
                    @endguest
                    @foreach ($comments as $comment)
                    <div class="bg-white rounded-lg" >
                        <x-comment :comment="$comment" />
                    </div>
                    @endforeach
                    @else
                    <div>
                        Nie je ziaden koment
                    </div>
                    @auth
                    <x-writecomment :book="$book"/>
                    @endauth
                    @guest
                    <div class="w-8/12 bg-white p-6 rounded-lg m-10">
                        pripojit sa do diskusie
                    </div>
                    @endguest
                    @endif
                </div>
                </div>
            </div>
    </div>                    
</div>
@endsection