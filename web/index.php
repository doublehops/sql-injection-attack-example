<style type="text/css">
table {border-collapse: collapse; border: 0; width: 934px; box-shadow: 1px 2px 3px #ccc;}
.center {text-align: center;}
.center table {margin: 1em auto; text-align: left;}
.center th {text-align: center !important;}
td, th {border: 1px solid #666; font-size: 75%; vertical-align: baseline; padding: 4px 5px;}
</style>

<title>Webserver</title>

<table>
    <tr><th>Hostname:</th><td><?= $_SERVER['HTTP_HOST'] ?></td></tr>
    <tr><th>IP Address:</th><td><?= $_SERVER['SERVER_ADDR'] ?></td></tr>
    <tr><th>Docroot:</th><td><?= $_SERVER['DOCUMENT_ROOT'] ?></td></tr>
    <tr><th>Operating System</th><td><?= getOS() ?></td></tr>
    <tr><th>Webserver:</th><td><?= $_SERVER['SERVER_SIGNATURE'] . $_SERVER['SERVER_SOFTWARE'] ?></td></tr>
    <tr><th>PHP:</th><td><?= phpversion() ?></td></tr>
</table>

<p><a href="sql-injection-playground.php">SQL Injection Playground</a></p>
<p><a href="contact-list.php">Contact List</a></p>
<p><a href="step1.php">SQL injection example - Gain shell access</a></p>


<?php

function getOS()
{
    // Ubuntu
    if(file_exists('/etc/lsb-release')) {
        return exec("cat /etc/lsb-release | grep DESCRIPTION | sed 's/DISTRIB_DESCRIPTION=//g'");
    }

    // Debian
    if(file_exists('/etc/debian_version')) {
        return 'Debian '. file_get_contents('/etc/debian_version');
    }

    // Centos
    if(file_exists('/etc/centos-release')) {
        return file_get_contents('/etc/centos-release');
    }

    return '';
}
