<?php
if (isset($_SESSION['logged_in'])) {
    include 'php/sessionlogincheck.php';

} else {
    header('refresh:0.00001;../index.php');
}
?>
<div class="main-container">

    <div class="content-container">
        <div class="content">
            <?php

            include '../privateBoS/connection.php';

            $sql = 'SELECT books.title, books.stock_amount, books.bookinfo,books.page_amount, books.isbn, books.stock_amount, tbauthor.authorname, tbgenre.genre, tblang.language 
                    FROM (((books
                    INNER JOIN tbgenre ON books.genreid = tbgenre.genreid)
                    INNER JOIN tbauthor ON books.authorid = tbauthor.authorid)
                    INNER JOIN tblang on books.langid = tblang.langid)';
            $sth = $conn->prepare($sql);
            $sth->execute();

            while ($rsBooks = $sth->fetch(PDO::FETCH_ASSOC)):
                ?>
            <div class="book">
                <div class="book_image">
                    <img src="Images/The%20Snowy%20Day.jpg" style="height: 180px ; width: 180px">
                </div>
                <div class="book_overview_content">
                    <div class="book_overview_heading"><?php echo $rsBooks['title'] ?></div>
                    <div class="book_overview_author"><?php echo $rsBooks['authorname'] ?></div>
                    <div class="book_overview_description">
                        <?php if ($rsBooks['bookinfo'] == NULL) {
                            echo '<p>Book Description not available at this moment.</p>';
                        } else {
                            echo '<p>' . $rsBooks['bookinfo'] . '</p>';
                        } ?>
                    </div>
                    <div class="book_overview_pageamount">Pages = <?= $rsBooks['page_amount']?></div>
                    <div class="book_overview_stock_amount">Stock = <?= $rsBooks['stock_amount']?></div>

                    <div class="book_overview_button">
                        <?php
                        if ($rsBooks['stock_amount'] >= 0 + 1) {?>
                        <form method="post" action="php/bookborrowprocess.php">
                            <button name="borrow" value="1">borrow</button>
                            <input type="hidden" name="isbn" value="<?= $rsBooks['isbn']?>">
                        </form>
                        <?php }elseif ($rsBooks['stock_amount'] <= 0) {?>
                        <form method="post" action="php/bookreserveprocess.php">
                            <input type="hidden" name="isbn" value="<?= $rsBooks['isbn']?>">
                            <button name="reserve" value="1">reserve</button> <?php }?>
                        </form>


                    </div>
                </div>
            </div>
            <?php endwhile; ?>



        </div>
    </div>
</div>