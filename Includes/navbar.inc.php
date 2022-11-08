
<div class="navbar">
    <ul>
        <li><a href="index.php?page=home">Home</a></li>
        <?php
        if($_SESSION['role'] == '1') {
            echo '<li><a href="index.php?page=overviewadmin">Books - Overview(Admin)</a></li>';
        }
        ?>

        <li><a href="index.php?page=overviewcustomer">Books - Overview</a></li>
        <li><a href="index.php?page=mybooks">My books</a></li>


        <?php
        if($_SESSION['role'] == '1') {
            echo '<li class="dropdown">

            <a href="javascript:void(0)" class="dropbtn">Manage Books</a>
            <div class="dropdown-content">
                <a href="index.php?page=bookadd">Books - Add</a>
                <a href="index.php?page=bookedit">Books - Edit</a>
                <a href="index.php?page=booksprocessed">Books Processed</a>
                <a href="index.php?page=extrasedit">Genre & Language</a>
                
                </div>
                </li>
                <li><a href="index.php?page=users">User Management</a></li>
        ';
        }
        ?>

        <li style="float:right ; padding-right: 10px"><a href="index.php?page=logout">Logout</a></li>
        <li style="float:right ; padding-right: 10px"><a href="index.php?page=profile">Edit Profile</a></li>
    </ul>
</div>