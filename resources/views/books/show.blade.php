@extends('layouts.userLayout')

@section('content')

    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-24 rounded-lg m-10 flex flex-col justify-around">
            <div class="flex mb-8 h-96 ">
                
                @if($book->image)
                    <img src="{{ asset('/images/'.$book->image) }}" alt="Obrázok knihy" class="w-1/3 h-full object-contain">
                @else
                    <img src="{{ asset('/images/'."default_book.jpg") }}" alt="Obrázok knihy" class="w-1/3 h-full object-contain">
                @endif
                
                <div class="ml-8 w-1/3">
                    <p class="text-5xl">{{ $book->title }}</p>
                    <p class="text-2xl mb-2">{{ $book->author->fname }} {{ $book->author->lname }}</p>
                    <p class="text-m">Jazyk: {{ $book->language->name }}</p>
                    <p class="text-m">Množstvo: {{ $book->quantity }} ks</p>
                    <p class="text-gray-600 text-m mb-2">
                        @forelse ($book->genres as $genre)
                            {{ $genre->name, }}
                        @empty
                            Nie sú pridané žánre
                        @endforelse  
                    </p>
                    <div class="bg-gray-200 rounded-lg p-2 mb-4 text-ellipsis overflow-hidden h-36">
                        <p class="">{{ $book->description }}</p>
                    </div>
                   
                    @auth                                            
                        @if ($borrowed)
                            <p class="text-center bg-green-500 border-2 border-green-500 text-white p-2 rounded-lg">Vypožičiane</p>
                        @else
                            @if ($book->quantity > 0)                            
                                <form action="{{ route('loan.userCreate', ['user' => auth()->user(), 'book' => $book]) }}" method="GET">
                                    <button class="w-full bg-blue-500 border-2 border-blue-500 text-white p-2 rounded-lg hover:bg-blue-100 hover:text-blue-500">Vypožičať</button>
                                </form>
                            @elseif($book->quantiy == 0)                           
                                <form action="{{ route('loan.userCreate', ['user' => auth()->user(), 'book' => $book]) }}" method="GET">
                                    <button class="w-full bg-blue-500 border-2 border-blue-500 text-white p-2 rounded-lg hover:bg-blue-100 hover:text-blue-500">Rezervovať</button>
                                </form>                      
                            @endif
                        @endif
                    @endauth
                    @guest
                        Pre zapožičanie sa musíte najprv prihlásiť
                    @endguest
                </div>
            </div>  

            @if($comments)
            <div class="min-w-full flex justify-center ">
                <div class="mb-10 w-full flex justify-center">
                    <div class="flex flex-col w-full">                        
                        <div class=" mb-6">
                            <div class="w-full flex">
                                <div class="p-1"> 
                                    <span class="text-yellow-500">&#9733&#9733&#9733&#9733&#9733</span>
                                </div>
                                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                                    <div style="width: {{ $rating['star5'] }}%" class="bg-green-400 rounded"></div>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="p-1"> 
                                    <span class="text-yellow-500">&#9733&#9733&#9733&#9733</span>&#9733
                                </div>
                                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                                    <div style="width: {{ $rating['star4'] }}%" class="bg-green-300 rounded"></div>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="p-1"> 
                                    <span class="text-yellow-500">&#9733&#9733&#9733</span>&#9733&#9733
                                </div>
                                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                                    <div style="width: {{ $rating['star3'] }}%" class="bg-yellow-200 rounded"></div>
                                </div>
                            </div>
                            <div class="w-full flex">
                                <div class="p-1"> 
                                    <span class="text-yellow-500">&#9733&#9733</span>&#9733&#9733&#9733
                                </div>
                                <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                                    <div style="width: {{ $rating['star2'] }}%" class="bg-yellow-300 rounded"></div>
                                </div>
                            </div>
                            <div class="w-full flex">
                            <div class="p-1"> 
                                <span class="text-yellow-500">&#9733</span>&#9733&#9733&#9733&#9733
                            </div>
                            <div class="w-7/12 flex-grow h-2 flex rounded bg-gray-200 mt-3">
                                <div style="width: {{ $rating['star1']}}%" class="bg-red-400 rounded"></div>
                            </div>
                        </div>
                    </div>                                    

                    @endif

                    @guest
                        <a href="{{route('login')}}" class="w-full bg-gray-200 p-5 rounded-lg mt-4 text-center">Aby ste mohli písať komentáre musíte sa najprv prihlásiť.</a>
                    @endguest

                    @auth
                        @if ($hasComment)
                            <div class="w-full bg-gray-200 p-5 rounded-lg mt-4 text-center">Už ste komentovali.</div>
                        @else                            
                            <x-writecomment :book="$book"/>
                        @endif                       
                    @endauth

                    @if ($comments != null)
                        @foreach ($comments as $comment)
                            <div class="bg-white rounded-lg " >
                                <x-comment :comment="$comment" />
                            </div>
                        @endforeach   
                    @else
                        <div class="w-full bg-gray-200 p-5 rounded-lg mt-4 text-center">
                            Ku tejto knihe nie je napísaný žiaden komentár.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection