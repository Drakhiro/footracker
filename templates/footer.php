<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php")
{
	header("Location:../index.php");
	die("");
}

?>

<div id="pied">

<?php
//TODO:  Si l'utilisateur est connecte, on affiche un lien de deconnexion 
// $curl = curl_init();

// curl_setopt_array($curl, [
//     CURLOPT_URL => "https://api.football-data.org/v4/competitions/FL1/matches", // FL1 = Ligue 1
//     // CURLOPT_URL => "https://api.football-data.org/v4/competitions/CL/standings", // FL1 = Ligue 1
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_HTTPHEADER => [
//         "X-Auth-Token: 96532e3c36b34947b91e86d8a334d869"
//     ],
// ]);

// $response = curl_exec($curl);
// curl_close($curl);

// echo $response;
tprint($_SESSION);
if (valider("connected")) {
	echo "<a href=\"controleur.php?action=Logout\">Se Déconnecter</a>";
}
?>
</div>

</body>
</html>
