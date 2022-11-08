<?php

include '../privateBoS/connection.php';
?>
<div class="main-container">

    <div class="content-container">
        <?php
        if (!isset($_POST['edit'])) { ?>

        <div class="content">
            <table>

                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>First Name</th>
                    <th>Insertion</th>
                    <th>Last Name</th>
                    <th>City</th>
                    <th>Street</th>
                    <th>House number</th>
                    <th>Postcode</th>
                    <th>Email</th>
                    <th>Birth Date</th>
                    <th>Edit</th>
                    <th>Delete</th>


                </tr>

                <?php
                $sql = 'SELECT *, tbrole.role FROM users INNER JOIN tbrole ON users.roleid = tbrole.roleid';
                $sth = $conn->prepare($sql);
                $sth->execute();
                while ($rsUsers = $sth->fetch(PDO::FETCH_ASSOC)):
                    ?>
                <tr>

                <td><?php echo $rsUsers['userid'] ?></td>
                    <td><?php echo $rsUsers['username'] ?></td>
                    <td><?php echo $rsUsers['role'] ?></td>
                    <td><?php echo $rsUsers['fname'] ?></td>
                    <td><?php echo $rsUsers['tname'] ?></td>
                    <td><?php echo $rsUsers['lname'] ?></td>
                    <td><?php echo $rsUsers['city'] ?></td>
                    <td><?php echo $rsUsers['street'] ?></td>
                    <td><?php echo $rsUsers['hnummer'] ?></td>
                    <td><?php echo $rsUsers['postcode'] ?></td>
                    <td><?php echo $rsUsers['email'] ?></td>
                    <td><?php echo $rsUsers['birthdate'] ?></td>

                    <td><form action="" method="post" name="edit"><button name="edit">edit</button>
                        <input type="hidden" name="userid" value="<?= $rsUsers['userid'] ?>"></form></td>
                    <td><form action="php/userremoveprocess.php" method="post" ><button name="userid" value="><?= $rsUsers['userid'] ?>">remove</button></form></td>
                </tr>
                <?php endwhile ?>
            </table>
        </div>
        <div class="content">
            <?php }
        if (isset($_POST['edit'])) {
            $sql = 'SELECT *, tbrole.role FROM users INNER JOIN tbrole ON users.roleid = tbrole.roleid WHERE userid = :userid';
            $sth = $conn->prepare($sql);
            $sth->bindParam(":userid", $_POST['userid']);
            $sth->execute();
            while ($rsUsers2 = $sth->fetch(PDO::FETCH_ASSOC)): { ?>
            <form method="post" action="php/usereditprocess.php">
                <div class="editmenu">
                    <label>Username: </label><input type="text" name="username" value="<?php echo $rsUsers2['username'] ?>">
                </div>

                <?php
                // Select statement for select->option not working. find solution.
                include '../privateBoS/connection.php';
                $sqlrole = 'SELECT * FROM tbrole';
                $sthrole = $conn->prepare($sqlrole);
                $sthrole->execute();
                ?>
                <div class="editmenu">
                    <label>Role: </label><select name="roleid" id="role">
                            <?php while ($rsRole = $sthrole->fetch(PDO::FETCH_ASSOC)):{?>
                                <option value="<?=$rsRole['roleid']?>"><?=$rsRole['role']?></option>
                            <?php }endwhile;
                            ?>
                    </select>
                </div>

                <div class="editmenu">
                    <label>First Name: </label><input type="text" name="fname" value="<?php echo $rsUsers2['fname'] ?>">
                </div>

                <div class="editmenu">
                    <label>Insertion: </label><input type="text" name="tname" value="<?php echo $rsUsers2['tname'] ?>">
                </div>

                <div class="editmenu">
                    <label>Last Name: </label><input type="text" name="lname" value="<?php echo $rsUsers2['lname'] ?>">
                </div>

                <div class="editmenu">
                    <label>City: </label><input type="text" name="city" value="<?php echo $rsUsers2['city'] ?>">
                </div>

                <div class="editmenu">
                    <label>Street: </label><input type="text" name="street" value="<?php echo $rsUsers2['street'] ?>">
                </div>

                <div class="editmenu">
                    <label>House number: </label><input type="text" name="hnummer" value="<?php echo $rsUsers2['hnummer'] ?>">
                </div>

                <div class="editmenu">
                    <label>Postcode: </label><input type="text" name="postcode" value="<?php echo $rsUsers2['postcode'] ?>">
                </div>

                <div class="editmenu">
                    <label>Email: </label><input type="text" name="email" value="<?php echo $rsUsers2['email'] ?>">
                </div>

                <div class="editmenu">
                    <label>Birthdate: </label><input type="date" name="birthdate" value="<?php echo $rsUsers2['birthdate'] ?>">
                </div>

                <div class="editmenu">
                    <label>Password: </label><input type="text" name="password" value="<?php echo $rsUsers2['password'] ?>">
                </div>
                <input type="hidden" name="userid" value="<?= $rsUsers2['userid'] ?>">
                <button type="submit">Submit</button>
            </form>
                <form method="post"><button name="back">Back</button></form>

            <?php }endwhile;
        }

        if (isset($_POST['back'])) {
            unset($_POST['edit']);
        }
            ?>
        </div>
    </div>
</div>