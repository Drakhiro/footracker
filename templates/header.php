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
  <!-- Importation de IonIcons via CDN -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <!-- Importation de Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Configuration de Tailwind -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'custom-primary': '#EBBC56',
            'custom-primary-hover': '#CD9F3B',
            'custom-black': '#1E1E1E',
            'custom-light-black': '#333130',
            'custom-white': '#FFFFFF',
            'custom-grey': '#DBCDCD',
          },
          fontFamily: {
            'hind': ['"Hind Madurai"', 'sans-serif'],
          },
        }
      }
    }
  </script>

  <!-- Police Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>



<body class="bg-custom-light-black text-custom-white font-hind m-0">
  <header class="h-[10vh] bg-custom-black flex flex-row items-center justify-between px-[24px]">
    
    <!-- LOGO -->
    <a href="index.php?view=accueil">
    <div class="flex flex-row items-center justify-center gap-[16px]">
      <div class="bg-custom-primary rounded-[8px] max-w-[44px] max-h-[44px]">
        <img src="ressources/logo_footracker_nobg.png" alt="Logo de footracker">
      </div>
      <h1 class="font-bold text-3xl">FOOTRACKER</h1>
    </div>
    </a>


    <!-- Navigation -->
    <div class="flex flex-row items-center justify-center gap-[48px]">

     <?php
      $isConnected = valider("connected", "SESSION");
      $listeLiens = array();
      if ($isConnected) {
        $listeLiens[] = array("url" => "favoris", "label" => "Favoris");
      }
      $listeLiens[] = array("url" => "clubs", "label" => "Clubs");
      $listeLiens[] = array("url" => "map", "label" => "Carte");
      $listeLiens[] = array("url" => "scores", "label" => "Scores");

      foreach ($listeLiens as $lien) {
        if (valider("view") == $lien["url"]) {
          echo "<a href=\"index.php?view=" . $lien["url"] . "\" class=\"font-bold text-custom-primary\">" . $lien["label"] . "</a>";
        } else {
          echo "<a href=\"index.php?view=" . $lien["url"] . "\" class=\"font-bold\">" . $lien["label"] . "</a>";
        }
      }

      if (!$isConnected) {
     ?>

      <a href="index.php?view=login">
        <div class="flex flex-row items-center justify-center bg-custom-black hover:bg-custom-white hover:text-custom-black duration-400 cursor-pointer rounded-[8px] w-[128px] h-[44px] border-solid border-custom-white border-2">
          <h2 class="font-bold text-base">Connexion</h2>
        </div>
      </a>

      <a href="index.php?view=signup">
        <div class="flex flex-row items-center justify-center text-custom-black bg-custom-primary hover:bg-custom-primary-hover duration-400 cursor-pointer rounded-[8px] w-[128px] h-[44px]">
          <h2 class="font-bold text-base">Inscription</h2>
        </div>
      </a>

      <?php
        } else {
      ?>

      <div class="flex flex-row items-center justify-center bg-custom-primary hover:bg-custom-primary-hover duration-400 cursor-pointer rounded-[8px] w-[44px] h-[44px]">
        <ion-icon name="add-sharp" class="text-custom-black text-[32px]"></ion-icon>
      </div>

      <div class="flex flex-row items-center justify-center bg-custom-primary hover:bg-custom-primary-hover duration-400 cursor-pointer rounded-[8px] w-[44px] h-[44px]">
        <ion-icon name="person-sharp" class="text-custom-black text-[24px]"></ion-icon>
      </div>

      <?php
        }
      ?>

    </div>
    

  </header>
