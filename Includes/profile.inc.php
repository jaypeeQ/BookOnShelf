<?php


if (isset($_SESSION['logged_in'])) {
    include 'php/sessionlogincheck.php';

} else {
    header('refresh:0.00001;../index.php');
}

$sqlprofile = 'SELECT *, tbrole.role FROM users INNER JOIN tbrole ON users.roleid = tbrole.roleid WHERE username = :username';
$sthprofile = $conn->prepare($sqlprofile);
$sthprofile->bindParam(':username', $_SESSION['username']);

$sthprofile->execute();
while ($rsprofile = $sthprofile->fetch(PDO::FETCH_ASSOC)):{
    //var_dump($rsprofile); //For testing purposes

?>

<div class="main-container">
    <div class="sidebar">
        <form method="post">
            <button name="edit" type="submit">Edit profile</button>
            <button name="passchange" type="submit">Change Password</button>
        </form>
    <h3>Profile</h3>
        <div class="profilebar">
            <?php
            if (!isset($_POST['edit']) && !isset($_POST['passchange'])) {?>
            <table>
                <tr><td><label>Username: </label></td><td><?= $rsprofile['username'] ?></td></tr>
                <tr><td><label>Role: </label></td><td><?= $rsprofile['role'] ?></td></tr>
                <tr><td><label>Username: </label></td><td><?= $rsprofile['fname'] ?></td></tr>
                <tr><td><label>Role: </label></td><td><?= $rsprofile['tname'] ?></td></tr>
                <tr><td><label>Username: </label></td><td><?= $rsprofile['lname'] ?></td></tr>
                <tr><td><label>Role: </label></td><td><?= $rsprofile['city'] ?></td></tr>
                <tr><td><label>Username: </label></td><td><?= $rsprofile['street'] ?></td></tr>
                <tr><td><label>Role: </label></td><td><?= $rsprofile['hnummer'] ?></td></tr>
                <tr><td><label>Role: </label></td><td><?= $rsprofile['postcode'] ?></td></tr>
                <tr><td><label>Username: </label></td><td><?= $rsprofile['email'] ?></td></tr>
                <tr><td><label>Role: </label></td><td><?= $rsprofile['birthdate'] ?></td></tr>
            </table>
            <?php }elseif (isset($_POST['edit'])) {
            ?>
            <form method="post" action="php/profileedit.php">
                <p>
                    <label>Username</label>
                    <input type='text' name='user' placeholder='Username' value="<?= $rsprofile['username'] ?>" required />
                </p>
                <p>
                    <label>First Name</label>
                    <input type='text' name='fname' placeholder='First Name' value="<?= $rsprofile['fname'] ?>"required />
                </p>
                <p>
                    <label>Tussenvoegsel</label>
                    <input type='text' name='tname' placeholder='Tussenvoegsel' value="<?= $rsprofile['tname'] ?>"required />
                </p>
                <p>
                    <label>Last Name</label>
                    <input type='text' name='lname' placeholder='Last Name' value="<?= $rsprofile['lname'] ?>"required />
                </p>
                <p>
                    <label>City</label>
                    <input type='text' name='city' placeholder='City' value="<?= $rsprofile['city'] ?>"required />
                </p>
                <p>
                    <label>Street name</label>
                    <input type='text' name='street' placeholder='Street name' value="<?= $rsprofile['street'] ?>" required />
                </p>
                <p>
                    <label>House Number</label>
                    <input type='text' name='hnummer' placeholder='House number' value="<?= $rsprofile['hnummer'] ?>"required />
                </p>
                <p>
                    <label>Post code</label>
                    <input type='text' name='postcode' placeholder='Post code' value="<?= $rsprofile['postcode'] ?>"required />
                </p>
                <p>
                    <label>Email</label>
                    <input type='text' name='email' placeholder='Email' value="<?= $rsprofile['email'] ?>" required />
                </p>
                <p>
                    <label>Date of Birth</label>
                    <input type='date' name='birthdate' placeholder='Date of birth' value="<?= $rsprofile['birthdate'] ?>" required />
                </p>
                <p>
                    <button type="submit" name="edited" value="1">Edit</button>
                </p>
            </form>
            <?php }
            if (isset($_POST['passchange'])) { ?>
                <p>
                    <label>Password</label>
                    <input type='text' name='password' value="<?= $rsprofile['password'] ?>" required />
                </p>
            <?php } ?>

        </div>
    </div>
    <?php }endwhile;
    unset($_POST['edit']);
    ?>
    <div class="content-container">
        <div class="content">
            <?php
            if (isset($_POST['edit'])) {
                $sthprofile->execute();
            while ($rsprofile = $sthprofile->fetch(PDO::FETCH_ASSOC)):{
                ?>
            <!--<form method="post" action="../php/registerprocess.php">
                <p>
                    <label>Username</label>
                    <input type='text' name='user' placeholder='Username' value="<?/*= $rsprofile['username'] */?>" required />
                </p>
                <p>
                    <label>First Name</label>
                    <input type='text' name='fname' placeholder='First Name' value="<?/*= $rsprofile['fname'] */?>"required />
                </p>
                <p>
                    <label>Tussenvoegsel</label>
                    <input type='text' name='tname' placeholder='Tussenvoegsel' value="<?/*= $rsprofile['tname'] */?>"required />
                </p>
                <p>
                    <label>Last Name</label>
                    <input type='text' name='lname' placeholder='Last Name' value="<?/*= $rsprofile['lname'] */?>"required />
                </p>
                <p>
                    <label>City</label>
                    <input type='text' name='city' placeholder='City' value="<?/*= $rsprofile['city'] */?>"required />
                </p>
                <p>
                    <label>Street name</label>
                    <input type='text' name='street' placeholder='Street name' value="<?/*= $rsprofile['street'] */?>" required />
                </p>
                <p>
                    <label>House Number</label>
                    <input type='text' name='hnummer' placeholder='House number' value="<?/*= $rsprofile['hnummer'] */?>"required />
                </p>
                <p>
                    <label>Post code</label>
                    <input type='text' name='postcode' placeholder='Post code' value="<?/*= $rsprofile['postcode'] */?>"required />
                </p>
                <p>
                    <label>Email</label>
                    <input type='text' name='email' placeholder='Email' value="<?/*= $rsprofile['email'] */?>" required />
                </p>
                <p>
                    <label>Date of Birth</label>
                    <input type='date' name='birthdate' placeholder='Date of birth' value="<?/*= $rsprofile['birthdate'] */?>" required />
                </p>
                <p>
                    <button type="submit" name="register">Login</button>
                </p>
            </form>-->
            <?php
            }endwhile;
            }
            ?>
        </div>
        <div class="content">

        </div>
    </div>
</div>