window.onload=function (){
    functionWhenInputted(document.getElementById("password_for_modification1"));
    functionWhenInputted(document.getElementById("name_modification1"));
    functionWhenInputted(document.getElementById("suername_modification1"));
}

function kontrola(paHodnota, paElementId){
    let result="";
    if(paHodnota==null || paHodnota.length==0){
        result = "Pole "+paElementId+" musí byť zadané.";
    }if(paHodnota.length>0 && (paElementId=="name_modification1" || paElementId=="suername_modification1")){
        let pattern = new RegExp('^[Á-Ž|A-Z].*$');
        if(!pattern.test(paHodnota)){
            result = "Pole "+paElementId+" musí začínať veľkým písmenom.";
        }
        pattern = new RegExp('^.[a-z|á-ž]{1,24}$');
        if(!pattern.test(paHodnota)){
            if(result==""){
                result="Pole "+paElementId+" v texte za začiatočným písmenom obsahuje iné znaky než malé písmená alebo menej než jeden."
            }else{
                result+="\nPole "+paElementId+" v texte za začiatočným písmenom obsahuje iné znaky než malé písmená alebo menej než jeden."
            }
        }
    }
    return result;
}

function functionWhenInputted (paElement){
    paElement.oninput = function (udalost) {
        let result = kontrola(udalost.target.value, paElement.id);
        if(document.getElementById("error"+paElement.id)!=null && result==""){
            document.getElementById("error"+paElement.id).remove();
        }else if(result!=""){
            if(document.getElementById("error"+paElement.id)!=null){
                document.getElementById("error"+paElement.id).remove();
            }
            let errEl=document.createElement("div");
            errEl.id="error"+paElement.id;
            errEl.innerText=result;
            errEl.classList.add("chyba");
            paElement.after(errEl);
        }
        if (document.querySelectorAll("div.chyba").length>0) {
            document.getElementsByName("Odoslat4")[0].disabled=true;
        } else {
            document.getElementsByName("Odoslat4")[0].disabled=false;
        }
    }
    paElement.dispatchEvent(new Event('input'));
}