<!DOCTYPE>
<html>
<head>
    <link href="../CSS/style.css" rel="stylesheet">
</head>
<body>

<header><h1>Book on Shelf</h1></header>
<div class="register">
    <a href="login.inc.php"> <img src="../Images/book-on-shelf.png"> </a>
    <h1>Registration</h1>
    <p>
    <form method="post" action="../php/registerprocess.php">
        <p>
            <label>Username</label>
            <input type='text' name='user' placeholder='Username' required />
        </p>
        <p>
            <label>Password</label>
            <input type='password' name='pass' placeholder='Password' required />
        </p>

        <p>
            <label>First Name</label>
            <input type='text' name='fname' placeholder='First Name' required />
        </p>
        <p>
            <label>Tussenvoegsel</label>
            <input type='text' name='tname' placeholder='Tussenvoegsel' required />
        </p>
        <p>
            <label>Last Name</label>
            <input type='text' name='lname' placeholder='Last Name' required />
        </p>
        <p>
            <label>City</label>
            <input type='text' name='city' placeholder='City' required />
        </p>
        <p>
            <label>Street name</label>
            <input type='text' name='street' placeholder='Street name' required />
        </p>
        <p>
            <label>House Number</label>
            <input type='text' name='hnummer' placeholder='House number' required />
        </p>
        <p>
            <label>Post code</label>
            <input type='text' name='postcode' placeholder='Post code' required />
        </p>
        <p>
            <label>Email</label>
            <input type='text' name='email' placeholder='Email' required />
        </p>
        <p>
            <label>Date of Birth</label>
            <input type='date' name='birthdate' placeholder='Date of birth' required />
        </p>
        <p>
            <button type="submit" name="register">Login</button>
        </p>
    </form>
    </p>
</div>

</body>

</html>