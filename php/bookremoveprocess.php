<?php
include '../../privateBoS/connection.php';

$sql = 'DELETE FROM books WHERE isbn = :isbn';
$sth = $conn->prepare($sql);
$sth->bindParam(':isbn', $_POST['isbn']);
$sth->execute();

header('refresh: 0.001; ../index.php');
