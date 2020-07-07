<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>

    <div class="">
      Renseignez votre date de naissance :
    </div>

    <form class="" action="traitement2.php" method="post">
      <input type="text" name="birthdate_day" placeholder="jour">
      <input type="text" name="birthdate_month" placeholder="mois">
      <input type="text" name="birthdate_year" placeholder="année">
      <input type="submit" name="" value="Envoyer">
    </form>


    <?php
    if(isset($_POST['birthdate'])) {
      $birthdate=$_POST['birthdate'];
      $year=date('Y');
      $age=$year-$birthdate;
      echo  '<p>Vous avez '. $age. ' ans.</p>';
    } else {
      echo "Vous n'avez pas renseignez de date";
    }

    ?>


  </body>

</html>
