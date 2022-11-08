<?php
include '../../privateBoS/connection.php';
//var_dump($_POST);
echo "<pre>", print_r($_POST), "</pre>";

$isbn = $_POST['isbn'];
$schrijver = $_POST['author'];
$title = $_POST['title'];
$pages = $_POST['pages'];
$genreid = $_POST['genre'];
$stock = $_POST['stock'];
$langid = $_POST['lang'];
$xborrowed = $_POST['xborrowed'];
$xreserved = $_POST['xreserved'];
$info = $_POST['info'];

$sql = "SELECT * FROM tbauthor WHERE authorname = :author";
$sth = $conn->prepare($sql);
$sth->bindParam(':author', $schrijver);
$sth->execute();

if ($sth->rowCount() > 0 ){
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    $sql = "UPDATE books SET title = :title, authorid = :authorid, genreid = :genre, langid = :lang, page_amount = :pages, stock_amount = :stock,
                             bookinfo =:info, xborrowed =:xborrowed, xreserved =:xreserved
                    WHERE isbn = :isbn";
    $sth = $conn->prepare($sql);
    $sth->bindParam(':title', $title);
    $sth->bindParam(':authorid', $result['authorid']);
    $sth->bindParam(':genre', $genreid);
    $sth->bindParam(':pages', $pages);
    $sth->bindParam(':lang', $langid);
    $sth->bindParam(':stock', $stock);
    $sth->bindParam(':info', $info);
    $sth->bindParam(':isbn', $isbn);
    $sth->bindParam(':xborrowed', $xborrowed);
    $sth->bindParam(':xreserved', $xreserved);
    $sth->execute();

    header('Location: ../index.php');
}else{
    $sql = "INSERT INTO tbauthor (authorname) VALUES (:author)";
    $sth = $conn->prepare($sql);
    $sth->bindParam(':author', $schrijver);
    $sth->execute();
    $result = $conn->lastInsertId();

    $sql = "UPDATE books SET title = :title, authorid = :authorid, genreid = :genre, langid = :lang, page_amount = :pages, stock_amount = :stock,
                             bookinfo =:info, xborrowed =:xborrowed, xreserved =:xreserved
                    WHERE isbn = :isbn";
    $sth = $conn->prepare($sql);
    $sth->bindParam(':title', $title);
    $sth->bindParam(':authorid', $result);
    $sth->bindParam(':genre', $genreid);
    $sth->bindParam(':pages', $pages);
    $sth->bindParam(':lang', $langid);
    $sth->bindParam(':stock', $stock);
    $sth->bindParam(':info', $info);
    $sth->bindParam(':isbn', $isbn);
    $sth->bindParam(':xborrowed', $xborrowed);
    $sth->bindParam(':xreserved', $xreserved);
    $sth->execute();

    header('Location: ../index.php');
}


