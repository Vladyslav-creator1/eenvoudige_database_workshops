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
// controleer of die form verzend is
if (isset($_POST["SubmitForm"])) {
    // ophalen van de gegevens
    //var_dump($_POST);
    $number = $_POST["pokemonaNumber"];
    $name = $_POST["pokemonaName"];
    $ability = $_POST["pokemonability"];
    $Type1 = $_POST["pokemonType1"];
    $Type2 = $_POST["pokemonType2"];
    $Species = $_POST["pokemonSpecies"];
    $Pictures = $_POST["pokemonPictures"];

   echo $query = "INSERT INTO pokemondb VALUES ('$name','$number','$Type1','$Type2','$ability','$Species', '$Pictures')";
}
?>
</body>
<a href="index.php">Home</a>
<form action="pokemon_toevogen.php" method="POST">
    <fieldset>
        <legend>Pokemon</legend>
        <p>
            <label for="name"> Number </label>
            <input type="text" name="pokemonaNumber" id="Number" >
        <p>
        <p>
            <label for="name"> Name </label>
            <input type="text" name="pokemonaName" id="Name" >
        <p>
        <p>
            <label for="name"> ability </label>
            <input type="text" name="pokemonability" id="ability" >
        <p>
    <p>
        <label for="name"> Type1 </label>
        <input type="text" name="pokemonType1" id="Type1" >
    <p>
    <p>
        <label for="name"> Type2 </label>
        <input type="text" name="pokemonType2" id="Type2" >
    <p>
    <p>
        <label for="name"> Species </label>
        <input type="text" name="pokemonSpecies" id="species" >
    <p>
        <p>
            <label for="name"> Pictures </label>
            <input type="text" name="pokemonPictures" id="pictures" >
        <p>
        <label>
            <input type="submit" name="SubmitForm">
            </label>
    </fieldset>