<?php
/*
 * Autor: Vlad
 * Data: 18/03/2026
 *
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
<body>
<?php

$pokemonNumber = $_GET["pokemonNumber"];

$query = "SELECT * FROM pokemon WHERE number = $pokemonNumber;";

include "../includes/db_functions.php";
$conn = StartConnection("pokemondb");

$result = ExecuteSelectQuery($query);
$current = $result[0];
var_dump($current);
$currentNumber = $current["number"];
$currentName = $current["name"];
$currentAbility = $current["ability"];
$currentType1 = $current["type1"];
$currentType2 = $current["type2"];
$currentSpecies = $current["species"];
$currentPictures = $current["picture"];


if (isset($_POST["SubmitForm"])) {
    $number = $_POST["pokemonaNumber"];
    $name = $_POST["pokemonaName"];
    $ability = $_POST["pokemonability"];
    $Type1 = $_POST["pokemonType1"];
    $Type2 = $_POST["pokemonType2"];
    $Species = $_POST["pokemonSpecies"];
    $Pictures = $_POST["pokemonPictures"];

        echo $Updatequery = "UPDATE pokemon SET 
            name = '$name',
            ability = '$ability',
            Type1 = '$Type1',
            Type2 = '$Type2',
            Species = '$Species',
            Pictures = '$Pictures'
        WHERE number = '$number'
    ";

}

//    $stmt = $conn->prepare("
//        UPDATE pokemon
//        SET name = ?, ability = ?, Type1 = ?, Type2 = ?, Species = ?, Pictures = ?
//        WHERE number = ?
//    ");
//    $stmt->execute([$name, $ability, $Type1, $Type2, $Species, $Pictures, $number]);
//
//    if ($stmt->rowCount() >= 1) {
//        echo "Pokemon $name udated";
//    } else {
//        echo "Fout: its gaan fout";
//    }
//}
?>
</body>
<a href="index.php">Home</a>
<form action="pokemon_bewerking.php" method="POST">
    <fieldset>
        <legend>Pokemon bewerkingen</legend>
        <p>
            <label for="name"> Number </label>
            <input type="text" name="pokemonaNumber" id="Number" value="<?php echo $currentNumber ?>">
        <p>
        <p>
            <label for="name"> Name </label>
            <input type="text" name="pokemonaName" id="Name" value="<?php echo $currentName ?>">
        <p>
        <p>
            <label for="name"> ability </label>
            <input type="text" name="pokemonability" id="ability" value="<?php echo $currentAbility ?>">
        <p>
        <p>
            <label for="name"> Type1 </label>
            <input type="text" name="pokemonType1" id="Type1" value="<?php echo $currentType1 ?>">
        <p>
        <p>
            <label for="name"> Type2 </label>
            <input type="text" name="pokemonType2" id="Type2" value="<?php echo $currentType2 ?>">
        <p>
        <p>
            <label for="name"> Species </label>
            <input type="text" name="pokemonSpecies" id="species" value="<?php echo $currentSpecies ?>">
        <p>
        <p>
            <label for="name"> Pictures </label>
            <input type="text" name="pokemonPictures" id="pictures" value="<?php echo $currentPictures ?>">
        <p>
            <label>
                <input type="submit" name="SubmitForm">
            </label>
    </fieldset>