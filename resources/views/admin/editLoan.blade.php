@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg">
            <div class="flex flex-row">
                @if($loan->renewed == 0 && $loan->approved == 1)
                <form method="GET" action="{{ route('loan.renew', $loan) }}" class="mb-6">
                    @csrf
                    <button type="submit" class="bg-green-500 border-2 border-green-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-green-500 mr-2">Predĺžiť</button>
                </form>
                @endif
                @if($loan->approved == 1)
                <form method="GET" action="{{ route('loan.returnBooks', $loan) }}" class="mb-6">
                    @csrf
                    <button type="submit" class="bg-red-500 border-2 border-red-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-red-500 mr-2">Vrátiť knihy</button>
                </form>
                @endif
            </div>
            <div class="flex flex-row bg-gray-200 p-2 rounded-md mb-2">
                <div>
                    Pouzivatel:&nbsp; 
                </div>
                <div>
                    {{$loan->user->fname}}
                    {{$loan->user->lname}}
                </div>
            </div>
            <form method="POST" action="{{ route('loan.update', $loan) }}">
                @csrf
                @method('PUT')
                <div id="formstorage">            
                        <input name='books[]' type="hidden" value='{{ $book->id }}' />
                    @endforeach        
                </div>
                <x-list :values="$allBooks" :books="$books"></x-list>
                <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-blue-500 mt-2">Upraviť</button>                    
            </form>
        </div>
    </div>
@endsection