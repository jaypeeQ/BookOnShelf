<?php ?>
<div class="main-container">
 <div class="content">
            <div class="mini-table">
                <h1>Genre</h1>
                <table>
                    <?php
                    include '../privateBoS/connection.php';

                    $sqlgenrecheck = 'SELECT * FROM tbgenre';
                    $sthgenrecheck = $conn->prepare($sqlgenrecheck);
                    $sthgenrecheck->execute();

                    while ($rsgenrecheck = $sthgenrecheck->fetch(PDO::FETCH_ASSOC)): {
                        ?>
                        <tr><td><?= $rsgenrecheck['genreid']?></td>
                            <td><?= $rsgenrecheck['genre']?></td>
                            <td><form method="post" action="php/genreremove.php"><button name="genre" type="submit">Remove</button></td>
                            <input type="hidden" name="genreid" value="<?= $rsgenrecheck['genreid']?>"></form>
                        </tr>
                    <?php } endwhile; ?>
                </table>
                <form method="post" action=""><button name="addgenre" type="submit">Add</button></form>
                <?php if (isset($_POST['addgenre'])) { ?>
                    <form method="post" action="php/genreadd.php">
                        <label>Genre: </label><input type="text" name="genrename" placeholder="Genre name">
                    <button type="submit">Add</button></form>
                    <?php } ?>
            </div>
        </div>
        <div class="content">
            <div class="mini-table">
            <h1>Languages</h1>
            <table>
                <?php
                include '../privateBoS/connection.php';

                $sqllangcheck = 'SELECT * FROM tblang';
                $sthlangcheck = $conn->prepare($sqllangcheck);
                $sthlangcheck->execute();

                while ($rslangcheck = $sthlangcheck->fetch(PDO::FETCH_ASSOC)): {
                    ?>
                    <tr>
                        <td><?= $rslangcheck['langid']?></td>
                        <td><?= $rslangcheck['language']?></td>
                        <td><form method="post" action="php/langremove.php"><button name="lang" type="submit">Remove</button></td>
                        <input type="hidden" name="langid" value="<?= $rslangcheck['langid']?>"></form>
                    </tr>
                <?php } endwhile; ?>
            </table>
                <form method="post" action=""><button name="addlang" type="submit">Add</button></form>

                <?php if (isset($_POST['addlang'])) { ?>
                    <form method="post" action="php/langadd.php">
                        <label>Language: </label><input type="text" name="langname" placeholder="Language name">
                        <button type="submit">Add</button></form>
                <?php } ?>
            </div>
        </div>
</div>