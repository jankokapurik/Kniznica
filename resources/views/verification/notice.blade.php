@extends('layouts.userLayout')

@section('content')        

    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg m-10 flex flex-col justify-around">
            @if(session('resent'))
            <h1 class="text-3xl">Thank you</h1>
            <div class="mb-14">only one step more...</div>

                <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                    A fresh verification link has been sent to your email address
                </div>
            
            @else
            <h1 class="text-3xl">Verification</h1>
            <div class="mb-14">You need to verify your account first, when you want order books, write comments ...</div>

            <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                @csrf                
                <button class="bg-blue-500 border-2 border-blue-500 text-white px-4 py-3 rounded font-medium w-full hover:bg-blue-100 hover:text-blue-500 trasition duration-500" type="submit">post verify email</button>
            </form>
            @endif
        </div>
@endsection