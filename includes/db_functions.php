<?php

global $conn;


function StartConnection($dbname){

    global $conn;

    $host = "localhost";
    //$dbname = "testdb";
    $username = "root";
    $password = ""; // standaard leeg bij XAMPP

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

        // Zet PDO foutmeldingen aan
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;

    }
    catch (PDOException $e) {
        echo "Verbinding mislukt: " . $e->getMessage();
    }
}

function ExecuteSelectQuery($query){

    global $conn;

    try {

        //$conn = startConnection($dbname);

        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Resultaat als associatieve array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    catch (PDOException $e) {
        echo "Query fout: " . $e->getMessage();
        return [];
    }
}

?>
