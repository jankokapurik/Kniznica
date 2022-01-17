@props([
    'name' => $name,
    'value' => $value
    ])

<div class="flex">
    <p class="p-1 mt-0">Your rating:</p>
    <div class="ratingsystem text-xl flex flex-row-reverse">
        {{-- <input type="radio" name={{ $name }} value="5" id="rate-5">
        <label for="rate-5">&#9733</label>
        <input type="radio" name={{ $name }} value="4" id="rate-4">
        <label for="rate-4">&#9733</label>
        <input type="radio" name={{ $name }} value="3" id="rate-3">
        <label for="rate-3">&#9733</label>
        <input type="radio" name={{ $name }} value="2" id="rate-2">
        <label for="rate-2">&#9733</label>
        <input type="radio" name={{ $name }} value="1" id="rate-1">
        <label for="rate-1">&#9733</label> --}}

        @for ($i = 5; $i > 0; $i--)
            <input type="radio" name={{ $name }} value="{{ $i }}" id="rate-{{ $i }}" {{$i == $value ? 'checked' : ''}}>
            <label for="rate-{{ $i }}">&#9733</label>            
        @endfor
    </div>
</div>