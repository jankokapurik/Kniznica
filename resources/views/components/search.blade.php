@props([
    'values' => $values,
])

<div id="book_list" class="flex flex-col">
    <div tabindex="0" id="switcher">
        
        <div class="relative" id="focuser">
            <form action="{{ route('search2') }}" method="get" class="flex flex-row" id="formstorage">
                <label for="search" class="sr-only">Name</label>
                <input id="input" autocomplete="off" type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500"">    
                <button class="bg-blue-500 p-2 rounded-md text-white">Hladat</button>
            </form>
            
            <div id="container" class="hidden transition bg-white inset-x-0 divide-y border-2 rounded-md capitalize">
            </div>
        </div>
    </div>
</div>

<script>
    let switcher = document.getElementById("switcher");
    let focuser = document.getElementById("focuser");
    let input = document.getElementById("input");
    let container = document.getElementById("container");
    let formstorage = document.getElementById("formstorage");

    focuser.focusvalue = -1;
    let allbooks = @json($values);

    let attributes = ["title", "authors_fname", "authors_lname"];

    switcher.addEventListener('focusin', function(e){
        if(this.contains(e.relatedTarget)) return false;
        if(container.childElementCount) open_s();
    }); 

    switcher.addEventListener('focusout', function(e){
        if(this.contains(e.relatedTarget)) return false;
        close_s();
    });

    function open_s(){
        container.classList.remove('hidden');
        container.classList.add('absolute');
    }

    function close_s(){
        container.classList.remove('absolute');
        container.classList.add('hidden');
    }

    input.addEventListener('input', function(e){
        container.innerHTML = "";
        focuser.focusvalue = -1;
        if(!(input.value)) {
            close_s();
            return false;
        }
        
        for(book of allbooks){            
            contain = false;
            for(attribute of attributes){
                if(book[attribute].toString().toLowerCase().includes(input.value.toString().toLowerCase())) contain = true;
            }

            if(contain){
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
                block.indexId = book['id'];

                block.addEventListener('click',function(e){
                    input.value = this.value;
                    formstorage.submit();
                });

                container.appendChild(block);
            }
        }

        if(!container.childElementCount) close_s();
        else open_s();
    });

    input.addEventListener("keydown",function(e){
        console.log(e.code);

        if(e.code == 'Enter'){
            if(focuser.focusvalue >= 0){
                input.value = container.childNodes[focuser.focusvalue].firstChild.textContent;
                formstorage.submit();
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