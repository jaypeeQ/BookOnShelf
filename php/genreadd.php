<?php

include '../../privateBoS/connection.php';
echo $_POST['genrename'];
$sql = 'INSERT INTO tbgenre (genre)
        VALUES (:genre)';
$sth = $conn->prepare($sql);
$sth->bindParam(':genre', $_POST['genrename']);
$sth->execute();

while ($rsPrepare = $sth->fetch(PDO::FETCH_ASSOC)):
    var_dump($rsPrepare);
endwhile;

header('Location: ../index.php');
