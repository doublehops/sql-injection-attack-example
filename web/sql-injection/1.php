<?php

    require '../functions.php';
    require '../config.php';

    // Exploit query: http://secure.api/sql-injection/1.php?table=contact;%20update%20contact%20set%20country_code=%27BR%27

    $table = isset($_GET['table']) ? $_GET['table'] : 'user';
    $sql = "SELECT * FROM ". $table. " WHERE id>0";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } catch(PDOException $ex) {
        echo "Some error occured: $sql\n";
        dd($ex->getMessage());
    }

    $results = $stmt->fetchAll();

    dd($results);


