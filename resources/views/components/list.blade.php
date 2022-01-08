@props([
    'values' => $values,
    'oldbooks' => $books,
])

<div id="book_list" class="flex flex-col">
    @foreach ($oldbooks as $book)
        <div class="bg-gray-200 p-1 rounded mt-2 flex flex-row">
            <button onclick="delete_b(event);" type="button" value="{{$book->id}}" class="mr-2 bg-red-500 p-2 rounded-md">zmazat</button>
            <p class="mr-2 w-full bg-gray-200 p-2 rounded-md">{{$book->title}}</p>
        </div>
    @endforeach

    <div tabindex="0" id="switcher" class="bg-green-400 p-2 rounded-md mt-2">
        <p id="infotext" class="block">Pridať knihu</p>
        
        <div class="relative hidden" id="focuser">
            <div class="flex flex-row">
                <label for="search" class="sr-only">Name</label>
                <input id="input" autocomplete="off" type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500"">    
                <button class="bg-blue-500 p-2 rounded-md">Pridať</button>
            </div>
            
            <div id="container" class="absolute transition bg-white inset-x-0 divide-y border-2 rounded-md">
                <div class="flex flex-col capitalize">
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    let switcher = document.getElementById("switcher");
    let infotext = document.getElementById("infotext");
    let focuser = document.getElementById("focuser");
    let input = document.getElementById("input");
    let container = document.getElementById("container");
    focuser.focusvalue = -1;


    let allbooks = @json($values);

    let attributes = ["title", "authors_fname", "authors_lname", "id"];

    let bookstorage=[];

    for(book of @json($oldbooks)){
        bookstorage.push(book['id']);
    }
    console.log(bookstorage);

    switcher.addEventListener('focusin', function(e){
        if(this.contains(e.relatedTarget)) return false;
        open_s();
    }); 

    switcher.addEventListener('focusout', function(e){
        if(this.contains(e.relatedTarget)) return false;
        close_s();
    });

    function open_s(){
        container.innerHTML = "";
        infotext.classList.remove('block');
        infotext.classList.add('hidden');
        focuser.classList.remove('hidden');
        focuser.classList.add('block');

        input.focus();
    }

    function close_s(){
        infotext.classList.remove('hidden');
        infotext.classList.add('block');
        focuser.classList.remove('block');
        focuser.classList.add('hidden');

        input.value = '';

        switcher.blur();
    }

    function add_b(indexId){      
        bookstorage.push(indexId);
        console.log(bookstorage);

        block = document.createElement('div');
        block.className = "flex flex-row bg-gray-200 p-1 rounded mt-2";
        
        delete_button = document.createElement('button');
        delete_button.className = "mr-2 bg-red-500 p-2 rounded-md";
        delete_button.textContent = "zmazat";
        delete_button.onclick = delete_b;
        delete_button.value = indexId;

        content = document.createElement('div');
        content.className = "mr-2 w-full bg-gray-200 p-2 rounded-md";
        content.textContent = input.value;

        block.appendChild(delete_button);
        block.appendChild(content);

        switcher.parentNode.insertBefore(block, switcher);
        close_s();
    }

    function delete_b(event) {        
        console.log("INDEX: " + event.target.value);
        index = bookstorage.indexOf(parseInt(event.target.value));

        bookstorage.splice(index, 1);
        console.log(bookstorage);

        event.target.parentNode.remove();
    }

    //////solo
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

    function action() {
        add_b();
    }
    
</script>