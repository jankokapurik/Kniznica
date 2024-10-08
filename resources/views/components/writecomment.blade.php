@props(['book' => $book])

<div class="bg-white rounded-lg">
    <form action="{{ route('comments') }}" method="post" class="mb-4">
        @csrf
        <input type="hidden" name="book" value="{{ $book->id }}" />

        <div class="mb-4 bg-white">
            <label for="rating"></label>
            <div class="flex">
                <p class="p-1 mt-0">Vaše hodnotenie:</p>
                <div class="ratingsystem text-xl flex flex-row-reverse">
                    <input type="radio" name="rating" value="5" id="rate-5">
                    <label for="rate-5">&#9733</label>
                    <input type="radio" name="rating" value="4" id="rate-4">
                    <label for="rate-4">&#9733</label>
                    <input type="radio" name="rating" value="3" id="rate-3">
                    <label for="rate-3">&#9733</label>
                    <input type="radio" name="rating" value="2" id="rate-2">
                    <label for="rate-2">&#9733</label>
                    <input type="radio" name="rating" value="1" id="rate-1">
                    <label for="rate-1">&#9733</label>
                </div>
            </div>
            @error('rating')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 w-full p-4 rounded-lg 
            border-2 outline-none focus:border-gray-400 transition duration-500
            @error('body') border-red-500 @enderror" placeholder="Pošlite niečo!"></textarea>
    
            @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror

            <div>
                <button type="submit" class="bg-blue-500 border-2 border-blue-500 p-2 rounded-md text-white hover:bg-blue-100 hover:text-blue-500 trasition duration-500 mt-2">Pridať</button>
            </div>
        </div>
    </form>
</div>