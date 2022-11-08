
<div class="login">
    <a href="../Includes/login.inc.php"> <img src="Images/book-on-shelf.png"> </a>
    <h1>Login</h1>
    <?php
    if (!empty($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    ?>

    <p>
    <form method="POST" action="php/logincheck.php">

        <p>
            <label>Username</label>
            <input type='text' name='username' placeholder='Username' required />
        </p>
        <p>
            <label>Password</label>
            <input type='password' name='password' placeholder='Password' required />
        </p>
        <p>
            <button type="submit" name="login">Login</button>
        </p>
    </form>

    <form>
        <a link href="Includes/register.inc.php" style="float: right">No account?</a>
    </form>
    </p>
</div>