<?php
session_start();

// Jika user sudah login, redirect ke halaman lain
if (isset($_SESSION['username'])) {
    header('Location: item.php');
    exit();
}

// Include file koneksi ke database
include('conn.php');

// Inisialisasi variabel error
$login_err = '';

// Jika tombol Login ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil nilai dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengecek apakah username dan password cocok
    $query = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $username, $password);

    // Eksekusi query
    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->get_result();

    // Periksa apakah hasil query menghasilkan baris data
    if ($result->num_rows == 1) {
        // Jika ada, simpan username ke session
        $_SESSION['username'] = $username;
        
        // Redirect ke halaman utama
        header('Location: item.php');
        exit();
    } else {
        // Jika tidak ada, beri pesan error
        $login_err = 'Username atau password salah.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('img/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            margin-top: 7%;
            width: 400px;
            border-radius: 20px;
        }

        .btn-block {
            text-decoration: none;
            display: block;
            margin-top: 20px;
            border-radius: 10px;
            padding: 10px;
            background-color: #a10900;
            border: 1px solid #a10900;
            color: #fff;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;  
        }

        .btn-block:hover {
            background-color: #fff;
            color: #a10900;
            border-color: #a10900;
        }

        .form-control:hover {
            box-shadow: 0 0 10px rgba(161, 9, 0, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-auto">
                    <div class="card-body">
                        <h2 class="text-center">Login</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <?php 
                            // Tampilkan pesan error jika login gagal
                            if (!empty($login_err)) {
                                echo '<div class="alert alert-danger">' . $login_err . '</div>';
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
