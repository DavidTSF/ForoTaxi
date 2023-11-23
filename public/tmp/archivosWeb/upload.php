<?php 

$uploaddir = '/home/davtri/Documentos/www/public/CosasVarias/subidas/upl/';
$uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name']);




echo '<pre>';

if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
    echo "Archivo subido \n";
} else {
    echo "Error \n";
}

// print_r($_FILES);

// echo 'Here is some more debugging info:';
// print_r($_FILES);

print "</pre>";






//$target_dir = "uploads/";

// $target_dir = ".";
// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// move_uploaded_file($_FILES["fileToUpload"]["name"], $target_file);

$ip = "10.2.1.194";
//header("Location: http://". $ip . "/CosasVarias/index.php");



?>

<head>
    <meta http-equiv="refresh" content="1; url=/CosasVarias/ ">
</head>