<?php

require('DatabaseObject.php');
require('databaseVars.php');

$database = new DatabaseObject($host, $username, $password, $database);

if(!isset($_SESSION['user_id']) && $_POST['login']) {
    $username = $database->clean($_POST['username']);
    $password = $database->clean($_POST['password']);

    $result = $database->query("SELECT `id`, `username`, `password` FROM `Users` WHERE `username`='$username' LIMIT 1");
    try {
        if($database->num_rows($result) == 0) 
        {
            throw new Exception('Invalid Login');
        }

        $user = $database->fetch($result);

        if(md5($password) != $user['password'])
        {
            throw new Exception('Invalid Login');
        }

        $_SESSION['user_id'] = $user['id'];

    } catch (Exception $e) 
    {
        echo $e->getMessage();
    }

}

/* Display */

echo '<h1>TITLE OF RPG</h1>';

if(isset($_SESSION['user_id']))
{
    echo 'Welcome <br/>';
} 
else {
    echo
        "
        <form action='./' method='POST'>
            Username: <input type='text' name='username' /><br />
            Password: <input type='password' name='password' /><br />
            <input type='submit' name='login' value='Login' />
        </form>
        ";
}
