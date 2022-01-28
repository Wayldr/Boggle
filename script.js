/* init */
/* section-1 : plateau de jeu*/
var grille='';
var plateau=document.getElementById('plateau');
var isGaming=false;
var secondsRemaining;
var intervalHandle;
/*    var inputWord=document.getElementById("inputWord");
var btnValider=document.getElementById("btnValider");
var wordHistoric=document.getElementById('wordHistoric');
var typingWord; */
    /* section-2 : timer/controlleur */
var btnResume=document.getElementById("resume");    
var btnStart=document.getElementById("play");
var btnResetTimer=document.getElementById("resetTimer");
var btnPlaytimer=document.getElementById("playtimer");
var btnNewGame=document.getElementById("newGame");
    /*écran fin*/
var ecranTempsEcoule=document.getElementById("tempsEcoule");
var container=document.getElementById("container");
var btnContinuer=document.getElementById("continuer");



/* Event */
btnStart.addEventListener('mouseup',()=>{
    startCountdown(179);
    play();
    btnStart.style.display='none';
    btnResume.style.display='block';
    btnResetTimer.style.display='block';
});
/* inputWord.addEventListener('input',()=>{
    typingWord=inputWord.value;
});
btnValider.addEventListener('mouseup',()=>{
    wordHistoric.innerHTML+=typingWord+"<br>";
    inputWord.value='';
}); */

btnNewGame.addEventListener('mouseup',()=>{
    resumeCountdown();
    document.getElementById("time").innerHTML = "- : - -";
    btnStart.style.display='block';
    btnResume.style.display='none';
    btnPlaytimer.style.display='none';
    btnResetTimer.style.display='none';
    plateau.innerHTML='';
});
btnContinuer.addEventListener('mouseup',()=>{
    ecranTempsEcoule.style.display='none';
    container.style.display='flex';
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

/* Fonction */
function play(){
    document.getElementById("time").innerHTML = "3:00";
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
        ecranTempsEcoule.style.display='flex';
        container.style.display='none';
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