<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boggle</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Oswald:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="plateau" id="plateau"></div>
    </div>
<script>
    var grille='';
    var plateau=document.getElementById('plateau');

    createGrille();

    var xmlhttp = new XMLHttpRequest();
    var url = "RollDices.php";
    xmlhttp.open("GET", url, true);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.readyState == 4 && this.status == 200) {
                out=JSON.parse(this.responseText);
                console.log(out);
                 remplirGrille(out);
            }
        }
    };   
    xmlhttp.send();




    /*  function */
    function remplirGrille(arrData){
            for (let i = 0; i < arrData.length; i++) {
            document.getElementById(`pos${i}`).innerHTML=`<div class="dice">${arrData[i]}</div>`;            
            }
    }
    function createGrille(){
        grille="<table>"
        for (let i = 0; i <=12 ; i+=4) {
            grille+=`<tr>`;
            for (let j = 0; j < 4; j++) {
                grille+="<td id='pos"+(j+i)+"'></td>";
            }
            grille+=`</tr>`;
        }
        grille+="</table>";
        plateau.innerHTML=grille;
    }
    
</script>
</body>
</html>
