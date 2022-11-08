<?php

include '../../privateBoS/connection.php';
echo $_POST['genrename'];
$sql = 'INSERT INTO tblang (language)
        VALUES (:lang)';
$sth = $conn->prepare($sql);
$sth->bindParam(':lang', $_POST['langname']);
$sth->execute();

while ($rsPrepare = $sth->fetch(PDO::FETCH_ASSOC)):
    var_dump($rsPrepare);
endwhile;

header('Location: ../index.php');
