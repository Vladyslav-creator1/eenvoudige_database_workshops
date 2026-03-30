<?php
/*
 * Autor: Vlad
 * Data: 18/03/2026
 */

include "../includes/db_functions.php";

$conn = StartConnection("pokemondb");

// halen number
$pokemonNumber = $_GET["pokemonNumber"] ?? null;

if (!$pokemonNumber) {
    echo "Pokemon number ontbreekt.";
    exit;
}

// DELETE обработка
if (isset($_POST["SubmitForm1"])) {

    $DeleteQuery = "DELETE FROM pokemon WHERE number = '$pokemonNumber'";
    $rowsAffected = ExecuteQuery($DeleteQuery);

    if ($rowsAffected >= 1) {
        header("Location: index.php");
        exit;
    } else {
        echo "Helaas, er is iets misgegaan bij het verwijderen.";
    }
}

// SELECT (late zien)
$query = "SELECT * FROM pokemon WHERE number = $pokemonNumber;";
$result = ExecuteSelectQuery($query);

if (!empty($result)) {
    $current = $result[0];
    $currentNumber = $current["number"];
} else {
    echo "Pokemon niet gevonden.";
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pokemon bewerking</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<a href="index.php">Home</a>

<form action="pokemon_verwijderen.php?pokemonNumber=<?php echo $pokemonNumber; ?>"
      method="POST"
      onsubmit="return confirm('Weet je zeker dat je deze Pokémon wilt verwijderen?');">

    <fieldset>
        <legend>Pokemon bewerkingen</legend>

        <p>
            <label for="Number">Number</label>
            <input type="text"
                   value="<?php echo $currentNumber; ?>">
        </p>

        <button type="submit" name="SubmitForm1">
            Delete
        </button>

    </fieldset>
</form>

</body>
</html>