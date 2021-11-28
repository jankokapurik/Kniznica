@props(['comment' => $comment])

<div class="mb-4">    
    <a href="">{{ $comment->user->fname }}</a>
    <span class="text-grey-600 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
    
    <p>{{ $comment->comment }}</p>

    @can('delete', $comment)
    {{-- {{dd($comment->id)}} --}}
    <form action="{{route('comment.destroy', $comment)}}" method="post">
        @csrf   
        @method('DELETE')
        {{-- <input type="hidden" name="comment_id" value=$comment->id> --}}
        <button type="submit" class="text-blue-500">Delete</button>
    </form>
    @endcan
    aa 
    {{-- <a href="#"></a> --}}
    {{-- treba delete => change ale zatialto bude fungovat  --}}
    @can('delete', $comment) 
        {{-- <form action="{{route('comment.edit', $comment)}}" method="post">            
            @csrf
            @method('PATCH')
            <button class="text-green-500" type="submit">Edit</button>
        </form> --}}
        <a href="{{route('comment.edit', $comment)}}" class="text-green-500">Edit</a>
    @endcan

</div>