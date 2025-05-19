<?php

// Si la page est appelée directement par son adresse, on redirige en passant pas la page index
if (basename($_SERVER["PHP_SELF"]) != "index.php") {
  header("Location:../index.php");
  die("");
}

// Pose qq soucis avec certains serveurs...
echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- **** H E A D **** -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Footracker</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


  <!-- Définir les couleurs personnalisées avec @layer -->
  <style type="text/tailwindcss">
    @import url('https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;600;700&display=swap');
    @layer base {
      :root {
        --color-primary: #EBBC56;
        --color-black: #1E1E1E; 
        --color-light-black: #333130;
        --color-white: #FFFFFF;
        --color-grey: #DBCDCD;
      }
      .font-hind {
        font-family: "Hind Madurai", sans-serif;
      }
    }

    @layer utilities {
      .bg-black {
        background-color: var(--color-black);
      }
      .bg-light-black {
        background-color: var(--color-light-black);
      }
      .bg-primary {
      background-color: var(--color-primary);
      }
      .text-white {
        color: var(--color-white);
      }
      .text-grey {
        color: var(--color-grey);
      }
    }
  </style>

</head>
<!-- **** F I N **** H E A D **** -->


<!-- **** B O D Y **** -->

<body class="bg-black text-white font-hind">
  <div id="banniere">

    <a href="index.php?view=accueil">Accueil</a>

    <?php
    if (!valider("connected", "SESSION")) {
      echo "<a href=\"index.php?view=login\">Se connecter</a>";
    } else {
      echo "<a href=\"index.php?view=map\">Carte</a>";
    }
    //TODO: Si l'utilisateur n'est pas connecte, on affiche un lien de connexion 

    ?>

  </div>
