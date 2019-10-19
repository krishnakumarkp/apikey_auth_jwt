<?php
require "../bootstrap.php";
use Src\TableGateways\UserGateway;

//$server = new OAuthServer();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = array(
        'name' =>  $_POST['name'] ?? null,
        'email' => $_POST['email'] ?? null,
        'username' => $_POST['username'] ?? null,
        'password' =>   $_POST['password'] ?? null
    );
   
    $userGateway = new UserGateway($dbConnection);

    $userGateway->insert($input);

    echo "<p><strong>User Created!</strong></p>";

    exit();
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <fieldset>
        <legend>Register</legend>
        <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
        </div>
        <div>
        <label for="email">Email</label>
        <input type="text" id="email" name="email">
        </div>
        <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
        </div>
        <div>
        <label for="password">Password</label>
        <input type="text" id="password" name="password">
        </div>
        </fieldset>
        <input type="submit" value="Register">
        </form>

    </body>
</html>