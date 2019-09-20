<?php

if (isset($_POST['login-submit'])) {
    require '../dbh.inc.php';
    $mailuid = $_POST['username'];
    $password = $_POST['password'];
    
    if (empty($mailuid) || empty($password)) {
        header('Location: ../../../index?error=emptyfields');
        exit();
    }
    else {
        $sql = 'SELECT * FROM user WHERE username = ? OR email = ?';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('Location: ../../../index?error=sqlerror');
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwCheck = password_verify($password, $row['password']);
                if (!$pwCheck) {
                    header('Location: ../../../index?error=wrongpw');
                    exit();
                }
                else if ($pwCheck) {
                    session_start();
                    $_SESSION['userId'] = $row['userID'];
                    $_SESSION['userUid'] = $row['username'];
                    
                    header('Location: ../../../index?login=success');
                    exit();
                }
                else {
                    header('Location: ../../../index?error=nouser');
                    exit();
                }
            }
            else {
                header('Location: ../../../index?error=nouser');
                exit();
            }
        }
    }
}
else {
    header('Location: ../../../index');
    exit();
}