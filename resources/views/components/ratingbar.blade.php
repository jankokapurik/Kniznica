@props(['rating' => $rating])

<div class="flex">
    @for ($i = 0; $i < 5; $i++)
        @if ($rating > $i)
            <p class="ratingshow-filled text-sm">&#9733</p>
        @else
            <p class="ratingshow-empty text-sm">&#9733</p>
        @endif            
    @endfor
</div>