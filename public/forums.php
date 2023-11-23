<?php 
error_reporting(1);

require_once("../private/api/forumManager.php");
require_once("../private/api/userManager.php");

$detoken = deTockener($_COOKIE['logintoken']);
$userArray = explode(":", $detoken);
$canPost = false;
$redirect = false;
$id = explode("?", $_SERVER['QUERY_STRING'])[0];


if (!($_SERVER['QUERY_STRING'])) {
    echo "Perrrrroooo";
    die();
} elseif ( explode("?", $_SERVER['QUERY_STRING'])[1] == "post") {
    echo "Perfe";

    //print_r($_POST["content"]);

    $content = $_POST["content"];
    userPostForum($pdo, $userArray[2], $content, $id);


    $redirect = true;
} 
else if ( !($userArray[0] == "")) {

    $canPost = true;
    $data = getAllForumsPosts($pdo, $_SERVER["QUERY_STRING"]);
}


//userPostForum($pdo, 7, "Hola soy otro texto del comentario", $_SERVER["QUERY_STRING"]);





function serializePosts( $dbData ) {

    //print_r($dbData);
    
    foreach ($dbData as $post ) {
        // Variable para mostrar el contenido : $post['content']            ;
        // Variable para mostrar el usuario   : $post['username']           ;
        include("static/html/templates/comment_template.html");
    }

}





?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <?php 
            if ($redirect) {
               echo '<meta http-equiv="refresh" content="0; url=/forums.php?'. $id .'">';
	    }?>
	<title>TaxiChan UwU</title>
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
    <a href="../">Volver</a>

    </div>

    <!-- MAINBODY -->
    <div class="bodyinside">

        <?php serializePosts($data); ?>

        <div>
            <a href="#dialog"><button >Comentar</button></a>
            <div style="width: 100%;" id="dialog">

                <form method="POST" action="forums.php?<?=$_SERVER['QUERY_STRING']?>?post" style="width: 100%;">
                    <textarea style="height: 100%;width: 100%;box-sizing: border-box;resize:none" name="content" ></textarea>
                    <input type="submit">
                </form>
                <a href=""><button >Cerrar</button></a>

            </div>
        </div>
        
 
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

    #dialog {
        display: none;
        width: 300px;
        height: 100px;
        border:1px solid #CCC;
        background:#EEE;
    }

    #dialog:target {
        display: block;
    }

    #dialog:close {
        display: none;
    }


</style>

</html>
