function autocomplete(element, values){
    container = document.createElement("div");
    container.className = "absolute bg-white inset-x-0 divide-y border-2 rounded-md"; 
    container.id = element.id + "-container";
    container.style.visibility= "hidden";
    element.focus = -1;
    element.count = 0;
    element.parentNode.appendChild(container);

    element.addEventListener("input",function(e){            
        var input = this.value.toString();
        container = document.getElementById(this.id + "-container");
        container.innerHTML = '';

        if(!input) return false;

        matches = [];
        values.forEach(function(value, index){
            if(value.toString().toLowerCase().includes(input.toLowerCase())) {
                matches.push(value)
            };
        })
        this.count = matches.lenght;

        matches.forEach(function(value, index){
            component = document.createElement("div");
            component.className = "p-2 hover:bg-gray-200";

            text = index.toString() + ": " + value[0].toString().toLowerCase()+": "+value[1].toString().toLowerCase();
            text2 = text.replaceAll(input,'<strong>'+ input + '</strong>');
            component.innerHTML = text2;

            container.appendChild(component);
        });

        if(container.innerHTML) container.style.visibility= "visible";
        else container.style.visibility= "hidden";
    });

    element.addEventListener("keydown", function(e){  
        container = document.getElementById(this.id + "-container");            
        count = container.childElementCount;
        // alert(a);
        //key down
        if(e.keyCode == 40) {            
            if(this.focus >= 0)container.childNodes[this.focus].style.backgroundColor = "white";                
            
            if(this.focus + 1 >= count) this.focus = 0;
            else this.focus++;

            container.childNodes[this.focus].style.backgroundColor = "#d1d5db";
        }
        //key up
        else if(e.keyCode == 38){
            if(this.focus >= 0)container.childNodes[this.focus].style.backgroundColor = "white";
            
            if(this.focus == 0) this.focus = count-1;
            else this.focus--;

            container.childNodes[this.focus].style.backgroundColor = "#d1d5db";
        }
        else this.focus = -1;

    });

    element.addEventListener("focusout", function(){
        container.innerHTML = '';
        container.style.visibility= "hidden";
        this.focus = -1;
    });
};

