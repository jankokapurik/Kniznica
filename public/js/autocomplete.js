function autocomplete(input_element, input_values, input_properties) {
    let properties = input_properties;
    let input = input_values;
    let input_field = input_element;
    let container_field = document.getElementById(input_field.id + "-container");

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
                            component.className = "flex flex-col p-2";
                            component.text = value[key].toString().charAt(0) + value[key].toString().slice(1);
                            container_field.appendChild(component);
    
                            tytle = document.createElement("div");
                            tytle.className = "text-base";
                            
                            text = value[key].toString().toLowerCase().replaceAll(input_value,'<strong>'+ input_value + '</strong>');
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
    
                            text = value[key].toString().toLowerCase().replaceAll(input_value,'<strong>'+ input_value + '</strong>');
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
        count = container_field.childElementCount;

        //key down
        if(e.keyCode == 40) {            
            if(this.focus >= 0)container_field.childNodes[this.focus].style.backgroundColor = "white";                
            
            if(this.focus + 1 >= count) this.focus = 0;
            else this.focus++;

            container_field.childNodes[this.focus].style.backgroundColor = "#d1d5db";
        }
        //key up
        else if(e.keyCode == 38){
            if(this.focus >= 0)container_field.childNodes[this.focus].style.backgroundColor = "white";
            
            if(this.focus == 0) this.focus = count-1;
            else this.focus--;

            container_field.childNodes[this.focus].style.backgroundColor = "#d1d5db";
        }
        //key left
        else if(e.keyCode == 39){
            console.log(container_field.childNodes[this.focus].text);
            input_field.value = container_field.childNodes[this.focus].text;
        }
        else this.focus = -1;
        
    });

    input_field.addEventListener("focusout", function(){
        console.log("FOUT");
        container_field.innerHTML = '';
        this.focus = -1;
    });
}

