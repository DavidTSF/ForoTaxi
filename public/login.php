<?php 
error_reporting(0);

require_once("../private/api/userManager.php");



$redirect = null;

if ( $_POST['username'] != "" && $_POST['password'] != "" ) {
    
    $stmt = $pdo -> prepare('SELECT username,id FROM users WHERE username = ? ');
    $stmt -> execute ([$_POST['username']]);
    $DBdata = $stmt -> fetch();
    $usernameID = $DBdata['id'];
    $username = $DBdata['username'];
    //print_r($usernameID);


    if ($username != "") {
        $stmt = $pdo -> prepare('SELECT password FROM users WHERE username = ? ');
        $stmt -> execute ([$username]);
        $DBpassword = $stmt -> fetch()['password'];
        
        $postPassword = hash("sha256", $_POST['password'].$salt, false);

        if ( $DBpassword == $postPassword )  {
 #           echo "<h1> Login realizado! </h1>";
            $redirect = true;

            $dataToken = "$username:$DBpassword:$usernameID";

            $token = openssl_encrypt(
                $dataToken,
                "aes-256-cbc",
                $secret,
                null,
                null,
                );

            setcookie("logintoken", $token, time() + (86400 * 1), "/");
        } 

        

    }


    




}



?>

<!DOCTYPE html>
<html lang="eS">

    <head>
        <?php 
            if ($redirect) {
                echo '<meta http-equiv="refresh" content="0; url=/">';
            }
        ?>
        <title>Login si</title>
        <link rel="stylesheet" href="static/css/inicio.css">
    </head>

    <body>
    
    <a href="/index.php"><img src="/static/media/img/taxi.png" alt="prueba" id="taxi"></a>
    <img src="/static/media/img/titulo.png" alt="titulo" id="title">
    <div class="box">
    <form action="#" method="POST">
    <div class="form">
        <h2> Inicio de sesión </h2>
                <div class="inputBox">
                    <input type="text" name="username" id="username" required="required">
                    <span>Usuario</span>
                    <i></i>
                </div>      
                    <div class="inputBox">
                        <input type="password" name="password" id="password" required="required">
                        <span>Contraseña</span>
                        <i></i>
                    </div>
                <br>
            <input type="submit" value="Inicio">
        </div>
        </form>        
    </div>
    </body>

</html>
