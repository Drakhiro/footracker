<?php

/*
Dans ce fichier, on définit diverses fonctions permettant de récupérer des données utiles pour notre TP d'identification. Deux parties sont à compléter, en suivant les indications données dans le support de TP
*/



// inclure ici la librairie faciliant les requêtes SQL
include_once("maLibSQL.pdo.php");


function verifUserBdd($identifiant,$password)
{
	// Vérifie l'identité d'un utilisateur 
	// dont les identifiants sont passes en paramètre
	// renvoie faux si user inconnu
	// renvoie l'id de l'utilisateur si succès

	$SQL="SELECT `id` FROM users WHERE (`username`='$identifiant' OR `mail`='$identifiant') AND `password`='$password'";

	return SQLGetChamp($SQL);
}

function existInBdd($value, $attribut) {
	$SQL="SELECT `id` FROM `users` WHERE `$attribut`='$value'; ";
	// echo $SQL; die();
	return SQLGetChamp($SQL);
}

function createUser($username, $mail, $mdp) {
	$SQL="INSERT INTO `users` (`mail`, `username`, `password`) VALUES ('$mail', '$username', '$mdp');";
	return SQLInsert($SQL);
}

function isAdmin($idUser)
{
	// vérifie si l'utilisateur est un administrateur
	$SQL ="SELECT admin FROM users WHERE id='$idUser'";
	return SQLGetChamp($SQL); 
}




?>
