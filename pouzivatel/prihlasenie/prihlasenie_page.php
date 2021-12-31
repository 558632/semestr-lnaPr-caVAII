<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>prihlasenie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="prihlasenie.css">
    <script>
        let buffer=5;
        function sendToServer() {
            let username = $("#username_prihlasenie").val();
            let password = $("#password_prihlasenie").val();
            const XMLHttp = new XMLHttpRequest();
            XMLHttp.onreadystatechange = function () {
                if (this.readyState != 4 || this.status != 200) {
                    return;
                }
                if(buffer>0){
                    document.getElementById("theContent").append(this.responseText);
                    buffer--;
                }else{
                    buffer=5;
                    document.getElementById("theContent").remove();
                    let element=`<pre id="theContent"></pre>`;
                    document.getElementById("serverResponseCol").innerHTML=element;
                    document.getElementById("theContent").append(this.responseText);
                }
            };
            XMLHttp.open("POST", "prihlasenie_server.php", true);
            XMLHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            XMLHttp.send("username_prihlasenie=" + username + "&password_prihlasenie=" + password);
        }
    </script>
</head>
<body>
<div class="container">
    <div class="sticky-top">
        <div class="row" style="padding: 3px">
            <div class="col-md-3" style="text-align: center; background-color: aqua; border-style: groove"><a
                        href="../../main_page.html" style="color: black; text-decoration-line: none">Hlavná stránka</a>
            </div>
            <div class="col-md-3" style="text-align: center; background-color: aqua; border-style: groove"><a
                        href="../../listProducts/listProducts.html" style="color: black; text-decoration-line: none">Zoznam
                    produktov</a></div>
            <div class="col-md-3" style="text-align: center; background-color: aqua; border-style: groove"><a
                        href="../../about.html" style="color: black; text-decoration-line: none">O nás</a></div>
            <div class="col-md-3" style="text-align: center; background-color: aqua; border-style: groove"><a
                        href="../registracia.php" style="color: black; text-decoration-line: none">Registracia</a></div>
            <div class="col-md-3" style="text-align: center; background-color: aqua; border-style: groove"><a
                        href="prihlasenie_page.php" style="color: black; text-decoration-line: none">Prihlasenie</a></div>
        </div>
    </div>
    <div class="row" id="imgRow" >
        <div class="col-12">
            <img src="../../11096490_1439627412996984_5157600893917446945_o.jpg" alt="uvod" class="img-fluid">
        </div>
    </div>
    <div class="row" id="serverResponseRow">
        <div class="col-12" style="text-align: center" id="serverResponseCol">
            <pre id="theContent"></pre>
        </div>
    </div>
    <div class="row" style="padding: 3px">
        <div class=”col-12" style="text-align: center">
            <h3>Prihlásenie používateľa</h3>
            <div id="prihlasenie_pouzivatela">
                <div>
                    <input type="text" class="textbox" id="username_prihlasenie" name="username_prihlasenie"
                           placeholder="Používateľské meno"/>
                </div>
                <div>
                    <input type="password" class="textbox" id="password_prihlasenie" name="password_prihlasenie"
                           placeholder="Používateľské heslo"/>
                </div>
                <div>
                    <input onclick="sendToServer()" type="button" value="Odoslať" name="potvrdenie_prihlasenia"
                           id="potvrdenie_prihlasenia"/>
                </div>
            </div>
        </div>
    </div>
</div>
</body>