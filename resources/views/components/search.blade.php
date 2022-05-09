@props([
    'values' => $values,
])

<div id="searchMain" class="flex flex-col">        
    <div class="relative flex" id="searchFocuser">
        <div autocomplete="off" class="relative" tabindex="0" id="searchSwitcher">
            <label for="search" class="sr-only">Name</label>
            <input id="searchInput" autocomplete="off" type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 p-1 rounded-lg focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500">    
            <div id="searchContainer" class="hidden transition bg-white inset-x-0 divide-y border-2 rounded-md capitalize"></div>
        </div>
        <button id="searchButton" class="bg-blue-500 p-1 rounded-md text-white ml-2">Hladat</button>
    </div>
</div>

<script>
    let switcher = document.getElementById("searchSwitcher");
    let focuser = document.getElementById("searchFocuser");
    let input = document.getElementById("searchInput");
    let container = document.getElementById("searchContainer");

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
            if(container.childElementCount > 5) break;

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
                    document.getElementById("searchButton").click();
                });

                container.appendChild(block);
            }
        }

        if(!container.childElementCount) close_s();
        else open_s();
    });

    input.addEventListener("keydown",function(e){
        if(e.code == 'Enter'){
            if(focuser.focusvalue >= 0){
                input.value = container.childNodes[focuser.focusvalue].firstChild.textContent;
                document.getElementById('button').click();
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