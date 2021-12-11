@extends('layouts.userLayout')

@section('content')
    <div>
        <h1>Dashboard</h1>

        @if(session('resent'))
            <div>
                A fresh verification link has been sent to your email address
            </div>
        @endif

        <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit">KLIK</button>
        </form>
    </div>
@endsection