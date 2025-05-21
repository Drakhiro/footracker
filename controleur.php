<?php
session_start();

include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";

$qs = "";
$dataQS = array();

if ($action = valider("action")) {
	ob_start();
	// echo "Action = '$action' <br />";
	// ATTENTION : le codage des caractères peut poser PB si on utilise des actions comportant des accents... 
	// A EVITER si on ne maitrise pas ce type de problématiques

	/* TODO: A REVOIR !!
		// Dans tous les cas, il faut etre logue... 
		// Sauf si on veut se connecter (action == Connexion)
		*/

	if (!($action == "Se connecter" || $action == "Inscription"))
		securiser("login");

	// Un paramètre action a été soumis, on fait le boulot...
	switch ($action) {

		// Connexion //////////////////////////////////////////////////
		case 'Se connecter':
			// On verifie la presence des champs identifiant et mdp
			if ($identifiant = valider("identifiant")) {
				if ($mdp = valider("mdp")) {
					// On verifie l'utilisateur, 
					// et on crée des variables de session si tout est OK
					if (verifUser(addslashes($identifiant), addslashes($mdp))) {
						// tout s'est bien passé, doit-on se souvenir de la personne ? 
						if (valider("remember")) {
							setcookie("identifiant", $identifiant, time() + 60 * 60 * 24 * 30);
							setcookie("remember", true, time() + 60 * 60 * 24 * 30);
						} else {
							setcookie("identifiant", "", time() - 3600);
							setcookie("remember", false, time() - 3600);
						}
					} else $qs = "?view=login&error=" . urlencode("Identifiants invalides !");
				} else $qs = "?view=login&error=" . urlencode("Entrez un mot de passe !");
			} else $qs = "?view=login&error=" . urlencode("Entrez un identifiant !");

			// On redirigera vers la page index automatiquement
			break;

		case 'Logout':
		case 'logout':
			// traitement métier
			session_destroy(); // 1) traitement 
			$qs = "?view=accueil";
			break;

		case 'Inscription':
			function setQsError($text, $pseudo, $mail) {
				$qs = "?view=signup&error=" . $text . "&pseudo=" . $pseudo . "&mail=" . $mail;
				return $qs;
			}

			$pseudo = valider("pseudonyme");
			$mail = valider("mail");

			if ($pseudo) {
				if ($mail) {
					if (strlen($mdp = valider("mdp")) >= 8) {
						if (!existInBdd(addslashes($pseudo), "username")) {
							if (!existInBdd(addslashes($mail), "mail")) {
								createUser(addslashes($pseudo), addslashes($mail), addslashes($mdp));
								$qs = "?view=login&succes=" . urlencode("Compte $pseudo créé avec succès !");
							} else {
								$qs = setQsError(urlencode("Ce mail existe déjà !"), urlencode($pseudo), "");
							}
						} else $qs = setQsError(urlencode("Ce pseudonyme existe déjà !"), "", urlencode($mail));
					} else $qs = setQsError(urlencode("Entrez un mot de passe contenant au moins 8 caractères !"), urlencode($pseudo), urlencode($mail));
				} else $qs = setQsError(urlencode("Entrez un e-mail !"), urlencode($pseudo), urlencode($mail));
			} else $qs = setQsError(urlencode("Entrez un pseudonyme !"), urlencode($pseudo), urlencode($mail));
			break;
	}
}

// On redirige toujours vers la page index, mais on ne connait pas le répertoire de base
// On l'extrait donc du chemin du script courant : $_SERVER["PHP_SELF"]
// Par exemple, si $_SERVER["PHP_SELF"] vaut /chat/data.php, dirname($_SERVER["PHP_SELF"]) contient /chat

$urlBase = dirname($_SERVER["PHP_SELF"]) . "/index.php";
// On redirige vers la page index avec les bons arguments

if ($qs == "") {
	// On renvoie vers la page précédente en se servant de HTTP_REFERER
	// attention : il peut y avoir des champs en + de view...
	$qs = parse_url($_SERVER["HTTP_REFERER"] . "&cle=val", PHP_URL_QUERY);
	$tabQS = explode('&', $qs);
	array_map('parseDataQS', $tabQS);
	$qs = "?view=" . $dataQS["view"];
}

header("Location:" . $urlBase . $qs);

// On écrit seulement après cette entête
ob_end_flush();


function parseDataQS($qs)
{
	global $dataQS;
	$t = explode('=', $qs);
	$dataQS[$t[0]] = $t[1];
}
