<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
	header("Location:../index.php?view=signup");
	die("");
}

include_once("libs/modele.php");
include_once("libs/maLibUtils.php");
include_once("libs/maLibForms.php");

if (valider("connected", "SESSION")) {
	include("templates/accueil.php"); 
} else {

?>

<div class="flex flex-col gap-8 items-center justify-center h-[80vh]">
    <?php 
        if ($error = valider("error")) {
            mkInfoMsg($error, "red");
        }
    ?>
	<h1 class="text-5xl font-bold">S'inscrire</h1>
	<h2 class="text-xl text-custom-grey">Bienvenue sur Footracker !</h2>

	<form action="controleur.php" class="flex flex-col items-center justify-center gap-4">

		<label for="pseudonyme" class="group flex flex-col gap-1 focus-within:text-custom-primary">
			<p>Pseudonyme</p>
			<div class="flex flex-row items-center px-4 py-2 gap-4 bg-custom-black border-solid border-custom-grey border-[2px] rounded-[8px] group-focus-within:border-custom-primary">
				<ion-icon name="person-outline"></ion-icon>
				<input 
					type="text" 
					name="pseudonyme"
                    <?php if ($pseudo = valider("pseudo")) echo "value=\"" . $pseudo . "\""; ?>
					id="pseudonyme"
					class="appearance-none bg-transparent border-none outline-none shadow-none ring-0 focus:ring-0 focus:outline-none min-h-[32px]"
					placeholder="Pseudonyme"
				>
			</div>
		</label>

		<label for="mail" class="group flex flex-col gap-1 focus-within:text-custom-primary">
			<p>E-mail</p>
			<div class="flex flex-row items-center px-4 py-2 gap-4 bg-custom-black border-solid border-custom-grey border-[2px] rounded-[8px] group-focus-within:border-custom-primary">
				<ion-icon name="mail-outline"></ion-icon>
				<input 
					type="text"
					name="mail"
                    <?php if ($mail = valider("mail")) echo "value=\"" . $mail . "\""; ?>
					id="mail" 
					class="appearance-none bg-transparent border-none outline-none shadow-none ring-0 focus:ring-0 focus:outline-none min-h-[32px]"
					placeholder="example@gmail.com"
				>
			</div>
		</label>

		<label for="mdp" class="group flex flex-col gap-1 focus-within:text-custom-primary">
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

		<input type="submit" name="action" value="Inscription" class="flex flex-row items-center justify-center text-custom-black font-bold text-base bg-custom-primary hover:bg-custom-primary-hover duration-400 cursor-pointer rounded-[8px] min-w-[128px] min-h-[44px]">

	</form>
</div>

<?php } ?>
