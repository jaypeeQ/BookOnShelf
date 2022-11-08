<?php

session_start();
include '../../privateBoS/connection.php';
echo $_POST['isbn'];
echo $_SESSION['username'];
//selects books reserved with the same isbn as books returned
$sqlprocess = 'SELECT reservedate, xreserved.isbn, username 
               FROM xreserved 
                   WHERE xreserved.isbn = :isbn';
$sthprocess = $conn->prepare($sqlprocess);
$sthprocess->bindParam(':isbn', $_POST['isbn']);
$sthprocess->execute();
while ($rsEarliestDate = $sthprocess->fetch(PDO::FETCH_ASSOC)): {
    if ($rsEarliestDate != NULL) {
        $EarliestDate = $rsEarliestDate['reservedate'];
        var_dump($rsEarliestDate);

        //if the book isnt in the reserved table, deletes the row.
            echo 'else statement worked';
            //Declares timestamp to a local variable
            $rsNotifyDate = $rsEarliestDate['reservedate'];
            $sqlreturndelete = 'DELETE FROM xborrowed WHERE isbn = :isbn AND username = :username';
            $sthreturndelete = $conn->prepare($sqlreturndelete);
            $sthreturndelete->bindParam(':isbn', $_POST['isbn']);
            $sthreturndelete->bindParam(':username', $_SESSION['username']);
            $sthreturndelete->execute();
            echo 'successfully deleted row';

            //Declared old data locally
            $sqlreturnselect = 'SELECT isbn, users.userid, MIN(reservedate)
                        FROM xreserved 
                            INNER JOIN users ON xreserved.username = users.username 
                        WHERE isbn = :isbn AND xreserved.username = :username';
            $sthreturnselect = $conn->prepare($sqlreturnselect);
            $sthreturnselect->bindParam(':isbn', $_POST['isbn']);
            $sthreturnselect->bindParam(':username', $rsEarliestDate['username']);
            $sthreturnselect->execute();
            while ($rsReturnDate = $sthreturnselect->fetch(PDO::FETCH_ASSOC)): {
                $oldisbn = $rsReturnDate['isbn'];
                $olduserid = $rsReturnDate['userid'];

                //if a book does exist, inserts into notifyreserved table, for further use.

                $sqlnotify = 'INSERT INTO notifyreserved VALUES (:isbn2, :userid, :EarliestDate)';
                $sthnotify = $conn->prepare($sqlnotify);
                $sthnotify->bindParam(':isbn2', $oldisbn);
                $sthnotify->bindParam(':userid', $olduserid);
                $sthnotify->bindParam(':EarliestDate', $EarliestDate);
                $sthnotify->execute();
            }endwhile;

    }
}endwhile;
echo $EarliestDate;
if ($rsEarliestDate == NULL) {
    $sqlprocess = 'SELECT stock_amount 
               FROM books 
                   WHERE isbn = :isbn';
    $sthprocess = $conn->prepare($sqlprocess);
    $sthprocess->bindParam(':isbn', $_POST['isbn']);
    $sthprocess->execute();
    while ($rsOldamount = $sthprocess->fetch(PDO::FETCH_ASSOC)): {
        $oldamount = $rsOldamount['stock_amount'];
        echo 'Row ' . $_POST['isbn'] . ' deleted successfully';
        $sqlreturndelete = 'DELETE FROM xborrowed WHERE isbn = :isbn AND username = :username';
        $sthreturndelete = $conn->prepare($sqlreturndelete);
        $sthreturndelete->bindParam(':isbn', $_POST['isbn']);
        $sthreturndelete->bindParam(':username', $_SESSION['username']);
        $sthreturndelete->execute();
//Adds back the borrowed book back to stock amount of books in inventory
        $newamount = $oldamount + 1;
        $sqlreturnedbook = 'UPDATE books SET stock_amount = :newamount WHERE isbn = :isbn';
        $sthreturnedbook = $conn->prepare($sqlreturnedbook);
        $sthreturnedbook->bindParam(':isbn', $_POST['isbn']);
        $sthreturnedbook->bindParam(':newamount', $newamount);
        $sthreturnedbook->execute();
    }endwhile;
    }






//var_dump($rsReturnDate);

//header('Location: ../index.php');
