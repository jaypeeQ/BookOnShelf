<?php
session_start();
include '../../privateBoS/connection.php';
var_dump($_POST);
$borrow = $_POST['borrow'];

$sqlborrow = 'SELECT title, isbn, stock_amount, xborrowed FROM books WHERE isbn =:isbn';
$sth = $conn->prepare($sqlborrow);
$sth->bindParam(':isbn', $_POST['isbn']);
$sth->execute();
while ($rsborrow = $sth->fetch(PDO::FETCH_ASSOC)): {

        $oldamount = $rsborrow['stock_amount'];
        $newamount = $oldamount - $borrow;
        $xborrow = $rsborrow['xborrowed'] + $borrow;

        $sqlborrow2 = 'UPDATE books SET stock_amount = :newamount , xborrowed = :xborrow WHERE isbn = :isbn';
        $sth2 = $conn->prepare($sqlborrow2);
        $sth2->bindParam(':newamount', $newamount);
        $sth2->bindParam(':xborrow', $xborrow);
        $sth2->bindParam(':isbn', $_POST['isbn']);
        $sth2->execute();

        $sqlxborrowed = 'INSERT INTO xborrowed (isbn, title, username) VALUES (:isbn, :title, :username) ';
        $sth3 = $conn->prepare($sqlxborrowed);
        $sth3->bindParam(':title', $rsborrow['title']);
        $sth3->bindParam(':isbn', $_POST['isbn']);
        $sth3->bindParam(':username', $_SESSION['username']);
        $sth3->execute();
        $_SESSION['message'] = 'Thank you for borrowing the book! Please do enjoy.';
        header('Location: ../index.php');

}endwhile;