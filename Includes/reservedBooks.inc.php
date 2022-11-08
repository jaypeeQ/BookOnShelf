<?php
require_once '../privateBoS/connection.php';

if (isset($_SESSION['logged_in'])) {
    include 'php/sessionlogincheck.php';

} else {
    header('refresh:0.00001;../index.php');
}

$sqlprofile = 'SELECT title, isbn FROM books';
$sthprofile = $conn->prepare($sqlprofile);
$sthprofile->execute();
?>

<div class="main-container">
    <div class="sidebar">
        <form method="post">
            <label for="profile">Book Title</label>
            <select name="userprofile" id="title">
                <?php while ($row = $sthprofile->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $row['isbn'] ?>"><?= $row['title'] ?></option>
                <?php endwhile ?>
            </select>
            <button type="submit">Submit</button>
        </form>
    </div>
    <div class="content-container">
        <div class="content">

        </div>
        <div class="content">

        </div>
    </div>
</div>