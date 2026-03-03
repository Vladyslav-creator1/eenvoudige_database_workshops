<?php
/*
 *  Name: Vlad
 *  Datum: 24/02/2026
 *
 *
 *
 */

//var_dump($_POST);
//controleren of er een formuleren verzend bent
if(isset($_POST["foem_verzonden"]))
{

    $name = $_POST['Naam'];
    $email = $_POST['e-mail'];
    $leeftijd = $_POST['Leeftijd'];

    echo "<br>leeftijd: ".$leeftijd+10;
    echo "<br>naam: $name";
    echo "<br>e-mail: $email";

    if (isset($_POST["Gender"])) {
        $gender = $_POST['Gender'];
        echo "<br>gender: $gender";
    }
}
else{
    echo "U moet eerst formulier invulen";
}
