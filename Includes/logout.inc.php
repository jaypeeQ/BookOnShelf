<?php

session_unset();
session_destroy();
?>
<div class="main-container">
<?php
echo '<h1 style="text-align: center">Thank you for using BookOnShelf!</h1>';
header('Refresh: 1; URL = index.php');
?>
</div>

