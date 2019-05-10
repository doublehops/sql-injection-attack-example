<?php

    require 'functions.php';
    require 'config.php';

    $search = $_GET['search'] ?? null;

    if ($search) {
        $sql = "SELECT * FROM contact WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'";
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
        <?php endif ?>

        <div class="code-block">
            <h4>Backend code</h4>
            <p>
                $search = $_GET['search'] ?? null;<br /><br />
                
                $sql = "SELECT * FROM contact WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'";
            </p>
        </div>
        
        <h3>SQL Injection Examples</h3>
        <h4>Set all last names to `Jones`</h4>
        <p>Search Term: <em class="input">joan'; UPDATE contact SET last_name='Jones';'</em></p>
        <div class="code-block">
            <h4>Resulting SQL</h4>
            <p>
                SELECT * FROM contact WHERE first_name LIKE '%joan'; UPDATE contact SET last_name='Jones';'%' OR last_name LIKE '%joan'; UPDATE contact SET last_name='Jones';'%'
            </p>
        </div>
        <br />

    <script>
        window.onload = function() {
          $('em').click(function() {
            str = $(this).html();
            $('#search-input').val(str);
          });
        }
    </script>
    
    </body>
</html>
