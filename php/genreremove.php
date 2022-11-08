<?php

include '../../privateBoS/connection.php';

$sql = 'DELETE FROM tbgenre WHERE genreid = :genreid';
$sth = $conn->prepare($sql);
$sth->bindParam(':genreid', $_POST['genreid']);
$sth->execute();
$_SESSION['message'] = 'Successfully removed genre.';
header('refresh: 0.001; ../index.php');
