<?php

if (isset($_POST['create-post-submit'])) {
    session_start();
    require '../dbh.inc.php';
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    $userId = $_SESSION['userId'];
    
    if (empty($title) || empty($content)) {
        header('Location: ../../../writepost.php?error=emptyfields');
        exit();
    }
    else {
        $sql = "INSERT INTO post (postCreatorID,title,content,date) VALUES (?, ?, ?, CURRENT_TIMESTAMP())";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header('Location: ../../../writepost.php?error=sqlerror');
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, 'sss', $userId, $title, $content);
            mysqli_stmt_execute($stmt);
            header('Location: ../../../writepost.php?published=success');
            exit();
        }
    }
}
else {
    header('Location: ../../../writepost.php');
    exit();
}