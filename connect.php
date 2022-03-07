<?php
/* try
{
    $bdd = new PDO('mariadb:host=localhost;dbname=dictionnaire;charset=utf8', 'dico', 'JeSuisUnMotDePasse', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
} */



/* $bdd = new mysqli("localhost", "dico", "JeSuisUnMotDePasse", "dictionnaire");
if ($bdd->connect_errno) {
    echo "Échec lors de la connexion à MySQL : (" . $bdd->connect_errno . ") " . $bdd->connect_error;
}
echo $bdd->host_info . "\n";
 */


$bdd= new SQLite3('dictionnaire_francais.db',SQLITE3_OPEN_READONLY);
?>
