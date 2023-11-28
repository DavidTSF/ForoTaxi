<?php 
error_reporting(0);

require_once("../private/api/userManager.php");
require_once("../private/api/forumManager.php");

//Debug 
//print_r($_COOKIE['logintoken']);
//echo "<br>";


// VARIABLES

$detoken = deTockener($_COOKIE['logintoken']);
$userArray = explode(":", $detoken);

$canPost = false;

// userArray[0] == USERNAME
// userArray[1] == HASHEDPASSWORD



//require_once("./static/html/home/index.html");

function checkIfLogged ($userArray) {
    if ( !(empty($userArray[0]))) {
        echo "Alo $userArray[0], <a href='delog.php'>Delog</a>";
        $canPost = true;
    } else {
        echo '<a href="/login.php" >Login?</a>';
        echo '<a style="margin-left:0.5rem;" href="/register.php" >Registro?</a>';
    }

}







?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="static/css/index.css">
</head>


<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">

        <table style="width: 100%;">
            <tr>
                <td>
                    <img height="50px" width="50px" src="https://cdn.icon-icons.com/icons2/3002/PNG/512/taxi_icon_187780.png" alt="">
                </td>

                <td></td>

                <td style="text-align: right;">
                    <p style="margin-right: 3rem;">
                        <?php checkIfLogged($userArray) ?>
                    </p>
                </td>
            </tr>
        </table>

    </div>

    <!-- BODY -->
    <div class="body">

    
    </div>

    <!-- FOOTER -->
    <div class="footer">


    </div>

    <!-- MAINBODY -->
    <div class="bodyinside">
        <table>
            <tr>Foros:</tr>

            <?php
                $allForums = getAllForums($pdo);

                foreach ($allForums as $value) {
                    echo "<p>";
                    echo '<a href="forums.php?'.$value["forum_id"] .'">';
                    print_r($value["forum_name"]);
                    echo "</a>";
                    echo "</p>";
                }


            ?>



        </table>

    </div>

</div>

</body>

<style>

.container {
    display: grid; 
    grid-template-columns: 1fr 8fr 1fr; 
    grid-template-rows: 1fr 10fr 1fr; 
    gap: 0px 0px; 
}

.header { grid-area: 1 / 1 / 2 / 4; }

.body { grid-area: 2 / 1 / 3 / 4; }

.footer { grid-area: 3 / 1 / 4 / 4; }

.bodyinside { grid-area: 2 / 2 / 3 / 3; }

</style>

</html>