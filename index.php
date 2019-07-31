<?php


error_reporting(E_ALL);
ini_set('display_errors','On');
require "/var/www/html/sandbox/git/Homework/task17/vendor/autoload.php";

try {
    \Core\Router::start();

} catch (Exception $e) {
    die("Mistake: {$e->getMessage()}\n");
}

