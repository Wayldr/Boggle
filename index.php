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
    <!-- <header>
        <div class="container">
            <h1>Boggle</h1>
        </div>
    </header> -->
    <div class="container">
        <main>        
            <h1>Boggle</h1> 
            <div class="section1">                    
                <div class="playGround" id="playGround">
                    <div class="start btn" id="play">Start</div>
                    <div class="plateau" id="plateau"></div>
                </div>
            </div>
            <div class="section2">
                <aside>
                    <div class="timer" id="timer">
                        <div class="time" id="time">- : - -</div>
                        <div class="controlTimer">
                            <div class="PLayResume">
                                <div class="resume btn-2" id="resume">Resume</div>
                                <div class="playtimer btn-2" id="playtimer">Play</div>
                            </div>                
                            <div class="resetTimer btn-2" id="resetTimer">Reset</div>
                        </div>
                    </div>
                    <div class="gameControl">
                        <div class="newGame btn-2" id="newGame">
                            Nouvelle Partie
                        </div>
                        <div class="rules" title="règles complètes">     
                            <h2>Règles :</h2>
                            <h3>But du jeu :</h3>
                            <p>Vous avez 3 minutes pour trouver le maximum de mots d'au moins trois lettres.</p>
                            <p>Pour tracer un mot, vous pouvez passer d'une lettre à la suivante si elles sont adjacentes (diagonales comprises).</p>
                            <p>Une lettre ne peut pas être utilisée plus d'une fois pour un même mot.</p>
                            <h3>Comptage des points :</h3>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Taille du mot</th>
                                        <th>Nombre de points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th >3 ou 4</th>
                                        <td>1 point</td>
                                    </tr>
                                    <tr>
                                        <th >5</th>
                                        <td>2 points</td>
                                    </tr>
                                    <tr>
                                        <th >6</th>
                                        <td>3 points</td>
                                    </tr>
                                    <tr>
                                        <th >7</th>
                                        <td>5 points</td>
                                    </tr>
                                    <tr>
                                        <th >8 ou plus</th>
                                        <td>11 points</td>
                                    </tr>
                                </tbody>
                            </table>                       
                        </div>
                    </div>
                </aside>
            </div>
        </main>
    </div>
    <footer>
        <div class="container"></div>
    </footer>
</body>
<script>
    /* Timer */
    
    var secondsRemaining;
    var intervalHandle;

    var btnResume=document.getElementById("resume");    
    var btnStart=document.getElementById("play");
    var btnResetTimer=document.getElementById("resetTimer");
    var btnPlaytimer=document.getElementById("playtimer");
    var btnNewGame=document.getElementById("newGame");


    btnStart.addEventListener('mouseup',()=>{
        startCountdown(179);
        play();
        btnStart.style.display='none';
        btnResume.style.display='block';
        btnResetTimer.style.display='block';
        });
    btnResume.addEventListener('mouseup',()=>{
        resumeCountdown();
        btnResume.style.display='none';
        btnPlaytimer.style.display='block';        
    });
    btnPlaytimer.addEventListener('mouseup',()=>{
        startCountdown(secondsRemaining-1);
        btnResume.style.display='block';
        btnPlaytimer.style.display='none';        
    });
    btnResetTimer.addEventListener('mouseup',()=>{
        resumeCountdown();
        document.getElementById("time").innerHTML = "3:00";
        secondsRemaining=180;
        btnResume.style.display='none';
        btnPlaytimer.style.display='block';        
    });
    btnNewGame.addEventListener('mouseup',()=>{
        resumeCountdown();
        document.getElementById("time").innerHTML = "- : - -";
        btnStart.style.display='block';
        btnResume.style.display='none';
        btnPlaytimer.style.display='none';
        btnResetTimer.style.display='none';
        plateau.innerHTML='';
        });
    function tick(){
        var timeDisplay = document.getElementById("time");
        var min = Math.floor(secondsRemaining / 60);
        var sec = secondsRemaining - (min * 60);
        if (sec < 10) {
            sec = "0" + sec;
        }
        var message = min.toString() + ":" + sec;        
        timeDisplay.innerHTML = message;
        if (secondsRemaining == 0){
            clearInterval(intervalHandle);
        }
        secondsRemaining--;
    }
    function initiatCountdown(seconds){
        secondsRemaining=seconds;
    }
    function startCountdown(time){
        initiatCountdown(time);
        intervalHandle = setInterval(tick, 1000);
    }
    function resumeCountdown(){
        clearInterval(intervalHandle);
    }
  
    /* end of Timer */



    var grille='';
    var plateau=document.getElementById('plateau');
    var isGaming=false;

    function play(){
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
    }
    
    function remplirGrille(arrData){
            for (let i = 0; i < arrData.length; i++) {
            document.getElementById(`pos${i}`).innerHTML=`<div class="dice">${arrData[i]}</div>`;            
            }
    }
    function createGrille(){
        grille="<table><tbody>"
        for (let i = 0; i <=12 ; i+=4) {
            grille+=`<tr>`;
            for (let j = 0; j < 4; j++) {
                grille+="<td id='pos"+(j+i)+"'></td>";
            }
            grille+=`</tr>`;
        }
        grille+="</tbody></table>";
        plateau.innerHTML=grille;
    }    
</script>
</html>
