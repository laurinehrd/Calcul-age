<?php
function calcul_age(){
  if(isset($_POST['birthdate'])){
    $birthdate=strtotime($_POST['birthdate']);
    $day_birthdate=date('d', $birthdate);
    $month_birthdate=date('m', $birthdate);
    $year_birthdate=date('Y', $birthdate);

    $day_today=date('d');
    $month_today=date('m');
    $year_today=date('Y');

    if($day_birthdate>$day_today && $month_birthdate>=$month_today){
      $age=($year_today-$year_birthdate)-1;
    } else {
      $age=$year_today-$year_birthdate;
    }
  } else {
    echo "<p>Vous n'avez pas renseignez de date.</p>";
  }
  echo "Vous avez ". $age. " ans.";
}
calcul_age();
