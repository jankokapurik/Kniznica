@props(['comment' => $comment])

<div>
    {{ dd($comment->book) }}
</div>


{{-- <div class="mb-4">
    <a href="" class="font-bold"></a> <span class="text-grey-600 text-sm">{{ $comment->created_at->diffForHumans() }}</span> --}}
    {{-- {{ $comment->user->fname}} {{ $comment->user->lname}}
    {{ route('users.knihy', $comment->user) }}
    <p class="mb-2">{{ $comment->body }}</p>

    @can('delete', $comment)
    <form action=" {{route('knihy.destroy', $comment)}} " method="post">
    <form action="" method="post">
        @csrf   
        @method('DELETE')
        <button type="submit" class="text-blue-500">Delete</button>
    </form>
    @endcan

     <div class="flex items-center">
        @auth
            @if (!$comment->likedBy(auth()->user()))
                <form action=" {{ route('knihy.likes', $comment) }} " method="post" class="mr-1">
                    @csrf
                    <button type="submit" class="text-blue-500">Like</button>
                </form>
            @else
                <form action="{{ route('knihy.likes', $comment) }}" method="post" class="mr-1">
                    @csrf
                    @method('DELETE')   
                    <button type="submit" class="text-blue-500">Unlike</button>
                </form>
            @endif
        @endauth

        <span>{{ $comment->likes->count() }} {{ Str::plural('like', $comment->likes->count()) }} </span>
    </div>
</div> --}} 