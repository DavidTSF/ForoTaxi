<?php 
require_once("PDO.php");
$salt = "4";
$secret = "2598y2tr93gjh387g3gf8f23fi23n4f78324fh32nf7832";


function getAllForums($pdo) {
    $stmt = $pdo -> prepare('SELECT * FROM forums');
    $stmt -> execute();
    $forums = $stmt -> fetchAll();
    return $forums;
}


function getOneForum($pdo, $forumName) {
    $stmt = $pdo -> prepare('SELECT forum_name FROM forums WHERE forum_name = ?');
    $stmt -> execute([$forumName]);
    $forum = $stmt -> fetch();
    return $forum;
}

function createForum($pdo, $forumName) {

    if ($forumName == getOneForum($pdo, $forumName)["forum_name"] ) {
        echo "<h1> Ese nombre ya existe </h1>";
        die();
    }

    $stmt = $pdo -> prepare('INSERT INTO forums( forum_name ) VALUES ( ? )');
    $stmt -> execute ([$forumName]);
    $result = $stmt -> fetch();
    return $result;
}

function getAllForumsPosts($pdo, $forumID) {
    $stmt = $pdo -> prepare('select u.*, p.username from forums_posts u join users p on p.id = u.by_user where u.id_forum = ?');
    
    //$stmt = $pdo -> prepare('SELECT * FROM forums_posts WHERE id_forum = ?');
    $stmt -> execute([$forumID]);
    $forum = $stmt -> fetchAll();
    return $forum;
}

function userPostForum($pdo, $user, $content ,$forumID, $imageUrl = null ) {
    $stmt = $pdo -> prepare('INSERT INTO forums_posts( id_forum, content, image_url, by_user ) VALUES ( ?, ?, ?, ? )');
    $stmt -> execute ([$forumID, $content, $imageUrl, $user ]);
    $result = $stmt -> fetch();
    return $result;
}

?>