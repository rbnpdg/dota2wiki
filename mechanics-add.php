<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_mechanics = $_POST['nama_mechanics'];
    $deskripsi = $_POST['deskripsi'];
    $efek = $_POST['efek'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Use a prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO mechanics (gambar, nama_mechanics, deskripsi, efek) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $gambar, $nama_mechanics, $deskripsi, $efek);

        if ($stmt->execute()) {
            header("Location: mechanics.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "File Anda bermasalah!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Tambah Mechanics</title>
  <link rel="icon" href="img/icon4.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kaisei+Opti:wght@400;500;700&display=swap" rel="stylesheet">
        
  <style>
    body {
      font-family: 'Kaisei Opti', sans-serif; /* Mengatur font-family untuk seluruh teks dalam body */
    }
  </style>
</head>
<body>

<div class="container my-4">
  <h2 class="mb-4" style="color: #A20800; font-weight: bold;">Tambah Mechanics Baru</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama_mechanics" class="form-label">Nama Mechanics</label>
      <input type="text" class="form-control" id="nama_mechanics" name="nama_mechanics" required>
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="efek" class="form-label">Efek</label>
      <textarea class="form-control" id="efek" name="efek" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label>
      <input class="form-control" type="file" id="gambar" name="gambar" required>
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary me-2" style="font-weight: bold;">Submit</button>
      <a href="mechanics.php" class="btn btn-danger">Batal</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
