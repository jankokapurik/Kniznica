@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg">


            <div class="flex flex-col">
                <div class="flex flex-row bg-gray-200 p-2 rounded-md">
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
                        @foreach ($books as $book)
                            <input name='books[]' type="hidden" value='{{ $book->id }}' />
                        @endforeach        
                    </div>

                    <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-blue-500">Upraviť</button>                    
                </form>

            </div>
            <x-list :values="$allBooks" :books="$books"></x-list>
        </div>
    </div>
@endsection
























            {{-- <div class="flex flex-row">
                @if($loan->approved == 1)
                <form action="{{ route('loan.returnBooks', $loan) }}" method="post">
                    @csrf   
                    @method('DELETE')
                    <button class="bg-blue-500 border-2 border-blue-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-blue-500">Vrátiť knihy</button>
                </form>
                @endif
            </div> --}}
        </div>