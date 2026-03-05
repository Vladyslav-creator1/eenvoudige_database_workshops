<?php
/*
 * Autor: L.Vlad
 * Date: 5 3 26
 *
 * Verbinding maken met een database en gegevens ophalen.
 */

//includen van db_functies
include "../includs/db_functions.php";

//databaseverbinding starten
StartConnection("world");

//Schrijven van de Query
$query = "SELECT * FROM country;";

//Uitvoeren van de Query

$result = ExecuteSelectQuery($query);
//loop resultaten

foreach ($result as $row) {
    echo $row["name"] . "<br>";
}