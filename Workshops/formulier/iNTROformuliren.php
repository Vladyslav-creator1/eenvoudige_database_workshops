<?php
/*  Name: L.Vlad
 *  Datum: 24/02/2026
 *  formulier introductie
 *
 */
?>
<form method="post" action="resultaat.php">
    <label for="namefield">Naam</label>
    <input type="text" name="Naam" id="namefield">

    <br>
    <label>Gender</label>
    <input type="radio" name="Gender" value="Man">Man</input>
    <input type="radio" name="Gender" value="Women">Anders</input>
    <br><br>

    <label for="e-mail">e-mail</label>
    <input type="email" name="e-mail" id ="e-mail">
    <br><br>

    <label for="tijd">Leeftijd</label>
    <input type="text" name="Leeftijd" id="tijd">


    <input type="submit" name="foem_verzonden" value="verstuur"><br><br>

</form>
