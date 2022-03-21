<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kniznica</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <script src="{{ URL::asset('js/autocomplete.js') }}"></script>
    <script src="{{ URL::asset('js/autocomplete2.js') }}"></script>
    
</head>
<body class="bg-gray-200">
    <div class="flex flex-col min-h-screen">
        <header>
            <nav class="p-6 bg-white flex justify-between">
                <ul class="flex items-center">
                    <li>
                        <a href="{{ route('home') }}" class="p-3 hover:text-purple-600">Domov</a>
                    </li>
                    <li>
                        <a href="{{ route('books') }}" class="p-3 hover:text-blue-500">Library</a>
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
                <div>
                    <form action="{{ route('search2') }}" method="get" class="flex items-center">
                        @csrf
                        <label for="search" class="sr-only">Name</label>
                        <input type="text" name="search" placeholder="Vyhľadaj" value="" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500">
                        <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-1 rounded font-medium  hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Hľadaj</button>
                    </form>
                </div>
                <ul class="flex items-center ">
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
                </ul>
            </nav>
        </header>
        <main class="flex-grow h-full mb-6">
            <div class="flex flex-row min-h-screen">
                <div class="mt-6 p-3 h-screen rounded-r-lg bg-white">
                    <nav class="w-max">
                        <ul class="divide-y divide-gray-500">
                            <a href="{{ route('adminHome') }}" class="hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 active:bg-gray-400">
                                    Admin domov
                                </li>
                            </a>
                            <a href="{{ route('booksManagement') }}" class=" hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 border-t border-gray-300">
                                    Manažment kníh
                                </li>
                            </a>
                            <a href="{{ route('userManagement') }}" class=" hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 border-t border-gray-300">
                                    Manažment užívateľov
                                </li>
                            </a>
                            <a href="{{ route('classroomManagement') }}" class=" hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 border-t border-gray-300">
                                        Manažment tried
                                </li>
                            </a>
                            <a href="{{ route('schoolManagement') }}" class=" hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 border-t border-gray-300">
                                    Manažment škôl
                                </li>
                            </a>
                            <a href="{{ route('genreManagement') }}" class=" hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 border-t border-gray-300">
                                    Manažment žánrov
                                </li>
                            </a>
                            <a href="{{ route('languageManagement') }}" class="hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 border-t border-gray-300">
                                    Manažment jazykov
                                </li>
                            </a>
                            <a href="{{ route('authorManagement') }}" class="hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 border-t border-gray-300">
                                    Manažment autorov
                                </li>
                            </a>
                            <a href="{{ route('loanManagement') }}" class="hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 border-t border-gray-300">
                                    Manažment Výpožičiek
                                </li>
                            </a>
                            <a href="{{ route('reports') }}" class="hover:text-blue-500">
                                <li class="p-1 hover:bg-gray-200 border-t border-gray-300">
                                    Reporty
                                </li>
                            </a>
                        </ul>
                    </nav>
                </div>
                @yield('content')
            </div>
        </main>
        <footer>
            <div class="bg-gray-800 p-10 text-gray-200 min-w-screen min-h-16 flex justify-around mt-6">
                <div class="h-max w-max flex flex-col justify-content-center align-items-center">
                    <p>Email: kniznica@spseke.sk</p>    
                    <p>Tel: 0940 434 556</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>