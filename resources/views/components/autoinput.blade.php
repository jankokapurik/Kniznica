@props([
    'name' => $id,
    'values' => $values
])

{{--  --}}

<div class='relative text-black' id="input-field">
    <div class="relative">
        <label for="search" class="sr-only">Name</label>
        <input autocomplete="off" id="{{ $name }}" type="text" name="search" placeholder="Vyhľadaj" class="bg-gray-100 border-2 border-gray-100 w-full p-1 rounded-lg mr-2 focus:outline-none focus:border-gray-400 focus:ring-0 hover:border-gray-300 trasition duration-500">
    </div>

    <div id="{{ $name }}-container" class="absolute transition bg-white inset-x-0 divide-y border-2 rounded-md">
        <div class="flex flex-col capitalize">
            {{-- <div>Meno knihy</div>
            <div> autor </div>
            <div>Meno knihy</div>
            <div> autor </div>
            <div>Meno knihy</div>
            <div> autor </div> --}}
        </div>
    </div>
</div>

<script>    
    function autoinput(input_element, input_values, input_properties) {
    let properties = input_properties;
    let input = input_values;
    let input_field = input_element;
    let container_field = document.getElementById(input_field.id + "-container");
    let form_field = document.getElementById(input_field.id + "-form");

    let values = [];
    input.forEach(inp => {
        obj = new Object();
        properties.forEach(property => {
            obj[property] = inp[property];
        });    
        values.push(obj);
    });

    input_field.addEventListener("input",function(e){
        input_value = input_field.value.toString().toLowerCase();
        
        container_field.innerHTML = '';
        if(!input_value) return false;


        
        values.forEach((value, number) => {
            if(number < 5){   /// potreba opravit skaredy kod
                let a = false;
                Object.values(value).forEach(word => {            
                    if(word.toString().toLowerCase().includes(input_value)){
                        a = true;
                        return true;
                    } 
                });
                
                if(a){
                    index = 0;
                    for(key in value){
                        if(!index){
                            component = document.createElement("div");

                            component.addEventListener("mousedown", function(e){
                                e.preventDefault();

                                input_field.value = this.text;
                                // document.getElementById(input_field.id + "-form").submit();
                                add_book();
                            });


                            component.className = "flex flex-col p-2 hover:bg-gray-200";
                            component.text = value[key].toString().charAt(0) + value[key].toString().slice(1);
                            container_field.appendChild(component);

                            tytle = document.createElement("div");
                            tytle.className = "text-base";
                            
                            text = value[key].toString().toLowerCase().replaceAll(input_value,'<strong class="bg-blue-200 rounded-md">'+ input_value + '</strong>');
                            tytle.innerHTML = text;
                            tytle.className = "capitalize";
                            component.appendChild(tytle);
    
                            subtytles = document.createElement("div");
                            subtytles.className = "flex flex-row";
                            component.appendChild(subtytles);
                        }
                        else{            
                            subtytle = document.createElement("div");
                            subtytle.className = "capitalize text-xs text-gray-600 mr-2";
    
                            text = value[key].toString().toLowerCase().replaceAll(input_value,'<strong class="bg-blue-200 rounded-md">'+ input_value + '</strong>');
                            subtytle.innerHTML = text;
                            subtytles.appendChild(subtytle);
                        }
                        index++;
                    }

                }
            }                        
        });
    });


    input_field.addEventListener("keydown", function(e){         
        // e.preventDefault();
        count = container_field.childElementCount;

        //key down
        if(e.keyCode == 40) {            
            if(this.focus >= 0){
                container_field.childNodes[this.focus].classList.remove("bg-gray-200");
                container_field.childNodes[this.focus].classList.add("bg-white");
            }              
            
            if(this.focus + 1 >= count) this.focus = 0;
            else this.focus++;

            container_field.childNodes[this.focus].classList.remove("bg-white");
            container_field.childNodes[this.focus].classList.add("bg-gray-200");            
        }
        //key up
        else if(e.keyCode == 38){
            e.preventDefault();
            if(this.focus >= 0){
                container_field.childNodes[this.focus].classList.remove("bg-gray-200");
                container_field.childNodes[this.focus].classList.add("bg-white");
            }
            
            if(this.focus == 0) this.focus = count-1;
            else this.focus--;

            container_field.childNodes[this.focus].classList.remove("bg-white");
            container_field.childNodes[this.focus].classList.add("bg-gray-200");
        }
        //key left
        else if(e.keyCode == 39){
            input_field.value = container_field.childNodes[this.focus].text;
        }
        //enter
        else if(e.keyCode == 13){
            if(this.focus >= 0){
                e.preventDefault();
                input_field.value = container_field.childNodes[this.focus].text;
                // document.getElementById(input_field.id + "-form").submit();
                add_book();
            }
        }
        else this.focus = -1;
    });

    input_field.addEventListener("focusin", function(event){
        container_field.classList.remove("opacity-0");
        container_field.classList.remove("invisible");
        this.focus = -1;
    });

    input_field.addEventListener("focusout", function(event){        
        setTimeout(() => {
            container_field.classList.add("invisible");
            this.focus = -1;
        }, 150);

        container_field.classList.add("opacity-0");
        
    });
}

autoinput(document.getElementById("{{$name}}"), @json($values), ['title', 'authors_lname', 'authors_fname']); //new version
</script>