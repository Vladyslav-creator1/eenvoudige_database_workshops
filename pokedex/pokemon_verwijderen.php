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
// Ophalen pokemonnumber
$pokemonNumber = $_GET["pokemonNumber"];
//ophalen
$query = "SELECT * FROM pokemon WHERE number = $pokemonNumber;";

include "../includes/db_functions.php";
$conn = StartConnection("pokemondb");
//form verzonden of niet
if (isset($_POST["SubmitForm"])) {
    // ophalen verzond of niet

    // delete
    $DeleteQuery = "DELETE FROM pokemon WHERE number = '$pokemonNumber'";
    $rowsAffected = ExecuteQuery($DeleteQuery);

    if($rowsAffected >= 1){
        echo "Pokemon succesvol verwijderd.";
        echo '<br><a href="index.php">Terug naar overzicht</a>';
        exit; // stop script
    } else {
        echo "Helaas, er is iets misgegaan.";
    }
}

// als niet delete dan fout
$result = ExecuteSelectQuery($query);
if (!empty($result)) {
    $current = $result[0];
} else {
    echo "Pokemon niet gevonden.";
    exit;
}



// gegevens van pokemon ophalen
$result = ExecuteSelectQuery($query);

//maken we een array van
$current = $result[0];
//bestande gegevens uit de database
var_dump($current);
$currentNumber = $current["number"];
$currentName = $current["name"];
$currentAbility = $current["ability"];
$currentType1 = $current["type1"];
$currentType2 = $current["type2"];
$currentSpecies = $current["species"];
$currentPictures = $current["picture"];




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
<form action="pokemon_bewerking.php?pokemonNumber=<?php echo $pokemonNumber;?>" method="POST">
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