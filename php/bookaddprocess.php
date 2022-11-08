<?php
session_start();

include '../../privateBoS/connection.php';

$sql = 'INSERT INTO books (title, authorid, genreid, langid, page_amount, stock_amount, bookinfo)
        VALUES (:title, :author, :genre, :lang, :pages, :stock, :info)';

$sth = $conn->prepare($sql);
$sth->bindParam(':title', $_POST['title']);
$sth->bindParam(':author', $_POST['author']);
$sth->bindParam(':genre', $_POST['genre']);
$sth->bindParam(':pages', $_POST['pages']);
$sth->bindParam(':lang', $_POST['language']);
$sth->bindParam(':stock', $_POST['stock']);
$sth->bindParam(':info', $_POST['bookinfo']);

$sth->execute();

while ($rsPrepare = $sth->fetch(PDO::FETCH_ASSOC)):
    var_dump($rsPrepare);
endwhile;

header('Location: ../index.php');


var_dump($_POST);