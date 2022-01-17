@props([
    'name' => $id,
    'values' => $values
])

{{-- 
<div {{ $attributes->merge(['class' => 'relative']) }}>
    <form id="{{ $name }}-input-form" autocomplete="off" action="{{ route('search2') }}" method="get" class="flex items-center">
        @csrf
            <div class="relative">
                <label for="search" class="sr-only">Name</label>
                <input id="{{ $name }}-input" type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500">
            </div>
        <button type="submit" class="bg-blue-500 border-2 border-blue-500 text-white p-1 rounded font-medium  hover:bg-blue-100 hover:text-blue-500 trasition duration-500">Hľadaj</button>
    </form>

    <div id="{{ $name }}-input-container" class="absolute transition bg-white inset-x-0 divide-y border-2 rounded-md">
        <div class="flex flex-col hover:bg-gray-200">
        <div class="flex flex-col hover:bg-gray-200"> --}}
            {{-- <div>Meno knihy</div>
            <div> autor </div> --}}
        </div>
        {{-- </div>
    </div>
</div>
</div> --}}

<script>

// let switcher = document.getElementById("switcher");
// let infotext = document.getElementById("infotext");
let focuser = document.getElementById("focuser");
let input = document.getElementById("input");
let container = document.getElementById("container");
// let formstorage = document.getElementById("formstorage");

input.addEventListener('input', function(e){
    container.innerHTML = "";
    focuser.focusvalue = -1;
    if(!(input.value)) return false;                
    
    for(book of allbooks){            
        contain = false;
        for(attribute of attributes){
            if(book[attribute].toString().toLowerCase().includes(input.value.toString().toLowerCase())) contain = true;
        }

        if(contain && !bookstorage.includes(book.id)){
            block = document.createElement('div');
            block.className = "flex flex-col hover:bg-gray-200";

            title = document.createElement('div');
            title.innerHTML = book[attributes[0]].toString().toLowerCase().
            replaceAll(input.value.toString().toLowerCase(), "<strong>" + input.value.toString().toLowerCase() + "</strong>");

            body = document.createElement('div');
            body.className = "flex flex-row";

            for(attribute of attributes.slice(1, attributes.lenght)){
                child = document.createElement('div');
                child.className = "mr-2";

                child.innerHTML = book[attribute].toString().toLowerCase().
                replaceAll(input.value.toString().toLowerCase(), "<strong>" + input.value.toString().toLowerCase() + "</strong>");

                body.appendChild(child);
            }

            block.appendChild(title);
            block.appendChild(body);


            block.value = book[attributes[0]];
            block.indexId = book['id']; //book['id']

            block.addEventListener('click',function(e){
                input.value = this.value;
                add_b(this.indexId);
            });

            container.appendChild(block);
        }
    }
});

input.addEventListener("keydown",function(e){
    console.log(e.code);

    if(e.code == 'Enter'){
        if(focuser.focusvalue >= 0){
            e.preventDefault();
            input.value = container.childNodes[focuser.focusvalue].firstChild.textContent;
            console.log("INDEXOF==" + container.childNodes[focuser.focusvalue].indexId);
            add_b(container.childNodes[focuser.focusvalue].indexId);
            return false;
        }
        if(container.childElementCount){
            e.preventDefault();
            input.value = container.childNodes[0].firstChild.textContent;
            console.log(container.firstChild.indexId);
            add_b("INDEXOF==" + container.firstChild.indexId);
            return false;
        }
        else{
            console.log("INVALID");
        }
    }

    if(e.code == 'ArrowDown'){
        if(container.childElementCount){
            if(focuser.focusvalue > -1){
                container.childNodes[focuser.focusvalue].classList.remove('bg-gray-100');
                container.childNodes[focuser.focusvalue].classList.add('bg-white');
            }

            focuser.focusvalue ++;                
            if(focuser.focusvalue >= container.childElementCount){
                focuser.focusvalue = 0;
            }

            container.childNodes[focuser.focusvalue].classList.remove('bg-white');
            container.childNodes[focuser.focusvalue].classList.add('bg-gray-100');
        }
    }

    if(e.code == 'ArrowUp'){
        e.preventDefault();

        if(container.childElementCount){
            if(focuser.focusvalue > -1){
                container.childNodes[focuser.focusvalue].classList.remove('bg-gray-100');
                container.childNodes[focuser.focusvalue].classList.add('bg-white');
            }
       
            if(focuser.focusvalue >= 0){
                focuser.focusvalue --;
            }

            if(focuser.focusvalue > -1){
                container.childNodes[focuser.focusvalue].classList.remove('bg-white');
                container.childNodes[focuser.focusvalue].classList.add('bg-gray-100');
            }

        }
    }

    if(e.code == 'ArrowRight'){
        if(focuser.focusvalue >= 0){
            e.preventDefault();
        }

        if(container.childElementCount){
            input.value = container.childNodes[focuser.focusvalue].firstChild.textContent;
        }                
    }

    if(e.code == 'ArrowLeft'){
        if(focuser.focusvalue >= 0){
            e.preventDefault();
        }           
    }
    
});
</script>