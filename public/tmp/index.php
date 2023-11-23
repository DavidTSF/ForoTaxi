<?php 

//require_once "archivosWeb/index.html";


function listDirectory () {
    $dirs = scandir(".");
    $dirs = array_diff($dirs , array(".", "..", "index.php", "archivosWeb"));

    $color = ["color1","color2"];
    $contador = 0;

    foreach ($dirs as $dir) {
        $isADir = is_dir($dir);
        $class = "fileClass";

        

        echo "<p class='filasEjercicio ".$color[$contador%2]."'>";

        if ($isADir) {
            echo '<i class="fa-regular fa-folder"></i>';
            $class = "dirClass";
        } else {
            echo '<i class="fa-regular fa-file"></i>';
        }
    
        echo "<a class='$class' href='$dir'>". $dir . "</a> </p>";
        $contador++;
    }
}

?>





<!DOCTYPE html>
<html lang="eS">

<head>
    <meta charset="UTF-8">
    
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="archivosWeb/index.css">

</head>
 
<body>
    

    <div style="margin: 1.5rem;">

        <!-- HEAD -->
        <div>
            <div>

                <h1>Descargas y subidas</h1>

            </div>
        </div>


        <!-- BODY -->
        <div style="margin: 2rem;">
            <div>

                <?php listDirectory(); ?>

            </div>

            <div style="margin-top: 2rem;">
                <form action="archivosWeb/upload.php" method="POST" enctype="multipart/form-data">
                    <input style="margin-right: 1rem ;" type="submit" value="Subir archivo" name="submit">
                    <input type="file" name="fileToUpload" id="fileToUpload" multiple>
                </form>
            </div>

            <div style="margin-top: 1.5rem;">
                <a href="../">Volver</a>
            </div>
        </div>

    </div>

    
</body>

</html>