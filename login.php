<?php 
//jalankan session
session_start();

//Kalau sudah login tidak perlu ke login lagi
if ( isset($_SESSION["login"]) ){
    header("Location: index.php");
    exit;
}

require 'functions.php';
// cek apakah tombol login sudah tekan atau belum
if( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    //cek apakah ada baris yg dikembalikan
    if( mysqli_num_rows($result) === 1 ) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {// password yg input, password yg diacak
			//*set session
            $_SESSION["login"] = true;

            header("Location: index.php");
			exit;
		}
	}

    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Halaman Login</h1>
    
<?php if( isset($error) ) : ?>
	<p style="color: red; font-style: italic;">username / password salah!</p>
<?php endif; ?>

    <ul>
    <form action="" method="post">
        <li>
            <label for="username">Username :</label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <button type="submit" name="login">Login</button>
        </li>
    </form>    
    </ul>
</body>
</html>