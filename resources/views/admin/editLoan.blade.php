@extends('layouts.adminLayout')

@section('content')
    <div class="flex w-full">
        <div class="w-full mt-6 ml-6 bg-white p-6 rounded-tl-lg" >
            @if($loan->approved == 0)
                <form method="GET" action="{{ route('loan.approve', $loan) }}" class="mb-6">
                    @csrf
                    <button type="submit" class="bg-green-500 border-2 border-green-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-green-500">Vypožičať</button>
                </form>
            @endif

            <form method="POST" action="{{ route('loan.update', $loan) }}">
                @csrf
                @method('PUT')
                <div>
                    <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-4 rounded-lg hover:bg-gray-100 hover:text-blue-500">Upraviť</button>

                    <label for="user" class="sr-only">Používateľ</label>
                    <select name="user_id" id="user" class="bg-gray-100 border-2 border-gray-300 w-full mb-4 p-4 rounded-lg hover:border-gray-500 focus:border-gray-600 transition duration-500">
                        <optgroup>
                            @if($users->count())
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ ($loan->user == $user) ? 'selected' : ''}}>{{ $user->fname }} {{ $user->lname }}</option>
                            @endforeach
                            @endif
                        </optgroup>
                    </select>                    
                </div>             
                
                
                <div id="formstorage">
                    @foreach ($books as $book)
                        <input name='books[]' type="hidden" value='{{ $book->id }}' />
                    @endforeach        
                </div>
            </form>          

        <x-list :values="$allBooks" :books="$books"></x-list>

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