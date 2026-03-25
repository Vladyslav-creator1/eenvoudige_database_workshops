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
//Uitvoeren van de query op de database


global $selectedType;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<main>
    <a href = "index.php">

    <h1>Pokedex</h1>
    </a>
    <a href="pokemon_toevogen.php">Toevogen</a>
    <form action="index.php" method="GET">

        <fieldset>
            <legend>Zoeken</legend>
            <label>
                <input type="text" name="searchName">

                <input type="submit" name="searchForm" value="Zoeken..">
            </label>
        </fieldset>
        <label for="pokemon">types </label>
        <select id="type" name="searchtype1" >

            <?php
            $type1Querry = "SELECT DISTINCT type1 FROM pokemon;";
            $type1 = ExecuteSelectQuery($type1Querry);

            foreach ($type1 as $item)
            {
                $type = $item["type1"];
                echo "<option value='$type'>$type</option>";
                $isSelected = ($type === $selectedType) ? "selected" : "";
                echo "<option value='$type' $isSelected>$type</option>";
            }
            ?>

        </select>

    </form>
    <section>
        <?php






        if (isset($_GET["searchName"]))
        {

            $searchName = $_GET["searchName"];
            $searchtype1 = $_GET["searchtype1"];

            if(isset($searchtype1))
            {
                $query = "SELECT * FROM pokemon WHERE type1 = '$searchtype1' AND name LIKE '%$searchName%';";
            }
            else {
                $query = "SELECT * FROM pokemon WHERE name LIKE '%$searchName%';";
            }
            echo "U heeft gezocht op: '$searchName''.";
        }
        else
        {
            $query = "SELECT * FROM pokemon;";
        }
        $result = ExecuteSelectQuery($query);

        foreach ($result as $row)
        {
            $name = $row["name"];
            $img = $row["picture"];
            $pokemonNumber = $row["number"];
            echo "<article>";
            echo $name . "<br>";
            echo "<img src='$img' alt='$name' width='100'>";
            echo "</article>";
            echo "<a href='pokemon_bewerking.php?pokemonNumber=$pokemonNumber'><button>Bewerking</button></a>";
        }
        ?>
    </section>


</main>
</body>
</html>