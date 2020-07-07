# Calculer l'âge en php

L'objectif de cet exercice est de développer en php une petite application qui calcule l'âge actuel de l'utilisateur en fonction de sa date de naissance.


## Le formulaire en html

On commence par générer une balise ``` <form> ``` et on renseigne le paramètre ``` method="post" ``` de façon à faire passer l'information renseignée, et on redirige vers une page de traitement en php avec le paramètre ``` action="" ```. Dans ce formulaire, on place deux ``` input ```, l'un de type ``` text ```, l'autre de type ``` submit ```. On donne une value à ce dernier.


```
<form class="" action="traitement.php" method="post">
  <input type="text" name="" value="">
  <input type="submit" name="" value="Envoyer">
</form>
```

## La logique en php

Notre application va simplement opérer un calcul arithmétique : on va soustraire l'année de naissance de l'utilisateur à la date de l'année courante. Pour ce faire, on ouvre une balise ``` <?php ``` dans laquelle on déclare une variable « birthdate » en faisant précéder son nom du signe « $ », puis on lui affecte dans un premier temps une valeur de type number : la date de naissance du programme. On déclare une seconde variable ``` $year ``` à laquelle on affecte aussi une valeur de type number : l'année en cours. On déclare une 3ème variable ``` $age ```, on lui affecte la variable ``` $year ``` suivant de l'opérateur arithmétique « - » puis de la variable ``` $birthdate```. Enfin, on ferme la balise PHP.

```
<?php
$birthdate=1997;
$year=2020;
$age=$year-$birthdate;
echo $age;
 ?>
```

## La récupération dynamique des informations

Dans la première partie nous avions attribué la méthode ```post``` à la div ```<form>```, nous allons maintenant récupérer l'information entrée par l'utilisateur dans la page qui fait le traitement en PHP.

Pour se faire, nous allons utiliser la variable superglobale```$_POST```.
Une superglobale signifie simplement que cette variable est disponible dans tous les contextes du script.

```
$birthdate=$_POST['birthdate'];
```

Maintenant, nous allons demander à PHP de récupérer l'année en cours. Pour cela, nous allons utiliser la fonction ```date()``` à laquelle nous passons en paramètre (cad mettre la fonction en parenthèse) la chaine de caractères ``` "Y" ```.

## Vérification du champs de formulaire

On va maintenant vérifier que la variable superglobale ```$_POST``` est paramétrée en utilisant une condition if à laquelle on passe en paramètre la fonction ```isset``` :

```
if(isset($_POST['birthdate'])) {
  $birthdate=$_POST['birthdate'];
  $year=date('Y');
  $age=$year-$birthdate;
  echo  '<p>Vous avez '. $age. ' ans.</p>';
}
```

## Calcul de l'âge exact (jour, mois, année)
### Modification du HTML

Dans index.php, on va changer le type ```text``` de l'input qui sert à récupérer la date de naissance de l'utilisateur en type ```date```.   
On va ensuite attribuer une value en PHP qui va servir à paramétrer le format de la date :
```
<input type="date" name="birthdate" value="<?php echo date('d-m-Y'); ?>">
```

### Le traitement

On va créer une nouvelle fonction qu'on appelle « calcul_age() » :
```
function calcul_age(){ }
```
Dans cette fonction, la première chose qu'on vérifie, c'est la présence d'une valeur dans la superglobale ``` $_POST ```. Pour ce faire, on passe en paramètre la fonction ``` isset() ``` qui prend elle même ``` $_POST ``` + le name de l'input en paramètre.
La fonction ``` isset ``` sert à vérifier si une variable est considérée définie, ceci signifie qu'elle est déclarée et est différente de NULL. S'il n'y a rien dans le ```$_POST```, on fait apparaitre un message d'erreur.
```
if(isset($_POST['birthdate'])){

  // on va taper notre code ici
  } else {
    echo "<p>Vous n'avez pas renseignez de date.</p>";
  }
```

Maintenant, on va convertir le contenu de la variable superglobale ```$_POST``` qui est au format chaine de caractère en une valeur au format timestamp.
Le timestamp désigne le nombre de secondes écoulées depuis le 1er janvier 1970 à minuit UTC précise.
Pour ce faire, on redéfinit le contenu de la variable $birthdate en utilisant la fonction ```strtotime()``` en laquelle on passe en paramètre ``` $_POST ``` :
```
$birthdate=strtotime($_POST['birthdate']);
```

L'objectif, c'est de comparer le jour, le mois et l'année de naissance, au jour, au mois et à l'année courante. Pour ce faire, on déclare 3 nouvelles variables : ```$day_birthdate, $month_birthdate, $year_birthdate ```, auxquelles on va affecter la fonction ```date()``` à laquelle on passe en paramètre le format du jour, le format du mois, et le format de l'année suivi de la variable qui contient la date au format timestramp :
```
$day_birthdate=date('d', $birthdate);
$month_birthdate=date('m', $birthdate);
$year_birthdate=date('Y', $birthdate);
```
De la même façon, on va déclarer 3 variables qui vont contenir la fonction date avec en paramètre les options de jour, mois et année :
```
$day_today=date('d');
$month_today=date('m');
$year_today=date('Y');
```
Il nous reste maintenant à faire le traitement. On va créer une condition qui va comparer le jour de naissance et le mois de naissance au jour et mois courant. Si le jour et le mois de naissance sont respectivement supérieur ou égal au jour et au mois courant, alors on déclare une variable ```$age``` qui contient la soustraction de l'année de naissance à l'année actuelle -1. Sinon, la même variable ```$age``` contient seulement la soustraction à l'année de naissance à l'année courante.
```
if($day_birthdate>$day_today && $month_birthdate>=$month_today){
  $age=($year_today-$year_birthdate)-1;
} else {
  $age=$year_today-$year_birthdate;
}
```
Enfin, à l'extérieur de la fonction calcul_age, on appelle cette fonction :
```
calcul_age();
```

## Le code complet :
### Le HTML

```
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
```

### Le PHP
```
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

```
