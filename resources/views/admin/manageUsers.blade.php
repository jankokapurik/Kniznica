@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 p-6 bg-white rounded-l-lg" >
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b-2 border-gray-500">
                        <th class="p-1">Užívaťeľské meno</th>
                        <th class="p-1">Email</th>
                        <th class="p-1">Meno</th>
                        <th class="p-1">Priezvisko</th>
                        <th class="p-1">Škola</th>
                        <th class="p-1">Trieda</th>
                        <th class="p-1">Typ užívateľa</th>
                        <th class="p-1">Akcie</th>
                    </tr>
                </thead>
                <tbody>
                    @if($users->count())
                    @foreach($users as $user)
                    <tr class="even:bg-gray-100 border-t     border-gray-500">
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <h2 class="font-bold text-gray-900 p-1">{{ $user->username }}</h2>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p-1">{{ $user->email }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p1">{{ $user->fname }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p-1">{{ $user->lname }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p-1">{{ $user->school->name }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p-1">{{ $user->classroom->name }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center align-middle">
                                <p class="text-gray-600 p-1">{{ $user->user_type }}</p>
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-row justify-center align-middle"  >
                                <form action="{{ route('user.edit', $user->id) }}" class="m-1">
                                    <button class="bg-blue-500 border-2 border-blue-500 p-1 rounded-md text-white hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Upraviť</button>
                                </form>
                                <form action="{{ route('user.destroy', $user) }}" method="post" class="m-1">
                                    
                                    @csrf   
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 border-2 border-red-500 p-1 rounded-md text-white hover:bg-red-100 hover:text-red-500 trasition duration-500">Vymazať</button>
                                </form>
                            </div>
                        </td>
                        </tr>
                        {{-- <div class="m-4 w-full rounded-lg border-2 border-gray-300 flex flex-row"> --}}
                    @endforeach
                    @else
                    <p>Nie sú žiadny používatelia</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
        