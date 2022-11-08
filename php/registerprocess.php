<?php
var_dump($_POST);

$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
echo $password;
if (isset($_POST['register'])) {

    include '../../privateBoS/connection.php';

    $sql = 'INSERT INTO users (username, password, roleid, fname, tname, lname, city, street, hnummer, postcode, email, birthdate)
        VALUES (:user, :pass, 2, :fname, :tname, :lname, :city, :street, :hnummer, :postcode, :email, :birthdate)';

    $sth = $conn->prepare($sql);
    $sth->bindParam(':user', $_POST['user']);
    $sth->bindParam(':pass', $password);
    $sth->bindParam(':fname', $_POST['fname']);
    $sth->bindParam(':tname', $_POST['tname']);
    $sth->bindParam(':lname', $_POST['lname']);
    $sth->bindParam(':city', $_POST['city']);
    $sth->bindParam(':street', $_POST['street']);
    $sth->bindParam(':hnummer', $_POST['hnummer']);
    $sth->bindParam(':postcode', $_POST['postcode']);
    $sth->bindParam(':email', $_POST['email']);
    $sth->bindParam(':birthdate', $_POST['birthdate']);

    $sth->execute();
    while ($rsPrepare = $sth->fetch(PDO::FETCH_ASSOC)):
        var_dump($rsPrepare);
    endwhile;
    //header('Location: ../index.php');
}