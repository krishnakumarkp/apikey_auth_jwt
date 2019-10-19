<?php
require "../bootstrap.php";
use Src\TableGateways\UserGateway;
use \Firebase\JWT\JWT;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userGateway = new UserGateway($dbConnection);
    $userDetails =  $userGateway->findUser($_POST['username']);

    if(password_verify($_POST['password'], $userDetails[0]['password'])) {

        // get the local secret key
        $secret = getenv('SECRET');

        $algorithm = getenv('ALGORITHM');

        // Create the token header
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => $algorithm
        ]);

        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;  //Adding 10 seconds
        $expire     = $notBefore + 60; // Adding 60 seconds

        // Create the token payload
        $payload = json_encode([
            'user_id' => $userDetails[0]['id'],
            'role' => 'admin',
            'exp' => $expire
        ]);

        // Encode Header
        $base64UrlHeader = base64UrlEncode($header);

        // Encode Payload
        $base64UrlPayload = base64UrlEncode($payload);

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = base64UrlEncode($signature);

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        echo "Your token:\n" . $jwt . "\n";

        exit();
      
    }
    echo "<p><strong>Invalid username passoword</strong></p>";
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
        <legend>Login</legend>
        <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
        </div>
        <div>
        <label for="password">password</label>
        <input type="text" id="password" name="password">
        </div>
        </fieldset>
        <input type="submit" value="Login">
        </form>

    </body>
</html>