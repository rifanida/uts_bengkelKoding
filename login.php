<?php
try {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        // mencocokkan dengan data dengan db
        $cekdatabase = mysqli_query($mysqli, "SELECT * FROM user where username='$username' and password='$password'");
        
        //menghitung jumlah data
        $hitung = mysqli_num_rows($cekdatabase);
        if ($hitung > 0) {
            $_SESSION['log'] = 'True';
            $data = mysqli_fetch_array($cekdatabase);
            $_SESSION['user_id'] = $data['id'];
            header('location:index.php?success=true');
        } else {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Username atau Password salah!",
                        timer: 2000
                    })
                </script>';
        }
    };

    if (!isset($_SESSION['log'])) {
    } else {
        header('index.php?page=login');
    }
} catch (\Throwable $th) {
    echo '<script>
            Swal.fire({
                icon: "error",
                title: "Username atau Password salah!",
                timer: 2000
            })
        </script>';
}
?>
<body style="background-image: url('img/1.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center 30px;">
<div class="card p-4" style="width: 18rem; border-radius: 5%;">
    <form method="post">
        <div class="mb-3">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
        </div>
        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn btn-primary rounded-pill px-3 mt-3" name="login" >Login</button>
        <p class="mt-3 text-secondary">Belum punya akun? <a href="index.php?page=register" class="text-primary">Register</a></p>
    </form>
</div>
</body>