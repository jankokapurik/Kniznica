@props(['book' => $book])

<div class="w-8/12 bg-white rounded-lg">
    <form action="{{ route('comments') }}" method="post" class="mb-4">
        @csrf
        <input type="hidden" name="book" value="{{ $book->id }}" />

        <div class="mb-4 bg-white">
            <label for="rating"></label>
            <input type="number" name="rating" min="1" max="5" step="1" value="1">
            @error('rating')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 vorder-2 w-full p-4 rounded-lg 
            @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>
    
            @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror

            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 reounded font-medium">Pridať</button>
            </div>
        </div>
    </form>
</div>