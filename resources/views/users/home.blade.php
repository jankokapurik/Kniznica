@extends('layouts.userLayout')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg mb-6" >
            <div class="flex">
                <p class="text-9xl mr-4">Knižnica</p>
                <img src="{{ asset('/images/logoSPSE.png') }}" alt="" width="150px">
            </div>
            <h1 class="font-bold text-3xl mt-10">Stánka internátnej knižnice SPŠ Elektrotechnickej v Košiciach</h1>
            <div class="flex mt-4">
                <h1 class="font-bold text-3xl  mr-4">Prezrite si náš katalóg kníh tu: </h1>
                <a href="{{ route('books') }}">
                    <img src="{{ asset('/images/book.png') }}" width="70px">    
                </a>
            </div>
        </div>
    </div>
@endsection