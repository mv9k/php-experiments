<?php

require('DatabaseObject.php');
require('databaseVars.php');

$database = new DatabaseObject($host, $username, $password, $database);

if(!empty($_POST['register']))
{
    $username = $database->clean($_POST['username']);
    $password = $database->clean($_POST['password']);

    try {
        // Username
        if(strlen($username) < 5)
        {
            throw new Exception('Username must be at least 5 characters.');
        }

        if(strlen($username) > 50)
        {
            throw new Exception('Username must be less than 50 characters.');
        }

        if(!ctype_alnum($username))
        {
            throw new Exception('Username must be only letters or numbers.');
        }

        // Password
        if(strlen($password) < 6)
        {
            throw new Exception('Password must be at least 6 characters.');
        }

        if(strlen($password) >10)
        {
            throw new Exception('Password must be less than 10 characters.');
        }

        // Submit to database
        // TODO: change to sha1 for production
        $password = md5($password);
        $database->query("INSERT INTO `Users` (
            `username`, 
            `password`, 
            `level`, 
            `exp`, 
            `health`, 
            `max_health`,
            `money`, 
            `strength`,
            `intelligence`,
            `endurance`,
            `attacks`
        ) 
        VALUES (
            '$username', 
            '$password', 
            '0', 
            '0', 
            '100',
            '100', 
            '10',
            '1',
            '1',
            '1',
            'attacks'
        )");

        if($database->affected_rows() > 0)
        {
            echo 'Account Created! <a href="./">Login</a><br/>';
        }

    } catch (Exception $e) 
    {
        echo $e->getMessage();
    }

}

?>

<form action='./register.php' method='POST'>
    Username: <input type='text' name='username' /><br />
    Password: <input type='password' name='password' /><br />
    <input type='submit' name='register' value='Register' />
</form>