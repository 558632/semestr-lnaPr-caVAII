window.onload = function () {
    fun(document.getElementById("Meno"));
    fun(document.getElementById("Priezvisko"));
    fun(document.getElementById("Cislo_op"));
    fun(document.getElementById("Datum_narodenia"));
    fun(document.getElementById("telefon"));
    fun(document.getElementById("email"));
    fun(document.getElementById("krajina"));
    fun(document.getElementById("Obec"));
    fun(document.getElementById("psc"));
    fun(document.getElementById("ulica"));
    fun(document.getElementById("popisne"));
    fun(document.getElementById("login"));
    fun(document.getElementById("heslo"));
    fun(document.getElementById("heslo1"));
}
function kontrola (hodnota, elementId){
    let val= "";
    if ((hodnota==null || hodnota.length==0) && (elementId!="telefon")) {
        val="Pole "+elementId+" musí byť zadané.";
    }if(!RegExp('^\\S+@\\S+\\.\\S+$').test(hodnota) && elementId=="email"){
        val=this.append(val, elementId);
    }if(elementId=="telefon"&&hodnota.length>0){
        let re = new RegExp('^\\+421[0-9]{9}$');
        if (!re.test(hodnota)) {
            val=this.append(val, elementId);
        }
    }if((elementId=="Meno" || elementId=="Priezvisko") &&hodnota.length>0){
        let re= new RegExp('^[Á-Ž|A-Z][a-z|á-ž]{2,25}$');
        if(!re.test(hodnota)){
            val=this.append(val, elementId);
        }
    }if(elementId=="psc"&& hodnota.length>0){
        let re= new RegExp('^[0-9]{5}$');
        if(!re.test(hodnota)){
            val=this.append(val, elementId);
        }
    }
    if(elementId=="popisne"&&hodnota.length>0){
        let re= new RegExp('^([0-9]{1,5}[/]{1}[0-9]{1,5})$');
        if(!re.test(hodnota)){
            val=this.append(val, elementId);
        }
    }if(elementId=="Cislo_op"&&hodnota.length>0){
        let re= new RegExp('^[0-9A-Z]{5,20}$');
        if(!re.test(hodnota)){
            val=this.append(val, elementId);
        }
    }if(elementId=="Datum_narodenia"&&hodnota.length>0) {
        let re = new RegExp('^[0-9-]{8,10}$');
        if (!re.test(hodnota)) {
            val = this.append(val, elementId);
        }
    }
    return val;
}

function append(val, elementId){
    if(val==""){
        val+="Pole "+elementId+" musí mať stanovený formát.";
    }else{
        val+="\nPole "+elementId+" musí mať stanovený formát.";
    }
    return val;
}

function fun (element){
    element.oninput = function (event) {
        let result = kontrola(event.target.value, element.id);
        let elementPlus = document.getElementById("error"+element.id);
        if(elementPlus!=null && result==""){
            elementPlus.remove()
        }else if(result!=""){
            if(elementPlus!=null){
                elementPlus.remove()
            }
            let newElementPlus = document.createElement("div");
            newElementPlus.id = "error"+element.id;
            newElementPlus.innerText = result;
            newElementPlus.classList.add("chyba");
            element.after(newElementPlus);
        }
        if (document.querySelectorAll("div.chyba").length>0) {
            document.getElementsByName("Odoslat1")[0].disabled=true;
        } else {
            document.getElementsByName("Odoslat1")[0].disabled=false;
        }
    }
    element.dispatchEvent(new Event('input'));
}