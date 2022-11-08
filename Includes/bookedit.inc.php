<?php
//if(isset($_SESSION['logged_in'])) {
//    include 'php/sessionlogincheck.php';
//
//}else {
//    header('refresh:0.00001;../index.php');
//}

require_once '../privateBoS/connection.php';

?>

<div class="main-container">
    <div class="sidebar">
        <h4>Edit Book</h4>


        <?php
        // Select statement for select->option not working. find solution.

        $sqltitle = 'SELECT title, isbn FROM books';
        $sth = $conn->prepare($sqltitle);
        $sth->execute();
        ?>
        <form method="post">
            <label for="title">Book Title</label>
            <select name="isbn" id="title">
                <?php while ($row = $sth->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $row['isbn'] ?>"><?= $row['title'] ?></option>
                <?php endwhile ?>
            </select>
            <button type="submit">Submit</button>
        </form>
        <form method="post" action="php/bookeditprocess.php">
            <?php

            $sql = 'SELECT books.title, books.isbn, books.stock_amount, books.page_amount, books.bookinfo, tbauthor.authorname, tbgenre.genre, tblang.language, books.xborrowed, books.xreserved
                    FROM (((books
                    INNER JOIN tbgenre ON books.genreid = tbgenre.genreid)
                    INNER JOIN tbauthor ON books.authorid = tbauthor.authorid)
                    INNER JOIN tblang on books.langid = tblang.langid)
                    WHERE books.isbn = :isbn';
            $sth = $conn->prepare($sql);
            $sth->bindParam(':isbn', $_POST['isbn']);
            $sth->execute();

            while ($rsBooks = $sth->fetch(PDO::FETCH_ASSOC)): {
            ?>
            <div class="editmenu">
            <label>Title: </label>
            <input type="text" name="title" value="<?php echo $rsBooks['title'] ?>" style="float:right">
            </div>
            <?php
            // Select statement for select->option not working. find solution.
            include '../privateBoS/connection.php';

            $sqlauthor = 'SELECT * FROM tbauthor';
            $sth = $conn->prepare($sqlauthor);
            $sth->execute();
            ?>
            <div class="editmenu">
                    <label>Author: </label><input type="text" name="author" value="<?= $rsBooks['authorname']?>" style="float:right">
                </div>
                <div class="editmenu">
            <label>Pages: </label><input type="number" name="pages" min="0" value="<?php echo $rsBooks['page_amount'] ?>" style="float:right">
                </div>
            <?php
            // Select statement for select->option not working. find solution.
            include '../privateBoS/connection.php';

            $sqlgenre = 'SELECT * FROM tbgenre';
            $sth = $conn->prepare($sqlgenre);
            $sth->execute();
            ?>
                <div class="editmenu">
            <label>Genre: </label><select name="genre" id="genre" style="float:right">
                <?php  while ($rsGenre = $sth->fetch(PDO::FETCH_ASSOC)):{
                    $genre = $rsGenre['genre'];?>
                <optgroup label="Selected">
                    <option value="<?= $rsGenre['genreid']?>"><?= $rsBooks['genre']?></option>
                </optgroup>
                <optgroup label="Available">
                    <?php while ($rsGenre = $sth->fetch(PDO::FETCH_ASSOC)):{
                        $genre = $rsGenre['genre'];
                        ?>
                        <option value="<?=$rsGenre['genreid']?>"><?=$rsGenre['genre']?></option>
                    <?php
                    }endwhile;
                    echo '</optgroup>';
                    }
                    endwhile ?>
            </select>
                </div>
            <?php
            // Select statement for select->option not working. find solution.
            include '../privateBoS/connection.php';
            $sqllang = 'SELECT * FROM tblang';
            $sth = $conn->prepare($sqllang);
            $sth->execute();
            ?>
                <div class="editmenu">
            <label>Language: </label><select name="lang" id="language" style="float:right">
                <?php  while ($rsLang = $sth->fetch(PDO::FETCH_ASSOC)):{
                    $language = $rsLang['language'];?>
                    <optgroup label="Selected">
                        <option value="<?= $rsLang['langid']?>"><?= $rsBooks['language']?></option>
                    </optgroup>
                          <optgroup label="Available">
                     <?php while ($rsLang = $sth->fetch(PDO::FETCH_ASSOC)):{
                        $language = $rsLang['language']?>
                        <option value="<?=$rsLang['langid']?>"><?=$rsLang['language']?></option>
                    <?php }endwhile;
                        echo '</optgroup>';
                }
                endwhile ?>
            </select>
                </div>
                <div class="editmenu">
                    <label>Stock: </label><input type="number" name="stock" min="0" value="<?php echo $rsBooks['stock_amount'] ?>" style="float:right">
                </div>
                <div class="editmenu">
                    <input type="hidden" name="isbn" value="<?=  $rsBooks['isbn']?>" style="float:right">
                </div>
                <div class="editmenu">
                    <label>Number borrowed: </label><input type="number" name="xborrowed" min="0" value="<?= $rsBooks['xborrowed']?>" style="float:right">
                </div>
                <div class="editmenu">
                    <label>Number reserved: </label><input type="number" name="xreserved" min="0" value="<?= $rsBooks['xreserved']?>" style="float:right">
                </div>
                <div class="editmenu">
                    <label>Book information: </label></div>
                <div class="editmenu">
                <textarea name="info" rows="10" cols="45" ><?= $rsBooks['bookinfo'] ?></textarea>
                </div class="editmenu">
            <button type="submit" name="submit" >Submit</button>

        </form>
        <?php
        }endwhile;
        ?>
    </form>
    </div>
    <div class="content-container">
        <div class="content-container">
            <div class="content">
                <?php

                include '../privateBoS/connection.php';

                $sql = 'SELECT books.title, books.stock_amount, books.bookinfo,books.page_amount, books.isbn, books.stock_amount, tbauthor.authorname, tbgenre.genre, tblang.language 
                    FROM (((books
                    INNER JOIN tbgenre ON books.genreid = tbgenre.genreid)
                    INNER JOIN tbauthor ON books.authorid = tbauthor.authorid)
                    INNER JOIN tblang on books.langid = tblang.langid)
                    WHERE books.isbn = :isbn';
                $sth = $conn->prepare($sql);
                $sth->bindParam(':isbn', $_POST['isbn']);

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
                        </div>
                    </div>
                <?php endwhile; ?>



            </div>
        </div>

    </div>
</div>
