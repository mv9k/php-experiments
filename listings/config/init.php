<?php

// Config File
require_once 'config.php';

// Auto-load classes
function __autoload($class_name){
    require_once 'lib/'.$class_name. '.php';
}