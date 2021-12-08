@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-l-lg" >
            <form action="{{ route('language.create') }}" class="mb-4">
                @csrf
                <button type="submit" class="bg-green-500 border-2 border-green-500 p-2 rounded-md text-white hover:bg-green-100 hover:text-green-500 trasition duration-500">Pridať nový jazyk</button>
            </form> 
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b-2 border-gray-500">
                        <th class="p-1">Názov jazyka</th>
                        <th class="p-1">Akcie</th>
                    </tr>
                </thead>
                <tbody>
                    @if($languages->count())
                        @foreach($languages as $language)
                            <tr class="even:bg-gray-100 border-t border-gray-500">
                                <td>
                                    <div class="flex flex-row justify-center align-middle">
                                        <h2 class="font-bold text-gray-900 p-1">{{ $language->name }}</h2>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-row justify-center align-middle">
                                        <form action="{{ route('language.edit', $language) }}" class="m-1">
                                            <button class="bg-blue-500 border border-blue-500 p-1 rounded-md text-white hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Upraviť</button>
                                        </form>
                                        <form action="{{ route('language.destroy', $language) }}" method="post" class="m-1">
                                            @csrf   
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 border border-red-500 p-1 rounded-md text-white hover:bg-red-100 hover:text-red-500 trasition duration-500">Vymazať</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <p>Nie sú žiadne triedy</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
        