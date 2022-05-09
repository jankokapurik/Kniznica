@props([
    'name' => $name,
    'value' => $value
    ])

<div class="flex">
    <p class="p-1 mt-0">Vaše hodnotenie:</p>
    <div class="ratingsystem text-xl flex flex-row-reverse">
        @for ($i = 5; $i > 0; $i--)
            <input type="radio" name={{ $name }} value="{{ $i }}" id="rate-{{ $i }}" {{$i == $value ? 'checked' : ''}}>
            <label for="rate-{{ $i }}">&#9733</label>            
        @endfor
    </div>
</div>