/* init */
    /* section-1 : plateau de jeu*/
var grille='';
var plateau=document.getElementById('plateau');
var isGaming=false;
var secondsRemaining;
var intervalHandle;
var previousLetter=false;
var arrPreviousletters=Array();
//tableau lettre bonne  = toute les lettre
var good=[];
for (let index = 0; index < 16; index++) {
    good.push(index); 
}
var arrPreviousletters=Array();
var inputWord=document.getElementById("inputWord");
var btnValider=document.getElementById("btnValider");

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
    /*section-3 : écran fin*/
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
btnValider.addEventListener('mouseup',()=>{
    //formater input word en full majuscule ou minuscule
    wordHistoric.innerHTML+=inputWord.innerHTML+"<br>";
    inputWord.innerHTML='';
    previousLetter=false;
    arrPreviousletters=Array();
    good=[];
    for (let index = 0; index < 16; index++) {
        good.push(index); 
    }
    refreshStyle();
})
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
                createListener();
            }
        }

    };   
    xmlhttp.send();
}
function remplirGrille(arrData){
        for (let i = 0; i < arrData.length; i++) {
        document.getElementById(`${i}`).innerHTML=arrData[i];            
        }
}
function createGrille(){
    grille="<table><tbody>"
    for (let i = 0; i <=12 ; i+=4) {
        grille+=`<tr>`;
        for (let j = 0; j < 4; j++) {
            grille+="<td class='dice' id='"+(j+i)+"'></td>";
        }
        grille+=`</tr>`;
    }
    grille+="</tbody></table>";
    plateau.innerHTML=grille;
}    
function createListener() {
    var listedice=document.querySelectorAll('.plateau td');
    listedice=Array.from(listedice);
    listedice.forEach(element => {
        element.addEventListener('click',clickOnDice);
    })
}
function clickOnDice(event) {
    el=event.target
    id=parseInt(el.id);
    stat=false;
    // j'ai un tableau good qui contien tout les dès valide
    // si pas de mot en cours
    if (!previousLetter){
        stat=true;
        //valide lettre
    } else if (good.indexOf(id)>-1){
        stat=true; 
    }
        
    if (stat){
        arrPreviousletters.push(id);//ajoute au tableau mot en cours
        previousLetter=id;
        inputWord.innerHTML+=el.innerHTML;//add au mot courant
        //redéfini le tableau good
        var arr = [-1,-3,-4,-5,1,3,4,5];
        
        var toDelet=[];
        switch (previousLetter) {
            case 0:
            case 4: 
            case 8: 
            case 12:
                arr = [-3,-4,1,4,5];
                break;
            case 3: 
            case 7: 
            case 11:
            case 15:
                arr = [-1,-4,-5,3,4];
                break;
        }
        good = [];
        let scope = 15;
        arr.forEach(element => {
            i = previousLetter+element;
            if (i >= 0 && i <= scope && arrPreviousletters.indexOf(i)==-1){
                good.push(i);
            }           
        });   
        renduVisuel(good,arrPreviousletters);
    }
}
/* function deletValueFromArray(arrToDelet,from){
    arrToDelet.forEach(element => {
       idToDelet=from.indexOf(element);
       from.splice(idToDelet,idToDelet+1)
    });
} */

/* function clickOnDice(event) {
    el=event.target
    id=parseInt(el.id);
    stat=false; // indique si je peux cliquer dessus
    if (previousLetter) {
        let arr = [1,4,5,3];
        let good = [];
        let scope = 15;
        arr.forEach(element => {
            if (arrPreviousletters.indexOf(id)==-1){
                i = previousLetter+element;
                if (i >= 0 && i <= scope) good.push(i);
                i = previousLetter-element;
                if (i >= 0 && i <= scope) good.push(i);
            }
        });
        if (good.indexOf(id)>-1){
            stat=true;
        }        
    } else {
        stat=true;
    }
    if (stat){
        arrPreviousletters.push(id);
        previousLetter=id;
        inputWord.innerHTML+=el.innerHTML;//add au mot courant
    }
} */
function refreshStyle(){
    for (let index = 0; index < 16 ; index++) {
        el=document.getElementById(index);
        el.style.border='';
        el.style.boxShadow='';  
        el.style.color='black';
    }
}
function renduVisuel(good,current){
    refreshStyle();
    // pour chaque bonne lettre
        // style -> border vert brillant
    good.forEach(element => {
        document.getElementById(element).style.boxShadow='inset 0 0 30px green';
    });
    //pour chaque lettre deja cliké
    current.forEach(element => {
        document.getElementById(element).style.border='4px solid green';
        document.getElementById(element).style.color='green';
        // style -> border vert ou orange
    });
        
    // si pas de mot en cours OU Valide le mots
        // style -> border       
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