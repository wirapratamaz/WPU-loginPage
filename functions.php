<?php
//*koneksi database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query){
    //connect database
    global $conn; //mengacu pada coon yg diluar scope function
    $result = mysqli_query($conn, $query);
    $rows = [];//penampung
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $conn;

    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $query = "INSERT INTO mahasiswa
                VALUES('', '$nim', '$nama', '$email', '$jurusan')";
    mysqli_query($conn, $query);

    //return 
    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    //return 
    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    //tangkap id dalam data
    $id = $data["id"];

    $nim = htmlspecialchars($data["nim"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);

    $query = "UPDATE mahasiswa SET
                nim = '$nim',
                nama = '$nama',
                email = '$email',
                jurusan = '$jurusan'
              WHERE id =  $id
            ";
    mysqli_query($conn, $query);

    //return 
    return mysqli_affected_rows($conn);
}

function cari($keyword){
    //bikin varibale baru 
    $query = "SELECT * FROM mahasiswa WHERE
                nama LIKE '%$keyword%' OR
                nim LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'
            ";

    //return function query -> karena menghasilkan assoc array dari variable query
    return query($query);        
}

function registrasi($data){
    //connect database
    global $conn;

    //ambil data dari variable data post dan simpan ke username
    $username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // username sudah ada atau belom
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if( mysqli_fetch_assoc($result )){
        echo "<script>
                alert('Username sudah terdaftar!');
            </script>";
        return false;    
    }

    //cek konfirmasi
    if ( $password !== $password2 ){
        echo "
            <script>
                alert('konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    //return 
    return mysqli_affected_rows($conn);
}
?>
