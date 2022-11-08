<?php

include '../../privateBoS/connection.php';
echo '<pre>', print_r($_POST), '</pre>';

$sqlSelect = 'SELECT *, tbrole.roleid FROM users
                    INNER JOIN tbrole ON tbrole.roleid = users.roleid
                    WHERE users.userid = :userid';
$sthSelect = $conn->prepare($sqlSelect);
$sthSelect->bindParam(':userid', $_POST['userid']);
$sthSelect->execute();
while ($rsUsers = $sthSelect->fetch(PDO::FETCH_ASSOC)): {

    $sqlUpdate = "UPDATE users 
                  SET username = :username, password = :password, roleid = :roleid, 
                      fname = :fname, tname = :tname, lname = :lname, city = :city, street = :street, 
                      hnummer = :hnummer, postcode = :postcode, email = :email, birthdate = :birthdate 
                            WHERE userid = :userid";
    $sthUpdate = $conn->prepare($sqlUpdate);
    $sthUpdate->bindParam(':username', $_POST['username']);
    $sthUpdate->bindParam(':password', $_POST['password']);
    $sthUpdate->bindParam(':roleid', $_POST['roleid']);
    $sthUpdate->bindParam(':fname', $_POST['fname']);
    $sthUpdate->bindParam(':tname', $_POST['tname']);
    $sthUpdate->bindParam(':lname', $_POST['lname']);
    $sthUpdate->bindParam(':city', $_POST['city']);
    $sthUpdate->bindParam(':street', $_POST['street']);
    $sthUpdate->bindParam(':hnummer', $_POST['hnummer']);
    $sthUpdate->bindParam(':postcode', $_POST['postcode']);
    $sthUpdate->bindParam(':email', $_POST['email']);
    $sthUpdate->bindParam(':birthdate', $_POST['birthdate']);
    $sthUpdate->bindParam(':userid', $_POST['userid']);
    $sthUpdate->execute();
    $user = $rsUsers['username'];
}endwhile;
echo '<pre>', $rsUsers, '</pre>';
$_SESSION['message'] = 'You have successfully edited '.$user.' profile.';
header('Location: ../index.php');