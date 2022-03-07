<?php
require_once 'connect.php';

$mot=strtolower($_GET['mot']);

/* $mot='mot' */;

$requeteSelectMot="SELECT id FROM dictionnaire_francais WHERE mots='$mot'"; 
$resultat=$bdd->querySingle($requeteSelectMot);

/* print_r($resultat);
 */
if ($resultat){
    echo 1;
}

$bdd->close();


/* $mot='mot';
$requeteSelectMot="SELECT mots FROM dictionnaire_francais WHERE mots=:mot"; 
$requeteSelectMot=$bdd->prepare($requeteSelectMot);
$requeteSelectMot->bindValue(':mot', $mot);
$resultat=$requeteSelectMot->execute();
$resultat->fetchArray();
var_dump($resultat);

$bdd->close(); */


/* 
$statement = $db->prepare('SELECT * FROM table WHERE mots = :mot;');
$statement->bindValue(':mot', $mot);

$result = $statement->execute();
 */

?>