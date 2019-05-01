<?php

    require '../functions.php';
    require '../config.php';

    // Exploit query: http://secure.api/sql-injection/login.php?username=damien&password=%27%20OR%201=1;
    // Will return all users in table.

    $username = $_GET['username'] ?? null;
    $password = $_GET['password'] ?? null;

    $sql = "SELECT * FROM user WHERE username='". $username. "' AND password='". $password ."'";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } catch(PDOException $ex) {
        echo "Some error occured: $sql\n";
        dd($ex->getMessage());
    }

    $results = $stmt->fetchAll();

    json_dump($results);



