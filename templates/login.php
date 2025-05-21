<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location:../index.php?view=login");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

if (valider("connected", "SESSION")) {
	include("templates/accueil.php"); 
} else {
	// Chargement eventuel des données en cookies
	$identifiant = valider("identifiant", "COOKIE");
	if ($checked = valider("remember", "COOKIE")) $checked = "checked";
?>

<div class="flex flex-col gap-8 items-center justify-center h-[80vh]">
	<?php 
        if ($error = valider("error")) {
            mkInfoMsg($error, "red");
        }
		if ($succes = valider("succes")) {
			mkInfoMsg($succes, "green");
		}
    ?>
	<h1 class="text-5xl font-bold">Se connecter</h1>
	<h2 class="text-xl text-custom-grey">Bon retour parmis nous !</h2>

	<form action="controleur.php" class="flex flex-col items-center justify-center gap-4">

		<label for="identifiant" class="group flex flex-col gap-1 focus-within:text-custom-primary">
			<p>Identifiant</p>
			<div class="flex flex-row items-center px-4 py-2 gap-4 bg-custom-black border-solid border-custom-grey border-[2px] rounded-[8px] group-focus-within:border-custom-primary">
				<ion-icon name="person-outline"></ion-icon>
				<input 
					type="text" 
					name="identifiant" 
					id="identifiant" 
					value=<?php echo $identifiant;?> 
					class="appearance-none bg-transparent border-none outline-none shadow-none ring-0 focus:ring-0 focus:outline-none min-h-[32px]"
					placeholder="E-mail ou pseudonyme"
				>
			</div>
		</label>

		<label for="mdp" class="group flex flex-col gap-1 mt-6 focus-within:text-custom-primary">
			<p>Mot de passe</p>
			<div class="flex flex-row items-center px-4 py-2 gap-4 bg-custom-black border-solid border-custom-grey border-[2px] rounded-[8px] group-focus-within:border-custom-primary">
				<ion-icon name="lock-closed-outline"></ion-icon>
				<input 
					type="password" 
					name="mdp" 
					id="mdp" 
					class="appearance-none bg-transparent border-none outline-none shadow-none ring-0 focus:ring-0 focus:outline-none min-h-[32px]"
				>
				<ion-icon name="eye-off-outline" class="cursor-pointer"></ion-icon>
			</div>
		</label>

		<label for="remember" class="flex flex-row gap-4">
			<p>Se souvenir de moi</p>
			<input type="checkbox" name="remember" id="remember" value="ok" <?php echo $checked;?> >
		</label>

		<input type="submit" name="action" value="Se connecter" class="flex flex-row items-center justify-center text-custom-black font-bold text-base bg-custom-primary hover:bg-custom-primary-hover duration-400 cursor-pointer rounded-[8px] min-w-[128px] min-h-[44px]">

	</form>
</div>

<?php } ?>
