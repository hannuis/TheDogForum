<?php

if (isset($_POST['create-comment-submit'])) {
    session_start();
    require '../dbh.inc.php';
    
    $content = $_POST['comment'];
    $postId = $_GET['id'];
    $userId = $_SESSION['userId'];
    
    if (empty($content)) {
        header('Location: ../../../post.php?id=' .$postId .'&error=emptyfield');
        exit();
    }
    else {
        $sql = 'INSERT INTO comment (commentCreatorID,postID,content,date) VALUES (?, ?, ?, CURRENT_TIMESTAMP())';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header('Location: ../../../post.php?id=' .$postId .'&error=sqlerror');
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, 'sss', $userId, $postId, $content);
            mysqli_stmt_execute($stmt);
            header('Location: ../../../post.php?id=' .$postId .'&sent=success');
            exit();
        }
    }
}
else {
    header('Location: ../../../index.php');
    exit();
}