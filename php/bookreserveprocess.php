<?php
session_start();
include '../../privateBoS/connection.php';
var_dump($_POST);
$reserve = $_POST['reserve'];

$sqlborrow = 'SELECT title, isbn, xreserved FROM books WHERE isbn =:isbn';
$sth = $conn->prepare($sqlborrow);
$sth->bindParam(':isbn', $_POST['isbn']);
$sth->execute();
while ($rsreserve = $sth->fetch(PDO::FETCH_ASSOC)): {
        $xreserve = $rsreserve['xreserved'] + $reserve;
        $sqlborrow2 = 'UPDATE books SET xreserved =:xreserve WHERE isbn = :isbn';
        $sth2 = $conn->prepare($sqlborrow2);
        $sth2->bindParam(':xreserve', $xreserve);
        $sth2->bindParam(':isbn', $_POST['isbn']);
        $sth2->execute();
        $sqlxborrowed = 'INSERT INTO xreserved (isbn, title, username) VALUES (:isbn, :title, :username) ';
        $sth3 = $conn->prepare($sqlxborrowed);
        $sth3->bindParam(':title', $rsreserve['title']);
        $sth3->bindParam(':isbn', $_POST['isbn']);
        $sth3->bindParam(':username', $_SESSION['username']);
        $sth3->execute();
        $_SESSION['message'] = 'Thank you for reserving the book! Once one is available, you will be able to borrow said book.';


        header('Location: ../index.php');

}endwhile;
