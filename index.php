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
    <div class="tempsEcoule" id="tempsEcoule">
        <h2>Temps écoulé</h2>
        <div class="btn-continuer" id="continuer">Continuer</div>
    </div>
    <div class="container" id='container'>
        <main>        
            <h1>Boggle</h1> 
            <div class="section1">                    
                <div class="playGround" id="playGround">
                    <div class="start btn" id="play">Start</div>
                    <div class="plateau" id="plateau"></div>
                    <div class="zoneMot">
                        <div class="zoneInputWord">
                            <span id="inputWord"></span>
                            <div class="btnValider" id="btnValider">Valider</div>
                        </div>
                        <div class="wordHistoric" id="wordHistoric"></div>
                    </div>
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
    <script src="script.js"></script>
</body>
</html>