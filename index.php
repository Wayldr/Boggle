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
    <header>
        <div class="container">
            <h1>Boggle</h1>
        </div>
    </header>
    <div class="container">
        <main>        
            <div class="playGround" id="playGround">
                <div class="start btn" id="play">Start</div>
                <div class="plateau" id="plateau"></div>
            </div>
            <aside>
                <div class="timer" id="timer">
                    <div class="time" id="time">3:00</div>
                    <div class="PLayResume">
                        <div class="resume btn" id="resume">Resume</div>
                        <div class="playtimer btn" id="playtimer">Play</div>
                    </div>                
                    <div class="resetTimer btn" id="resetTimer">Reset</div>
                </div>
                <div class="newGame" id="newGame">
                </div>
                <div class="rules">          
                </div>
            </aside>
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

    btnStart.addEventListener('mouseup',()=>{
        startCountdown();
        play();
        btnStart.style.display='none';
        btnResume.style.display='block';
        btnResetTimer.style.display='block';
        });
    btnResume.addEventListener('click',()=>{
        resumeCountdown();
        btnResume.style.display='none';
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
    function startCountdown(){
        initiatCountdown(180);
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
        xmlhttp.send();
        return isGaming=true
    }
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
