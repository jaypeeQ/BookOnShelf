<?php
session_start();

include '../../privateBoS/connection.php';

$sql = 'SELECT username, password, roleid FROM users WHERE username = :username';
$sth = $conn->prepare($sql);
$sth->bindParam(':username', $_POST['username']);
$sth->execute();
$_SESSION['logged_in'] = false;

if ($rsUser = $sth->fetch(PDO::FETCH_ASSOC)) {
    if (isset($_POST['login'])) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                if ($_POST['username'] == $rsUser['username'] && $_POST['password'] == $rsUser['password']) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $rsUser['username'];
                    $_SESSION['message'] = null;
                    $_SESSION['role'] = $rsUser['roleid'];

                    header('Location: ../index.php');
                } else {
                    $_SESSION['message'] = 'There was no user with that credentials. Register?';
                    header('Location: ../index.php');
                }
            }
        }
    } else {
        header('Location: ../index.php');
    }
}
