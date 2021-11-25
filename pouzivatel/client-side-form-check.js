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
    if ((hodnota==null==true || hodnota.length==0==true)&&
        (elementId=="Meno" || elementId=="Priezvisko" || elementId=="Cislo_op" || elementId=="Datum_narodenia"
            || elementId=="telefon" || elementId=="email" || elementId=="krajina" || elementId=="Obec" || elementId=="psc"
            || elementId=="ulica" || elementId=="popisne" || elementId=="login" || elementId=="heslo" || elementId=="heslo1")) {
        val+="Pole "+elementId+" musí byť zadané.";
    }/*if(RegExp('^\\S+@\\S+\\.\\S+$').test(hodnota)!=true&&elementId=="email"==true){
        val+="\nPole "+elementId+" musí mať stanovený formát.";
    }*/
    return val;
}
function fun (element){
    element.oninput = function (event) {
        let result = kontrola(event.target.value, element.id);
        let elementPlus = document.getElementById("error"+element.id);
        if (result!=""==true) {
            elementPlus = document.createElement("div")
            elementPlus.id = "error"+element.id;
            elementPlus.innerText = result;
            elementPlus.classList.add("chyba");
            element.after(elementPlus);
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