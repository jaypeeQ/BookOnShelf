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
            <h1>Books Borrowed</h1>
            <table>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Number in stock</th>
                    <th>User borrowed</th>
                </tr>

                    <?php
                    include '../privateBoS/connection.php';

                    $sql = 'SELECT xborrowed.isbn, xborrowed.title, username, tbauthor.authorname, stock_amount
                            FROM xborrowed 
                                INNER JOIN books ON xborrowed.isbn = books.isbn 
                                INNER JOIN tbauthor ON books.authorid = tbauthor.authorid';
                    $sth = $conn->prepare($sql);
                    $sth->execute();
                    while ($rsBorrowed = $sth->fetch(PDO::FETCH_ASSOC)):{?>
                <tr>
                        <td><?= $rsBorrowed['isbn']?></td>
                        <td><?= $rsBorrowed['title']?></td>
                        <td><?= $rsBorrowed['authorname']?></td>
                        <td><?= $rsBorrowed['stock_amount']?></td>
                        <td><?= $rsBorrowed['username']?></td>
                </tr>
<?php }endwhile; ?>
            </table>
        </div>
        <div class="content">
            <h1>Books Reserved</h1>
            <table>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Number borrowed</th>
                    <th>User reserved</th>
                    <th>Date reserved</th>

                </tr>

                <?php
                include '../privateBoS/connection.php';

                    $sql = 'SELECT xreserved.isbn, xreserved.title, username, tbauthor.authorname, books.xborrowed, reservedate
                            FROM xreserved 
                                INNER JOIN books ON xreserved.isbn = books.isbn 
                                INNER JOIN tbauthor ON books.authorid = tbauthor.authorid';
                    $sth = $conn->prepare($sql);
                    $sth->execute();
                    while ($rsReserve = $sth->fetch(PDO::FETCH_ASSOC)):{?>
                    <tr>
                        <td><?= $rsReserve['isbn']?></td>
                        <td><?= $rsReserve['title']?></td>
                        <td><?= $rsReserve['authorname']?></td>
                        <td><?= $rsReserve['xborrowed']?></td>
                        <td><?= $rsReserve['username']?></td>
                        <td><?= $rsReserve['reservedate']?></td>

                    </tr>
                <?php }endwhile; ?>
        </div>
    </div>
</div>