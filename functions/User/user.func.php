<?php

function updateUser($conn, $email, $name, $lastname, $role, $id): void
{
    $userQuery = "UPDATE Users SET email=?, name=?, lastname=?, role=? WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /admin/index.php?action=users&edit={$id}&error=stmtfailure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssi", $email, $name, $lastname, $role, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /admin/index.php?action=users&edit={$id}&notify=updatesuccess");
    exit();
}

function createUser($conn, $email, $pass, $name, $lastname, $display_name, $role): void
{
    $userQuery = "INSERT INTO users (email, pass, name, lastname, display_name, role) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $userQuery)) {
        header("location: /signup.php?error=stmtfailure");
        exit();
    }
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssss", $email, $hashedPassword, $name, $lastname, $display_name, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /index.php?action=login&notify=usersuccess");
    exit();
}

function userLogin($conn, $user, $password, $remember): void
{
    $userExists = userExist($conn, $user);
    if ($userExists === false) {
        header("location: /login.php?error=incorrect");
        exit();
    }
    $hashedPass = $userExists["pass"];
    $role = $userExists["role"];
    $id = $userExists["id"];
    $checkPass = password_verify($password, $hashedPass);
    if ($checkPass === false) {
        header("location: /login.php?error=incorrect");
        exit();
    }
    $_SESSION["id"] = $userExists["id"];
    $_SESSION["login-status"] = true;
    $_SESSION["role"] = $role;
    if ($remember) {
        setcookie("logged-in", $id, time() + (86400 * 30), "/");
    }
    header("location: /index.php");
    exit();
}