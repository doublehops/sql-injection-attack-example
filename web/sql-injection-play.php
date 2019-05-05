<?php

    require 'functions.php';
    require 'config.php';

    $username = $_GET['username'] ?? null;
    $password = $_GET['password'] ?? null;

    $sql = "SELECT * FROM user WHERE username='$username'";

    if (isset($_GET['username'])) {
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
        } catch(PDOException $ex) {
            echo "Some error occured: $sql\n";
            dd($ex->getMessage());
        }
        
        // Rather than process login, we're just going to dump output for this example.
        //$results = $stmt->fetchAll();
    
        //json_dump($results);
    }

?>

<html lang="en">
    <head>
        <title>SQL Injection Example</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>
        <h2>Insecure webform</h2>
        <p>This is a web form that is insecure in the frontend and backend. It does not actually try to login but is
        more of a playground for SQL injection. The `username` field is not sanitised before usage.</p>
        
        <h3>Examples</h3>
        <p>
            Attempt login with username but add additional SQL to update password.<br />
            <a href="http://<?= HOST ?>/sql-injection-play.php?username=john%27;%20UPDATE%20user%20SET%20password=%27aaaaaxxxxxxxxx%27;%27">
                http://<?= HOST ?>/sql-injection-play.php?username=john%27; UPDATE user SET password=%27aaaaaxxxxxxxxx%27;%27
            </a>
        </p>
        
        <form method="GET" action="">
            Username: <input type="text" name="username" /><br />
            Password: <input type="password" name="password" /><br />
        </form>
    
    </body>
</html>
