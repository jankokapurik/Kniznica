@props(['comment' => $comment])

<div class="mb-4">  
      
    <a href="">{{ $comment->user->fname }}</a>
    <span class="text-grey-600 text-sm text-blue-400">{{ $comment->created_at->diffForHumans() }}</span>

    <x-ratingbar :rating="$comment->rating"/>

    <p>{{ $comment->comment }}</p>

    <div class="flex">
        @can('delete', $comment)
        <form action="{{route('comment.destroy', $comment)}}" method="post">
            @csrf   
            @method('DELETE')
            <button type="submit" class="text-blue-500 text-sm p-1 mt-0">Zmazať</button>
        </form>
        @endcan
        
        @can('update', $comment) 
            <a href="{{route('comment.edit', $comment)}}" 
            class="text-green-500 text-sm p-1 mt-0">Upraviť</a>
        @endcan
    </div>
</div>