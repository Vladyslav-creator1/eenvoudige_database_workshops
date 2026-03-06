<?php
/*
 * Autor:L.VLAD
 * Data:6/3/26
 * Pokedex indexpagina
 *
 */

//db_functies includen

include "../includes/db_functions.php";

StartConnection("pokemondb");

//$query = "SELECT * FROM `pokemon`WHERE type1 = 'Fire' OR type1 = 'Water';";
         //ORDER BY `pokemon`.`type1` DESC";
$query = "SELECT * FROM pokemon;";

//Uitvoeren van de query op de database

$result = ExecuteSelectQuery($query);

foreach ($result as $row)
{

    $name = $row["name"];
    $img = $row["picture"];
    echo "<article>";
        echo $name. "<br>";
        echo "<img src= '$img' alt='$name' width='100'>";
    echo "</article>";

}
