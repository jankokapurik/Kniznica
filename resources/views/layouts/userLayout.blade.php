<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kniznica</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">    
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">
    
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script> --}}

    <script src="{{ URL::asset('js/autocomplete.js') }}"></script>
    
</head>
<body class="bg-gray-200">
    {{-- {{dd($allBooks)}} --}}

    <div class="flex flex-col h-screen">
        <header>
            <nav class="p-6 bg-white flex justify-between mb-6">

                <ul class="flex items-center">
                    <li>
                        <a href="{{ route('home') }}" class="p-3 hover:text-purple-600">Domov</a>
                    </li>
                    <li>
                        <a href="{{ route('books') }}" class="p-3 hover:text-purple-600">Library</a>
                    </li>
                    @if (auth()->check())
                        @if (auth()->user()->isAdmin())
                        <li>
                            <a href="{{ route('adminHome') }}" class="p-3 hover:text-purple-600">Admin stránka</a>
                        </li>
                        @else
                        @endif
                    @endif
                </ul>
                {{-- SEARCH --}}
                {{-- <div>
                    <form autocomplete="off" action="{{ route('search2') }}" method="get" class="flex items-center">
                        @csrf
                            <div class="w-64 relative">
                                <label for="search" class="sr-only">Name</label>
                                <input id="searchbar" type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500">
                            </div>
                        <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-1 rounded font-medium  hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Hľadaj</button>
                    </form>
                </div> --}}
                
                <x-searchbar id="name" class="w-64" :values="$allBooks"></x-searchbar>
                  
                <div>
                    @auth
                    <ul class="flex items-center space-x-4"> 
                        <ul>                        
                            <li>    
                                <a href="{{ route('loaned', auth()->user()) }}" class="block hover:text-purple-600 text-base">Vypožičané knihy</a>
                            </li>
                        </ul>                        
                        <div class="group">
                            <ul>                        
                                <li>    
                                    <p class="overflow-ellipsis p-1 hover:text-purple-600">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</p>
                                </li>
                            </ul>    
                            <ul class="absolute w-32 right-0">
                    
                                <li class="bg-white hidden group-hover:block">
                                    <a href="/user/{{ auth()->user()->id }}" class="block hover:text-purple-600 text-base">Profile</a>
                                </li>
                                <li class="bg-white hidden group-hover:block">
                                    <a href="{{ route('verification.notice') }}" class="block hover:text-purple-600 text-base">Verify accont</a>
                                </li>

                                <li class="bg-white hidden group-hover:block">
                                    <form action="{{ route('logout') }}" method="post" class="inline">
                                        @csrf
                                        <button class="hover:text-purple-600 text-base block" type="submit">Odhlásiť sa</button>
                                    </form>
                                </li>

                            </ul>
                            
                        </div>                        
                    </ul>
                    @endauth
                    @guest
                    <ul class="flex">                        
                        <li>
                            <a href="{{route('login')}}" class="p-3 hover:text-purple-600">Prihlásiť sa</a>
                        </li>
                        <li>
                            <a href="{{route('register')}}" class="p-3 hover:text-purple-600">Zaregistrovať sa</a>
                        </li>                                            
                    </ul>
                    @endguest
                </div>
            </nav>   
        </header>
                
        {{-- MAIN CONTENT --}}
        <main class="flex-grow">
            <div class="flex flex-col justify-between mb-6">
                @yield('content')
            </div>
        </main>
        <footer>
            <div class="bg-gray-800 p-10 text-gray-200 min-w-screen min-h-16 flex justify-around">
                <div class="h-max w-max flex flex-col justify-content-center align-items-center">
                    <p>Email: kniznica@spseke.sk</p>    
                    <p>Tel: 0940 434 556</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>