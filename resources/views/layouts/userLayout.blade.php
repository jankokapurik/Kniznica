<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kniznica</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">    
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">
    
    
</head>
<body class="bg-gray-200">
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
                <div>
                    <form action="{{ route('search2') }}" method="get" class="flex items-center">
                        @csrf
                        <label for="search" class="sr-only">Name</label>
                        <input type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500">
                        <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-1 rounded font-medium  hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Hľadaj</button>
                    </form>
                </div>
                <ul class="flex items-center ">
                    @auth
                    <li>
                        <a href="/user/{{ auth()->user()->id }}" class="p-3 hover:text-purple-600">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</a>
                    </li> 
                    <li>
                        <form action="{{ route('logout') }}" method="post" class="inline p-3">
                            @csrf
                            <button class="p-3 hover:text-purple-600" type="submit">Odhlásiť sa</button>
                        </form>
                    </li>
                    @endauth
                    @guest
                    <li>
                        <a href="{{route('login')}}" class="p-3 hover:text-purple-600">Prihlásiť sa</a>
                    </li>
                    <li>
                        <a href="{{route('register')}}" class="p-3 hover:text-purple-600">Zaregistrovať sa</a>
                    </li>
                    @endguest
                    
                </ul>
            </nav>
        </header>
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