<?php 
error_reporting(0);

require_once("../private/api/userManager.php");


$refresh = false;
$redirect = false;

//print_r($_POST);
if ( $_POST['username'] != "" && $_POST['password'] != "" && $_POST['passwordVerify'] ) {
    
    if ( $_POST['password'] == $_POST['passwordVerify'] ) {
       
        

        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo -> prepare('SELECT username FROM users WHERE username = ? ');
        $stmt -> execute ([$username]);
        $DBuser = $stmt -> fetch()['username'];
        
        if ($DBuser == $username) {
            $refresh = true;
            
        }   
        else {
            $redirect = true;
            $hashPass = hash('sha256', $password.$salt, false);
            $stmt = $pdo -> prepare('INSERT INTO users( username, password ) VALUES ( ? , ? )');
            $stmt -> execute ([$username, $hashPass]);
            echo '<h1> Registro realizado </h1>';
        }








    } else {
        echo '<h1> Las contraseñas no son iguales </h1>';
    }




}





?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <?php 
            if ($redirect) {
                echo '<meta http-equiv="refresh" content="1; url=/">';
            }
            elseif ($refresh) {
                echo '<meta http-equiv="refresh" content="2; url=/register.php">';
                echo '<h4>Usuario ya existe</h4>';
            }
        ?>


    </head>

    <body>



        <h1>Registro</h1>
        
        <form action="#" method="POST">

          <span> <label>Usuario: <input type="text" name="username" id="username"></label></span> <br>
          <span> <label>Contraseña: <input type="password" name="password" id="password"></label></span> <br>
          <span> <label>Confirmación de contraseña: <input type="password" name="passwordVerify" id="passwordVerify"></label></span> <br>
          <span> <label>Enviar: <input type="submit"></label></span>

        </form>
    </body>
	<style>
	header{
	font-size:30px;
	margin-bottom: 40px;
	}
	form{
	padding: 30px;
	background-color: rgba(170, 51, 106);
	border: 1px solid black;
	display: inline-block;
	}
	form span{
	display: block;
	margin-bottom: 20px;
	}
	form span label{
	margin-right: 10px;
	}
	form input[type=text]{
	width: 125px;
	display: block;
	}
	form input[type=password]{
	width:125px;
	display: block;
	}
	form inpit{
	margin-top: 10px;
	}
	<style>
</html>
