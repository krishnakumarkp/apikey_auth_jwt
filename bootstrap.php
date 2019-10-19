<?php
require 'vendor/autoload.php';

use Src\System\DatabaseConnector;

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();


define('SECRET_KEY',getenv('SECRET_KEY'));  /// secret key can be a random string and keep in secret from anyone
define('ALGORITHM',getenv('ALGORITHM'));  // Algorithm used to sign the token


// test code, should output:
// api://default
// when you run $ php bootstrap.php
$dbConnection = (new DatabaseConnector())->getConnection();

// PHP has no base64UrlEncode function, so let's define one that
// does some magic by replacing + with -, / with _ and = with ''.
// This way we can pass the string within URLs without
// any URL encoding.
function base64UrlEncode($text)
{
    return str_replace(
        ['+', '/', '='],
        ['-', '_', ''],
        base64_encode($text)
    );
}