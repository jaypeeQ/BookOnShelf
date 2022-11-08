<?php
if(isset($_SESSION['logged_in'])) {
    include 'php/sessionlogincheck.php';

}else {
    header('refresh:0.00001;../index.php');
}
?>
<div class="main-container">

    <div class="content-container">
        <div class="content">
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
                    <!--<th>Edit</th>-->
                    <th>Remove</th>
                </tr>
                <?php
                include '../privateBoS/connection.php';

                $sql = 'SELECT books.title, books.isbn, books.stock_amount, books.page_amount, tbauthor.authorname, tbgenre.genre, tblang.language, books.xreserved, books.xborrowed
                    FROM (((books
                    INNER JOIN tbgenre ON books.genreid = tbgenre.genreid)
                    INNER JOIN tbauthor ON books.authorid = tbauthor.authorid)
                    INNER JOIN tblang on books.langid = tblang.langid)';
                $sth = $conn->prepare($sql);
                $sth->execute();

                while ($rsBooks = $sth->fetch(PDO::FETCH_ASSOC)):
                ?>
                <tr>
                <td><?php echo $rsBooks['title'] ?></td>
                    <td><?php echo $rsBooks['authorname'] ?></td>
                    <td><?php echo $rsBooks['page_amount'] ?></td>
                    <td><?php echo $rsBooks['genre'] ?></td>
                    <td><?php echo $rsBooks['language'] ?></td>
                    <td><?php echo $rsBooks['stock_amount'] ?></td>
                    <td><?php echo $rsBooks['xborrowed'] ?></td>
                    <td><?php echo $rsBooks['xreserved'] ?></td>
                    <!--<td><form action="index.php?page=bookedit" method="post"  name="isbn" value="<?php /*echo $rsBooks['isbn'] */?>"><button >edit</button></form></td>-->
                    <td><form action="php/bookremoveprocess.php" method="post" ><button name="isbn" value="<?php echo $rsBooks['isbn'] ?>">remove</button></form></td>
                </tr>
                <?php endwhile ?>

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