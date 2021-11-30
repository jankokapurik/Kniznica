@props(['comment' => $comment])
{{-- {{dd($comment->comment)}} --}}
<div class="w-8/12 bg-white p-6 rounded-lg m-10">

    <form action="{{ route('comment.edit', ['comment' => $comment]) }}" method="post" class="mb-4">
        @csrf        
        @method('patch')

        <div class="mb-4">
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 vorder-2 w-full p-4 rounded-lg 
            @error('body') border-red-500 @enderror"
            >{{$comment->comment}}</textarea>
            
            @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 reounded font-medium">zmenit</button>
            </div>
        </div>
    </form>
</div>