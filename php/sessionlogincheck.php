<?php
if(!isset($_SESSION['logged_in'])) {
    if($_SESSION['logged_in'] == false) {
        header('Refresh: 0.1;../index.php');
    }
}