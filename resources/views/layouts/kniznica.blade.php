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
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
            <li>
                <a href="{{ route('home') }}" class="p-3 hover:text-purple-600">Domov</a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}" class="p-3 hover:text-purple-600">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('books') }}" class="p-3 hover:text-purple-600">Library</a>
            </li>
        </ul>

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
    @yield('content')
</body>
</html>