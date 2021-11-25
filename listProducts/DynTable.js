class DynTable{
    constructor(paData, paHTMLElement) {
        this.data=paData;
        this.HTMLElement=paHTMLElement;
        this.ucinTabulku();
        this.naposledyUtriedene=null;
    }
    ucinTabulku(){
        this.HTMLElement.innerHTML="";
        let hlavicka=this.ucinHlavicku();
        let telo=this.ucinTelo();
        let table=`<table>${telo}</table>`;
        this.HTMLElement.innerHTML=table;
        this.HTMLElement.querySelector("table").prepend(hlavicka);
    }
    ucinHlavicku(){
        let prvok=this.data[2];
        let riadok=document.createElement('tr');
        Object.keys(prvok).forEach((nazov)=>{
            let th=document.createElement('th');
            th.innerHTML=nazov;
            th.style.cursor="pointer";
            th.onclick=()=>{
                this.utried(nazov);
            }
            riadok.appendChild(th);
        })
        return riadok;
    }
    ucinTelo(){
        let textTela="";
        let keys=Object.keys(this.data[3]);
        this.data.forEach((object)=>{
            let textRiadku="";
            keys.forEach((atribut)=>{
                textRiadku+=`<td>${object[atribut]}</td>`;
            });
            textTela+=`<tr>${textRiadku}</tr>`;
        });
        return textTela;
    }
    utried(podla){
        if(this.naposledyUtriedene==null && this.naposledyUtriedene != podla){
            this.data.sort(function (a,b){
                return String(a[podla]).localeCompare(String(b[podla]));
            });
            this.naposledyUtriedene=podla;
        }else{
            this.data.sort(function (a,b){
                return String(b[podla]).localeCompare(String(a[podla]));
            });
            this.naposledyUtriedene=null;
        }
        this.ucinTabulku();
    }
}