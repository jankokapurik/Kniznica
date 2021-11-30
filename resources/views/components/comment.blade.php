@props(['comment' => $comment])

<div class="mb-4">    
    <a href="">{{ $comment->user->fname }}</a>
    <span class="text-grey-600 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
    
    <p>{{ $comment->comment }}</p>

    @can('delete', $comment)
    <form action="{{route('comment.destroy', $comment)}}" method="post">
        @csrf   
        @method('DELETE')
        <button type="submit" class="text-blue-500">Delete</button>
    </form>
    @endcan
     
    @can('update', $comment) 
        <a href="{{route('comment.edit', $comment)}}" class="text-green-500">Edit</a>
    @endcan

</div>