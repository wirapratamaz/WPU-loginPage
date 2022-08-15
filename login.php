<?php
    if( isset($_POST["submit"]) ) {
        // cek username & password
        if( $_POST["email"] == "admin@admin" && $_POST["password"] == "123" ) {
        // jika benar, redirect ke halaman admin
            header("Location: admin.php");
            exit;
        } else {
        // jika salah, tampilkan pesan kesalahan
            $error = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGE LOGIN</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    if( isset($error) ) : 
	echo "<script>alert('Woops! Email Atau Password anda Salah.')</script>";
    endif; 
?>

    <div class="container">
        <form action="" method="post" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800">Login</p>
            <div class="input-group">
                <input type="email" name="email">
            </div>
            <div class="input-group">
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Tidak mempunyai akun? <a href="#">Daftar Disini</p>
        </form>
    </div>    

</body>
</html>