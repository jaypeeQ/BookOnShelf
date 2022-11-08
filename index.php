<!DOCTYPE>
<?php
session_start();
require_once '../privateBoS/connection.php';
?>
<html>

<head>
    <title>Book on Shelf</title>
    <link href="CSS/style.css" rel="stylesheet">
</head>

<body> <?php
include '../privateBoS/connection.php';
$sql = 'SELECT books.title, books.stock_amount, books.bookinfo,books.page_amount, books.isbn, books.stock_amount, tbauthor.authorname, tbgenre.genre, tblang.language, xreserved.username, xreserved.reservedate 
                    FROM (((books
                    INNER JOIN tbgenre ON books.genreid = tbgenre.genreid)
                    INNER JOIN tbauthor ON books.authorid = tbauthor.authorid)
                    INNER JOIN tblang on books.langid = tblang.langid)
                    INNER JOIN xreserved on xreserved.isbn = books.isbn
                    WHERE xreserved.username = :user';

$sth = $conn->prepare($sql);
$sth->bindParam(':user', $_SESSION['username']);

$sth->execute();

while ($rsMybooks = $sth->fetch(PDO::FETCH_ASSOC)): {
$sqlnotify = 'SELECT users.username, books.title, notifyreserved.isbn
                      FROM notifyreserved 
                          INNER JOIN users ON notifyreserved.userid = users.userid
                          INNER JOIN books ON books.isbn = notifyreserved.isbn';
$sth = $conn->prepare($sqlnotify);
$sth->execute();
while ($rsNotify = $sth->fetch(PDO::FETCH_ASSOC)): {
    if (isset($_SESSION['username'])) {
        if (($_SESSION['username'] == $rsNotify['username']) && ($rsNotify['isbn'] == $rsMybooks['isbn'])) {?>
                    <div class="notification">
                        <strong>NOTE</strong> Your book <?= $rsNotify['title']?> is ready for you. Check your books to be able to check out your available book!
                        <button><a href="index.php?page=mybooks">My books</a></button>
                    </div>
                <?php }
            }

}endwhile;
}endwhile;

?>
<header>

    <h1>  <img src="Images/book-on-shelf.png" height="80px" width="80px" align="left" style="padding-left: 20px"> Book on Shelf</h1>
</header>
<?php
$page = '';
if(!isset($_SESSION['logged_in'])) {
    include 'Includes/login.inc.php';
}

elseif(isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == true) {
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
            $_SESSION['message'] = NULL;
        }
            else {
            $page = 'home';
        }

        include 'Includes/navbar.inc.php';
        include 'Includes/'.$page.'.inc.php';
    }else {
        include 'Includes/login.inc.php';
    }
}
?>

</body>
</html>