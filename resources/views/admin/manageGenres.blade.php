@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form action="{{ route('genre.create') }}" class="mb-4">
                @csrf
                <button type="submit" class="bg-green-500 p-2 rounded-md text-white">Pridať nový žáner</button>
            </form> 
            <table class="border border-gray-800 w-full">
                <tr>
                    <th class="border border-gray-600 p-1">Názov žánru</th>
                    <th class="border border-gray-600 p-1">Akcie</th>
                </tr>
                @if($genres->count())
                    @foreach($genres as $genre)
                        <tr>
                            <td class="border border-gray-600">
                                <h2 class="font-bold text-gray-900 p-1">{{ $genre->name }}</h2>
                            </td>
                            <td class="border border-gray-600 flex flex-row">
                                <form action="{{ route('genre.edit', $genre) }}" class="m-1">
                                    <button class="bg-blue-500 p-1 rounded-md text-white">Upraviť</button>
                                </form>
                                <form action="{{ route('genre.destroy', $genre) }}" method="post" class="m-1">
                                
                                    @csrf   
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 p-1 rounded-md text-white">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p>Nie sú žiadne triedy</p>
                @endif
                </div>
            </table>
    </div>
@endsection
