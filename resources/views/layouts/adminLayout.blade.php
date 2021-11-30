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
        </ul>
    </nav>
    <div class="flex flex-row  ">
        <div class="mt-6 p-3 h-screen rounded-tr-lg bg-white">
            <nav class="w-max ">
                <ul class="divide-y">
                    <li class="p-1 hover:bg-gray-200">
                        <a href="{{ route('dashboard') }}" class=" hover:text-purple-600">Dashboard</a>
                    </li>
                    <li class="p-1 hover:bg-gray-200">
                        <a href="{{ route('booksManagement') }}" class=" hover:text-purple-600">Manažment kníh</a>
                    </li>
                    <li class="p-1 hover:bg-gray-200">
                        <a href="{{ route('userManagement') }}" class=" hover:text-purple-600">Manažment užívateľov</a>
                    </li>
                    <li class="p-1 hover:bg-gray-200">
                        <a href="{{ route('classroomManagement') }}" class=" hover:text-purple-600">Manažment tried</a>
                    </li>
                    <li class="p-1 hover:bg-gray-200">
                        <a href="{{ route('schoolManagement') }}" class=" hover:text-purple-600">Manažment škôl</a>
                    </li>
                    <li class="p-1 hover:bg-gray-200">
                        <a href="{{ route('genreManagement') }}" class=" hover:text-purple-600">Manažment žánrov</a>
                    </li>
                    <li class="p-1 hover:bg-gray-200">
                        <a href="{{ route('languageManagement') }}" class=" hover:text-purple-600">Manažment jazykov</a>
                    </li>
                    <li class="p-1 hover:bg-gray-200">
                        <a href="{{ route('authorManagement') }}" class=" hover:text-purple-600">Manažment autorov</a>
                    </li>
                    <li class="p-1 hover:bg-gray-200">
                        <a href="" class=" hover:text-purple-600">Reporty</a>
                    </li>
                </ul>
            </nav>
        </div>
        @yield('content')
    </div>
</body>
</html>