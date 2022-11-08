<?php
?>
<div class="main-container">
    <div class="welcome-page">


    </div>
    <div class="content-container">
        <div class="content">

        </div>
        <div class="content">
<!--            --><?php //var_dump($_SESSION);?>
        </div>
        <div class="content">
            <h1>My borrowed books</h1>
            <?php

            include '../privateBoS/connection.php';

            $sql = 'SELECT books.title, books.stock_amount, books.bookinfo,books.page_amount, books.isbn, books.stock_amount, tbauthor.authorname, tbgenre.genre, tblang.language, xborrowed.username 
                    FROM (((books
                    INNER JOIN tbgenre ON books.genreid = tbgenre.genreid)
                    INNER JOIN tbauthor ON books.authorid = tbauthor.authorid)
                    INNER JOIN tblang on books.langid = tblang.langid)
                    INNER JOIN xborrowed on xborrowed.isbn = books.isbn
                    WHERE xborrowed.username = :user';

            $sth = $conn->prepare($sql);
            $sth->bindParam(':user', $_SESSION['username']);

            $sth->execute();

            while ($rsMybooks = $sth->fetch(PDO::FETCH_ASSOC)):
                ?>
                <div class="book">
                    <div class="book_image">
                        <img src="Images/The%20Snowy%20Day.jpg" style="height: 180px ; width: 180px">
                    </div>
                    <div class="book_overview_content">
                        <div class="book_overview_heading"><?php echo $rsMybooks['title'] ?></div>
                        <div class="book_overview_author"><?php echo $rsMybooks['authorname'] ?></div>
                        <div class="book_overview_description">
                            <?php if ($rsMybooks['bookinfo'] == NULL) {
                                echo '<p>Book Description not available at this moment.</p>';
                            } else {
                                echo '<p>' . $rsMybooks['bookinfo'] .'</p>';
                            } ?>
                        </div>
                        <div class="book_overview_pageamount">Pages = <?= $rsMybooks['page_amount']?></div>
                        <div class="book_overview_button">
                                <form method="post" action="php/bookreturnprocess.php">
                                    <button name="borrow" value="1">return</button>
                                    <input type="hidden" name="isbn" value="<?= $rsMybooks['isbn']?>">
                                </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>



        </div>
    </div>
        <div class="content-container">
        <div class="content">
            <h1>My reserved books</h1>
            <?php

            include '../privateBoS/connection.php';

            $sql = 'SELECT books.title, books.stock_amount, books.bookinfo,books.page_amount, books.isbn, books.stock_amount, tbauthor.authorname, tbgenre.genre, tblang.language, xreserved.username, xreserved.reservedate 
                    FROM (((books
                    INNER JOIN tbgenre ON books.genreid = tbgenre.genreid)
                    INNER JOIN tbauthor ON books.authorid = tbauthor.authorid)
                    INNER JOIN tblang on books.langid = tblang.langid)
                    INNER JOIN xreserved on xreserved.isbn = books.isbn
                    WHERE xreserved.username = :user';

            $sth = $conn->prepare($sql);
            $sth->bindParam(':user', $_SESSION['username']);

            $sth->execute();

            while ($rsMybooks = $sth->fetch(PDO::FETCH_ASSOC)):
                ?>
                <div class="book">
                    <div class="book_image">
                        <img src="Images/The%20Snowy%20Day.jpg" style="height: 180px ; width: 180px">
                    </div>
                    <div class="book_overview_content">
                        <div class="book_overview_heading"><?php echo $rsMybooks['title'] ?></div>
                        <div class="book_overview_author"><?php echo $rsMybooks['authorname'] ?></div>
                        <div class="book_overview_description">
                            <?php
                            echo $rsMybooks['reservedate'];
                            if ($rsMybooks['bookinfo'] == NULL) {
                                echo '<p>Book Description not available at this moment.</p>';
                            } else {
                                echo '<p>' . $rsMybooks['bookinfo'] . '</p>';
                            } ?>
                        </div>
                        <div class="book_overview_pageamount">Pages = <?= $rsMybooks['page_amount']?></div>
                        <div class="book_overview_button">

                            <form method="post" action="php/bookreservenotified.php"><?php
                            $sqlnotify = 'SELECT users.username, books.title, books.isbn
                                            FROM notifyreserved 
                                              INNER JOIN users ON notifyreserved.userid = users.userid
                                              INNER JOIN books ON books.isbn = notifyreserved.isbn';
                                        $sth = $conn->prepare($sqlnotify);
                                        $sth->execute();
                                        while ($rsNotify = $sth->fetch(PDO::FETCH_ASSOC)): {
                                            if (($rsNotify['username'] == $_SESSION['username']) && ($rsNotify['isbn']) == $rsMybooks['isbn']) {?>
                                                <input type="hidden" name="isbn" value="<?= $rsMybooks['isbn']?>">
                                                <button name="borrow" value="1">borrow</button>
<!--                                            <?php }
                                        } endwhile;?>

                                    <input type="hidden" name="isbn" value="<?= $rsMybooks['isbn']?>">
                                </form>


                        </div>
                    </div>
                </div>
            <?php endwhile; ?>



        </div>
        </div>
    </div>
</div>
