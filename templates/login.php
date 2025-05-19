<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location:../index.php?view=login");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

// Chargement eventuel des données en cookies
$identifiant = valider("identifiant", "COOKIE");
if ($checked = valider("remember", "COOKIE")) $checked = "checked"; 
?>

<div class="flex flex-col gap-8 items-center justify-center h-[80vh]">
	<h1 class="text-5xl font-bold">Se connecter</h1>
	<h2 class="text-xl text-custom-grey">Bon retour parmis nous !</h2>

	<form action="controleur.php" class="flex flex-col items-center justify-center gap-4">

		<label for="identifiant" class="flex flex-col gap-1">
			<p>Identifiant</p>
			<div class="group flex flex-row items-center gap-4 bg-custom-black p-2 border-solid border-custom-grey border-[2px] rounded-[8px] focus-within:border-custom-primary focus-within:text-custom-primary">
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

		<label for="mdp" class="flex flex-col gap-1 mt-8">
			<p>Mot de passe</p>
			<div class="group flex flex-row items-center gap-4 bg-custom-black p-2 border-solid border-custom-grey border-[2px] rounded-[8px] focus-within:border-custom-primary focus-within:text-custom-primary">
				<ion-icon name="lock-closed-outline"></ion-icon>
				<input 
					type="password" 
					name="mdp" 
					id="mdp" 
					class="appearance-none bg-transparent border-none outline-none shadow-none ring-0 focus:ring-0 focus:outline-none min-h-[32px]"
				>
				<ion-icon name="eye-off-outline"></ion-icon>
			</div>
		</label>

		<label for="remember" class="flex flex-row">
			<p>Se souvenir de moi</p>
			<input type="checkbox" name="remember" id="remember" value="ok" <?php echo $checked;?> >
		</label>

		<input type="submit" name="action" value="Se connecter" class="flex flex-row items-center justify-center text-custom-black font-bold text-base bg-custom-primary hover:bg-custom-primary-hover duration-400 cursor-pointer rounded-[8px] min-w-[128px] min-h-[44px]">

	</form>
</div>
