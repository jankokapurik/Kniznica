<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kniznica</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between">
        <ul class="flex items-center">
            <li>
                <a href="{{ route('dashboard') }}" class="p-3 hover:text-purple-600">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('books') }}" class="p-3 hover:text-purple-600">Library</a>
            </li>
        </ul>
        <div>
            <form action="{{ route('search2') }}" method="get" class="flex items-center">
                @csrf
                <label for="search" class="sr-only">Name</label>
                <input type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 w-full p-1 rounded-lg mr-2">
                <button type="submit" class="bg-blue-500 text-white p-1 rounded font-medium  hover:opacity-50">Hľadaj</button>
            </form>
        </div>
        <ul class="flex items-center ">
            @auth
                <li>
                    <a href="" class="p-3 hover:text-purple-600">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</a>
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
    <div class="flex flex-row  ">
        <div class="">
            <nav class="p-6 bg-white h-screen py-6">
                <ul class="">
                    <li>
                        <a href="{{ route('dashboard') }}" class="p-3 hover:text-purple-600">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('books') }}" class="p-3 hover:text-purple-600">Library</a>
                    </li>
                </ul>
                <ul class="">
                    <li>
                        <a href="" class="p-3 hover:text-purple-600">Dashboard</a>
                    </li> 
                    <li>
                        <a href="" class="p-3 hover:text-purple-600">catalog</a>
                    </li> 
                </ul>
            </nav>
        </div>
        @yield('content')
    </div>
</body>
</html>