window.onload=function (){
    new DynTable(tableData, document.getElementById("rowNaTabulku"));
}
class DynTable{
    constructor(paData, paHTMLElement) {
        this.data=paData;
        this.HTMLElement=paHTMLElement;
        this.ucinTabulku();
        this.naposledyUtriedene=null;
    }
    ucinTabulku(){
        this.HTMLElement.innerHTML="";
        let table=document.createElement('table');
        table.appendChild(this.ucinHlavicku());
        table.appendChild(this.ucinTelo());
        this.HTMLElement.appendChild(table);
    }
    ucinHlavicku(){
        let prvok=this.data[0];
        let thead=document.createElement('thead');
        let riadok=document.createElement('tr');
        Object.keys(prvok).forEach((nazov)=>{
            let th=document.createElement('th');
            th.innerText=nazov;
            th.style.cursor="pointer";
            th.onclick=()=>{
                this.utried(nazov);
            }
            riadok.appendChild(th);
        })
        thead.appendChild(riadok);
        return thead;
    }
    ucinTelo(){
        let tbody=document.createElement('tbody');
        let keys=Object.keys(this.data[3]);
        this.data.forEach((object)=>{
            let riadok=document.createElement('tr');
            keys.forEach((atribut)=>{
                let td=document.createElement('td');
                td.innerText+=object[atribut];
                riadok.appendChild(td);
            });
            tbody.appendChild(riadok);
        });
        return tbody;
    }
    utried(podla){
        if(this.naposledyUtriedene != podla){
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