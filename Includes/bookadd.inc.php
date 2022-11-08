<?php
if (isset($_SESSION['logged_in'])) {
    include 'php/sessionlogincheck.php';

} else {
    header('refresh:0.00001;../index.php');
}
?>

<div class="main-container">
    <div class="sidebar">


        <label style="font-variant: small-caps">Book add</label>
        <form action="php/bookaddprocess.php" method="post">
            <input type="text" name="title" placeholder="Title">
            <?php
            // Select statement for select->option not working. find solution.
            include '../privateBoS/connection.php';

            $sqlauthor = 'SELECT * FROM tbauthor';
            $sth = $conn->prepare($sqlauthor);
            $sth->execute();
            ?>
            <select name="author" id="author">
                <?php  while ($rsAuthor = $sth->fetch(PDO::FETCH_ASSOC)):{
                    $author = $rsAuthor['authorname'];
                    echo '<option value="'.$rsAuthor['authorid'].'">'.$author.'</option>';
                }

                endwhile ?>
            </select>
            <?php
            // Select statement for select->option not working. find solution.
            include '../privateBoS/connection.php';

            $sqlgenre = 'SELECT * FROM tbgenre';
            $sth = $conn->prepare($sqlgenre);
            $sth->execute();
            ?>
            <select name="genre" id="genre">
                <?php  while ($rsGenre = $sth->fetch(PDO::FETCH_ASSOC)):{
                    $genre = $rsGenre['genre'];
                    echo '<option value="'.$rsGenre['genreid'].'">'.$genre.'</option>';
                }

                endwhile ?>
            </select>

            <?php
            // Select statement for select->option not working. find solution.
            include '../privateBoS/connection.php';

            $sqllang = 'SELECT * FROM tblang';
            $sth = $conn->prepare($sqllang);
            $sth->execute();
            ?>
            <select name="language" id="language">
                <?php  while ($rsLang = $sth->fetch(PDO::FETCH_ASSOC)):{
                    $language = $rsLang['language'];

                    echo '<option value="'.$rsLang['langid'].'">'.$language.'</option>';
                }

                endwhile ?>
            </select>
            <input type="number" name="pages" min="0" placeholder="Pages">

            <input type="number" name="stock" min="0" placeholder="Books in stock">
            <textarea name="bookinfo" placeholder="Write something.." style="height:200px;width: 177px"></textarea>
            <?php ?>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <div class="content-container">
        <div class="first-content">
            <table>
                <tr>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Pages</th>
                    <th>Genre</th>
                    <th>Language</th>
                    <th>Number in stock</th>
                    <th>Number borrowed</th>
                    <th>Number reserved</th>

                </tr>
                <?php
                include '../privateBoS/connection.php';

                $sql = 'SELECT books.title, books.stock_amount, books.page_amount, tbauthor.authorname, tbgenre.genre, tblang.language 
                    FROM (((books
                    INNER JOIN tbgenre ON books.genreid = tbgenre.genreid)
                    INNER JOIN tbauthor ON books.authorid = tbauthor.authorid)
                    INNER JOIN tblang on books.langid = tblang.langid)';
                $sth = $conn->prepare($sql);
                $sth->execute();

                while ($rsBooks = $sth->fetch(PDO::FETCH_ASSOC)):{

                    echo '<tr>';
                    echo '<td>' . $rsBooks['title'] . '</td>';
                    echo '<td>' . $rsBooks['authorname'] . '</td>';
                    echo '<td>' . $rsBooks['page_amount'] . '</td>';
                    echo '<td>' . $rsBooks['genre'] . '</td>';
                    echo '<td>' . $rsBooks['language'] . '</td>';
                    echo '<td>' . $rsBooks['stock_amount'] . '</td>';
                    echo '<td>' . $rsBooks['title'] . '</td>';
                    echo '<td>' . $rsBooks['title'] . '</td>';
                    echo '</tr>';
                }endwhile ?>

                <tr>
                    <td>Book Name</td>
                    <td>Author</td>
                    <td>Pages</td>
                    <td>Genre</td>
                    <td>Number in stock</td>
                    <td>Number borrowed</td>
                    <td>Number reserved</td>

                </tr>

            </table>
        </div>
        <div class="content">

        </div>
    </div>
</div>
