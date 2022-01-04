@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-l-lg" >
            <form action="{{ route('loan.create') }}" class="mb-4">
                @csrf
                <button type="submit" class="bg-green-500 border-2 border-green-500 p-2 rounded-md text-white hover:bg-green-100 hover:text-green-500 trasition duration-500">Vytvoriť výpožičku</button>
            </form> 
            <table class="w-full table-auto">
                <thead>
                    <tr class="border-b-2 border-gray-500">
                        <th class="p-1">Užívateľ</th>
                        <th class="p-1">Schválená</th>
                        <th class="p-1">Od</th>
                        <th class="p-1">Do</th>
                        <th class="p-1">Knihy</th>
                        <th class="p-1">Akcie</th>
                    </tr>
                </thead>
                <tbody>
                    @if($loans->count())
                        @foreach($loans as $loan)
                            <tr class="even:bg-gray-100 border-t border-gray-500">
                                <td>
                                    <div class="flex flex-row justify-center align-middle">
                                        <p class=" text-gray-900 p-1">{{ $loan->user->fname }} {{ $loan->user->lname }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-row justify-center align-middle">
                                        <p class=" text-gray-900 p-1">
                                            @if( $loan->approved == 1)
                                                Áno
                                            @elseif($loan->approved == 0)
                                                Nie
                                            @endif
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-row justify-center align-middle">
                                        <p class=" text-gray-900 p-1">{{ $loan->from }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-row justify-center align-middle">
                                        <p class=" text-gray-900 p-1">{{ $loan->to }}</p>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="flex flex-row justify-center align-middle divide-x divide-red-300">
                                        @forelse ($loan->books as $book)
                                        <p class="text-gray-600 p-1">{{ $book->title, }}</p>
                                        @empty
                                        <p class="text-gray-600 p-1">Nie sú pridané knihy</p>
                                        @endforelse  
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-row justify-center align-middle">
                                        <form action="{{ route('loan.edit', $loan) }}" class="m-1">
                                            @csrf 
                                            <button class="bg-blue-500 border border-blue-500 p-1 rounded-md text-white hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Upraviť</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                    <p>Nie sú žiadne výpožičky</p>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
        