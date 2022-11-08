<?php

include '../../privateBoS/connection.php';

$sql = 'DELETE FROM users WHERE userid = :userid';
$sth = $conn->prepare($sql);
$sth->bindParam(':userid', $_POST['userid']);
$sth->execute();

header('refresh: 0.001; ../index.php');
