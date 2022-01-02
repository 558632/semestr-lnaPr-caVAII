//registracia-page

window.onload = function () {
    element = document.getElementById("Meno");
    fun(element);
    element1=document.getElementById("Priezvisko");
    fun(element1);
    element2 = document.getElementById("Cislo_op");
    fun(element2);
    element3 = document.getElementById("Datum_narodenia");
    fun(element3);
    element4 = document.getElementById("telefon");
    fun(element4);
    element5 = document.getElementById("email");
    fun(element5);
    element6 = document.getElementById("krajina");
    fun(element6);
    element7 = document.getElementById("Obec");
    fun(element7);
    element8 = document.getElementById("psc");
    fun(element8);
    element9 = document.getElementById("ulica");
    fun(element9);
    element10 = document.getElementById("popisne");
    fun(element10);
    element11 = document.getElementById("login");
    fun(element11);
    element12 = document.getElementById("heslo");
    fun(element12);
    element13 = document.getElementById("heslo1");
    fun(element13);
}
function kontrola (hodnota = null, elementId){
    let val= "";
    if ((hodnota==null || hodnota.length==0) &&(elementId!="telefon")) {
        val="Pole "+elementId+" musí byť zadané.";
    }if(RegExp('^\\S+@\\S+\\.\\S+$').test(hodnota)!=true&&elementId=="email"==true){
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
        if (result!="") {
            elementPlus = document.createElement("div")
            elementPlus.id = "error"+element.id;
            elementPlus.innerText = result;
            elementPlus.classList.add("chyba");
            if(document.getElementById("error"+element.id)!=null){
                document.getElementById("error"+element.id).remove();
                element.after(elementPlus);
            }else{
                element.after(elementPlus);
            }
        } else {
            if(elementPlus!=null==true){
                elementPlus.remove();
            }
        }
        if (document.querySelectorAll(".chyba").length>0==true) {
            document.getElementsByName("Odoslat1")[0].disabled=true;
        } else {
            document.getElementsByName("Odoslat1")[0].disabled=false;
        }
    }
    element.dispatchEvent(new Event('input'));
}