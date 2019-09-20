<?php

if ($_GET['id']) {
    session_start();
    require '../dbh.inc.php';
    
    $userId = $_SESSION['userId'];
    $postId = $_GET['id'];
    
    $sql = "INSERT INTO score (userID, postID) VALUES ('$userId', '$postId')";
    $result = mysqli_query($conn,$sql);
    header('Location: ../../../post.php?id=' .$_GET['id'] .'&liked=success');
    exit();
}
else {
    header('Location: ../../../index.php');
    exit();
}