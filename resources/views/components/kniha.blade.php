@props(['kniha' => $kniha])

<div class="mb-4">
    <a href="" class="font-bold">{{ $kniha->user->fname}} {{ $kniha->user->lname}}</a> <span class="text-grey-600 text-sm">{{ $kniha->created_at->diffForHumans() }}</span>
    {{-- {{ route('users.knihy', $kniha->user) }} --}}
    <p class="mb-2">{{ $kniha->body }}</p>

    @can('delete', $kniha)
    <form action=" {{route('knihy.destroy', $kniha)}} " method="post">
        @csrf   
        @method('DELETE')
        <button type="submit" class="text-blue-500">Delete</button>
    </form>
    @endcan

    {{-- <div class="flex items-center">
        @auth
            @if (!$kniha->likedBy(auth()->user()))
                <form action=" {{ route('knihy.likes', $kniha) }} " method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('knihy.likes', $kniha) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')   
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
        @endauth

        <span>{{ $kniha->likes->count() }} {{ Str::plural('like', $kniha->likes->count()) }} </span>
    </div> --}}
</div>