@extends('layouts.kniznica')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1">{{ $user->fname }}</h1>
                <p>Posted {{ $knihy->count() }} {{ Str::plural('kniha', $knihy->count()) }} a dostali {{ $user->recievedLikes->count() }} lajkov</p>
            </div>
            <div class="bg-white p-6 rounded-lg">
            @if($knihy->count())
                @foreach($knihy as $kniha)
                    <x-kniha :kniha="$kniha" />
                @endforeach

                {{ $knihy->links() }}
            @else
                <p>{{ $user->fname }} nema ziadne posty</p>
            @endif
            </div>
        </div>
    </div>
@endsection