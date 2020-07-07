<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Calcul âge</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>

    <div class="">
      Renseignez votre date de naissance :
    </div>

    <form class="" action="traitement2.php" method="post">
      <input type="date" name="birthdate" value="<?php echo date('d-m-Y'); ?>">
      <input type="submit" name="" value="Envoyer">
    </form>

  </body>
</html>
