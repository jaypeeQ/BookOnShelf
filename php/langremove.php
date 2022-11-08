<?php


include '../../privateBoS/connection.php';

$sql = 'DELETE FROM tblang WHERE langid = :langid';
$sth = $conn->prepare($sql);
$sth->bindParam(':langid', $_POST['langid']);
$sth->execute();
$_SESSION['message'] = 'Successfully removed genre.';

echo $_POST['langid'];
header('refresh: 0.001; ../index.php');
