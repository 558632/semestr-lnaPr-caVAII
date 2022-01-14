window.onload=function (){
    createData(data);
}
function createData(paData){
    let dataOfPlaces=paData;
    let element=document.getElementById("miesta");
    element.innerHTML="";
    element.innerHTML+=`<h3>Naše predajne:</h3>`;
    let content="";
    let buttons="";
    let municipalities = [];
    let keys=Object.keys(dataOfPlaces[0]);
    dataOfPlaces.forEach((object)=>{
        let item="";
        keys.forEach((att)=>{
            if(att!="municipality"){
                if(object["municipality"]=="Bratislava"){
                    if(item==""){
                        item+=`<div id="municipality_bratislava">`;
                    }
                    item+=`<strong>${att}</strong>`;
                    item+=`${object[att]}<br>`;
                }else{
                    if(item==""){
                        item+=`<div id="municipalities_others">`;
                    }
                    item+=`<strong>${att}</strong>`;
                    item+=`${object[att]}<br>`;
                }

            }else{
                if(municipalities.indexOf(object[att])==-1){
                    municipalities.push(object[att]);
                    buttons+=`<button class="by_municipality" onclick="vytvorDataPodlaOblasti(this)" type="button" id="${object[att]}">${object[att]}</button>`;
                }
            }
        });
        content+=`${item}</div><br>`;
    });
    element.innerHTML+=`${buttons}<br>`;
    element.innerHTML+=`${content}`;
}
function vytvorDataPodlaOblasti(paTlacidlo){
    let id=paTlacidlo.id;
    let dataMiest=data;
    let html=document.getElementById("miesta");
    html.innerHTML="";
    html.innerHTML+=`<h3>Naše predajne</h3>`;
    let htmlTela="";
    let htmlTlacidiel="";
    let oblast = [];
    let keys=Object.keys(dataMiest[0]);
    dataMiest.forEach((object)=>{
        let textRiadku="";
        keys.forEach((atribut)=>{
            if(object["municipality"]==id){
                if(atribut!="municipality"){
                    if(textRiadku==""){
                        textRiadku+=`<div class="by_municipality">`;
                    }
                    textRiadku+=`<strong>${atribut}</strong>`;
                    textRiadku+=`${object[atribut]}<br>`;
                }
            }else{
                if(atribut=="municipality" && oblast.indexOf(object[atribut])==-1){
                    oblast.push(object[atribut]);
                    htmlTlacidiel+=`<button class="by_municipality" onclick="vytvorDataPodlaOblasti(this)" type="button" id="${object[atribut]}">${object[atribut]}</button>`;
                }
            }
        });
        if(textRiadku!=""){
            htmlTela+=`${textRiadku}</div><br>`;
        }
    });
    html.innerHTML+=`<div>Načítané dáta pre oblasť: ${id}</div><br>`;
    html.innerHTML+=`<button class="all_municipalities" onclick="createData(data)" type="button" id="vsetkyOblasti">Načítať všetky oblasti</button>`;
    html.innerHTML+=`${htmlTlacidiel}<br><br>`;
    html.innerHTML+=`${htmlTela}`;
}