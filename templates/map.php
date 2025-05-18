<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) == "conversations.php") {
    header("Location:../index.php?view=conversations");
    die("");
}

include_once("libs/modele.php"); // listes
include_once("libs/maLibUtils.php"); // tprint
include_once("libs/maLibForms.php"); // mkTable, mkLiens, mkSelect ...

// Les utilisateurs non connectés ne devraient pas avoir accès à cette vue ! 

// SI (user non connecte) 
// On déclenche une redirection vers la page de connexion avec un message 

if (! valider("connected", "SESSION")) {
    // header("Location:?view=login&msg=" . urlencode("Il faut être connecté !"));
    // une redirection utilise les entetes HTTP de réponse 
    // Les entetes de réponse doivent être envoyées AVANT le corps de la réponse
    // Une erreur "headers already sent" s'affiche sur certains serveurs 
    // cf. directive output_buffering du fichier php.ini => en TNE 

    // utiliser la fonction header n'interrompt pas l'interprétation de la page
    // => risque de fuite de données 
    // => On interrompt la page immédiatement 
    // die("");

    // alternative :  
    $_REQUEST["msg"] = "Il faut être connecté !";
    include("templates/login.php");
} else {

?>

<h1>Carte</h1>

<?php
} // FIN si user connecte 
?>
