<?php

if (isset($_POST['signup-submit'])) {
    require '../dbh.inc.php';
    
    $username = $_POST['username'];
    $email = $_POST['mail'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password-repeat'];
    
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header('Location: ../../../signup?error=emptyfields&uid=' .$username .'&email=' .$mail);
        exit();
    }
    else if (!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match('/^[a-zA-Z0-9]*$/',$username)) {
        header('Location: ../../../signup?error=invalidmailuid');
        exit();
    }
    else if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        header('Location: ../../../signup?error=invalidmail&uid=' .$username);
        exit();
    }
    else if (!preg_match('/^[a-zA-Z0-9]*$/',$username)) {
        header('Location: ../../../signup?error=invaliduid&mail=' .$email);
        exit();
    }
    else if ($password !== $passwordRepeat) {
        header('Location: ../../../signup?error=passwordcheck&uid=' .$username .'&email=' .$mail);
        exit();
    }
    else {
        $sql = 'SELECT username 
                FROM user 
                WHERE username=?';
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header('Location: ../../../signup?error=sqlerror');
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);//kollar hur många rader
            if ($resultCheck > 0) {
                header('Location: ../../../signup?error=usertaken&mail=' .$email);
                exit();
            }
            else {
                $sql = 'INSERT INTO user (username, email, password) VALUES (?, ?, ?)';
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                    header('Location: ../../../signup?error=sqlerror');
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password,PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, 'sss', $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header('Location: ../../../signup?signup=success');
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header('Location: ../../../signup');
    exit();
}