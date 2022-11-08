<?php
echo '<pre>', print_r($_POST), '</pre>';

if (isset($_POST['edited'])) {

    include '../../privateBoS/connection.php';

    $sql = 'UPDATE users SET username = :user, fname =:fname, tname=:tname, lname=:lname, city=:city, street=:street, hnummer=:hnummer, postcode=:postcode, email=:email, birthdate=:birthdate
        WHERE username =:username';

    $sth = $conn->prepare($sql);
    $sth->bindParam(':user', $_POST['user']);
    $sth->bindParam(':fname', $_POST['fname']);
    $sth->bindParam(':tname', $_POST['tname']);
    $sth->bindParam(':lname', $_POST['lname']);
    $sth->bindParam(':city', $_POST['city']);
    $sth->bindParam(':street', $_POST['street']);
    $sth->bindParam(':hnummer', $_POST['hnummer']);
    $sth->bindParam(':postcode', $_POST['postcode']);
    $sth->bindParam(':email', $_POST['email']);
    $sth->bindParam(':birthdate', $_POST['birthdate']);
    $sth->bindParam(':username', $_SESSION['username']);


    $sth->execute();
    while ($rsPrepare = $sth->fetch(PDO::FETCH_ASSOC)):
        echo '<pre>', print_r($_POST), '</pre>';

    endwhile;
    //header('Location: ../index.php');
}