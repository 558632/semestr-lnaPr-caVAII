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
        this.HTMLElement.innerHTML=`<table>${hlavicka}${telo}</table>`;
    }
    ucinHlavicku(){
        let prvok=this.data[2];
        let textHlavicky=`<thead>`;
        let riadok=`<tr>`;
        Object.keys(prvok).forEach((nazov)=>{
            riadok+=`<th style="cursor: pointer" onclick="this.utried(${nazov})">${nazov}</th>`;
        })
        textHlavicky+=`${riadok}</tr></thead>`;
        return textHlavicky;
    }
    ucinTelo(){
        let textTela=`<tbody>`;
        let keys=Object.keys(this.data[3]);
        this.data.forEach((object)=>{
            let textRiadku="";
            keys.forEach((atribut)=>{
                textRiadku+=`<td>${object[atribut]}</td>`;
            });
            textTela+=`<tr>${textRiadku}</tr>`;
        });
        return textTela+=`</tbody>`;
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