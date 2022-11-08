<?php
if(isset($_SESSION['logged_in'])) {
    include 'php/sessionlogincheck.php';

}else {
    header('refresh: 0.1;../index.php');
}
?>
<div class="main-container">
    <div class="welcome-page">

    </div>
    <div class="content-container">
        <div class="content">
            <h1 style="text-align: center;"><?php
                if(isset($_SESSION['message'])) {
                    if ($_SESSION['message'] != NULL) {
                        echo $_SESSION['message'];
                    }else
                        echo 'Welcome to Book on shelf!';
                }
                 ?></h1>
        </div>
        <div class="content">

        </div>
    </div>
</div>