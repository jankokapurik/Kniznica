@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            <form action="{{ route('classroom.create') }}" class="mb-4">
                @csrf
                <button type="submit" class="bg-green-500 border-2 border-green-500 p-2 rounded-md text-white hover:bg-green-100 hover:text-green-500">Pridať novú triedu</button>
            </form> 
            <table class="border border-gray-800 w-full">
                <tr>
                    <th class="border border-gray-600 p-1">Názov triedy</th>
                    <th class="border border-gray-600 p-1">Akcie</th>
                </tr>
                @if($classrooms->count())
                    @foreach($classrooms as $classroom)
                        <tr>
                            <td class="border border-gray-600">
                                <h2 class="font-bold text-gray-900 p-1">{{ $classroom->name }}</h2>
                            </td>
                            <td class="border border-gray-600 flex flex-row">
                                <form action="{{ route('classroom.edit', $classroom) }}" class="m-1">
                                    <button class="bg-blue-500 border border-blue-500 p-1 rounded-md text-white hover:bg-blue-100 hover:text-blue-500">Upraviť</button>
                                </form>
                                <form action="{{ route('classroom.destroy', $classroom) }}" method="post" class="m-1">
                                
                                    @csrf   
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 border border-red-500 p-1 rounded-md text-white hover:bg-red-100 hover:text-red-500">Vymazať</button>
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
