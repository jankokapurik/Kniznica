@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <table class="border border-gray-800 w-full">
                <tr>
                    <th class="border border-gray-600 p-1">Užívaťeľské meno</th>
                    <th class="border border-gray-600 p-1">Email</th>
                    <th class="border border-gray-600 p-1">Meno</th>
                    <th class="border border-gray-600 p-1">Priezvisko</th>
                    <th class="border border-gray-600 p-1">Škola</th>
                    <th class="border border-gray-600 p-1">Trieda</th>
                    <th class="border border-gray-600 p-1">Typ užívateľa</th>
                    <th class="border border-gray-600 p-1">Akcie</th>
                </tr>
                @if($users->count())
                    @foreach($users as $user)
                        <tr>
                            <td class="border border-gray-600">
                                <h2 class="font-bold text-gray-900 p-1">{{ $user->username }}</h2>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p-1">{{ $user->email }}</p>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p1">{{ $user->fname }}</p>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p-1">{{ $user->lname }}</p>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p-1">{{ $user->schools->name }}</p>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p-1">{{ $user->classrooms->name }}</p>
                            </td>
                            <td class="border border-gray-600">
                                <p class="text-gray-600 p-1">{{ $user->user_type }}</p>
                            </td>
                            <td class="border border-gray-600 flex flex-row">
                                <form action="{{ route('user.edit', $user->id) }}" class="m-1">
                                    <button class="bg-blue-500 border border-blue-500 p-1 rounded-md text-white hover:bg-blue-100 hover:text-blue-500">Upraviť</button>
                                </form>
                                <form action="{{ route('user.destroy', $user) }}" method="post" class="m-1">
                                
                                    @csrf   
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 border border-red-500 p-1 rounded-md text-white hover:bg-red-100 hover:text-red-500">Vymazať</button>
                                </form>
                            </td>
                        </tr>
                        {{-- <div class="m-4 w-full rounded-lg border-2 border-gray-300 flex flex-row"> --}}
                    @endforeach
                @else
                    <p>Nie sú žiadny používatelia</p>
                @endif
                </div>
            </table>
    </div>
@endsection
