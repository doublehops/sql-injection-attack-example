<?php

    require 'functions.php';
    require 'config.php';

    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    // Passwords are hashed with the insecure MD5 algorithm.
    $sql = "SELECT * FROM user WHERE username='$username' AND password=MD5('$password')";

    if ($username) {
        $stmt = $db->prepare($sql);
        $stmt->execute();

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
        <h2>Insecure webform</h2>
        <p>This is a web form that that doesn't cleanse the variables in the backend. There are two users, `john` and `mary` with `password` being the password for both.</p>
        
        <h3>Login Form</h3>
        <form method="POST" action="">

            <?php if ($flash) : ?>
               <div class="flash"><?= $flash ?></div>
            <?php endif ?>

            <dl>
                <dt>Username</dt><dd><input type="text" name="username" value="<?= $_POST['username'] ?? '' ?>" /></dd>
                <dt>Password</dt><dd><input type="text" name="password" value="<?= $_POST['password'] ?? '' ?>" id="password-input" /></dd>
            </dl>
            <input type="submit" name="submit" value="submit" />
        </form>

        <br />

        <div class="code-block">
            <h4>Backend code</h4>
            <p>
                $username = $_POST['username'] ?? null;<br />
                $password = $_POST['password'] ?? null;<br /><br />

                $sql = "SELECT * FROM user WHERE username='$username' AND password=MD5('$password')";
            </p>
        </div>
        
        <h3>SQL Injection Examples</h3>
        <h4>Login without knowing username:</h4>
        <p>Password: <em class="input">xxxx') or 1=1;'</em></p>
        <div class="code-block">
            <h4>Resulting SQL</h4>
            <p>
                SELECT * FROM user WHERE username='john' AND password=MD5('xxxx') or 1=1;'')
            </p>
        </div>
        <br />

        <h4>Make a change to the table</h4>
        <p>Change `last_name` of all users.</p>
        <p>Password: <em class="input">xxxx'); UPDATE user SET last_name='Jones';'</em></p>
        <div class="code-block">
            <h4>Resulting SQL</h4>
            <p>
                SELECT * FROM user WHERE username='john' AND password=MD5('somepassattempt'); UPDATE user SET last_name='Jones';'')
            </p>
        </div>

        <p class="bottom-note"><strong>NOTE: Do NOT use MD5 to hash passwords.</strong></p>

    <script>
        window.onload = function() {
          $('em').click(function() {
            str = $(this).html();
            $('#password-input').val(str);
          });
        }
    </script>
    
    </body>
</html>
