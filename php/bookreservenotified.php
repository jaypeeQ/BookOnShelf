<?php
session_start();
include '../../privateBoS/connection.php';
var_dump($_POST);
var_dump($_SESSION);
$borrow = $_POST['borrow'];

$sqlborrow = 'SELECT title, notifyreserved.isbn, users.username, users.userid FROM notifyreserved 
                INNER JOIN users ON users.userid = notifyreserved.userid
                CROSS JOIN books
                WHERE notifyreserved.isbn = :isbn AND username = :username AND books.isbn = notifyreserved.isbn';
$sth = $conn->prepare($sqlborrow);
$sth->bindParam(':isbn', $_POST['isbn']);
$sth->bindParam(':username', $_SESSION['username']);

$sth->execute();
while ($rsborrow = $sth->fetch(PDO::FETCH_ASSOC)): {
    var_dump($rsborrow);
    $sqlnotifydelete = 'DELETE FROM notifyreserved WHERE isbn = :isbn AND userid = :userid';
    $sthnotifydelete = $conn->prepare($sqlnotifydelete);
    $sthnotifydelete->bindParam(':isbn', $_POST['isbn']);
    $sthnotifydelete->bindParam(':userid', $rsborrow['userid']);
    $sthnotifydelete->execute();
    $sqldelete = 'DELETE FROM xreserved WHERE isbn = :isbn AND username = :username';
    $sthdelete = $conn->prepare($sqldelete);
    $sthdelete->bindParam(':isbn', $_POST['isbn']);
    $sthdelete->bindParam(':username', $_SESSION['username']);
    $sthdelete->execute();
    $sqlxborrowed = 'INSERT INTO xborrowed (isbn, title, username) VALUES (:isbn, :title, :username) ';
    $sth3 = $conn->prepare($sqlxborrowed);
    $sth3->bindParam(':title', $rsborrow['title']);
    $sth3->bindParam(':isbn', $_POST['isbn']);
    $sth3->bindParam(':username', $_SESSION['username']);
    $sth3->execute();
    $_SESSION['message'] = 'Thank you for borrowing the book! Please do enjoy.';
    header('Location: ../index.php');

}endwhile;