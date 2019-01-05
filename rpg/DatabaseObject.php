<?php
/**
 * Database.php 
 * DatabaseObject to handle managing database connection and queries
 */

 class DatabaseObject 
 {
     private $con;

     public function __construct($host, $username, $password, $database)
     {
         $this->con = mysqli_connect($host, $username, $password, $database);
         if(!$this->con)
         {
             throw new Exception('Error connecting to database.');
         }
     }
 }

 