<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_hero = $_POST['nama_hero'];
    $level10 = $_POST['level10'];
    $level15 = $_POST['level15'];
    $level20 = $_POST['level20'];
    $level25 = $_POST['level25'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Use a prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO telents (gambar, nama_hero, level10, level15, level20, level25) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $gambar, $nama_hero, $level10, $level15, $level20, $level25);

        if ($stmt->execute()) {
            header("Location: telents.php");
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
  <title>Tambah Item</title>
  <link rel="icon" href="asset/img/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container my-4">
  <h2 class="mb-4">Tambah Telents Baru</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama_hero" class="form-label">Nama Hero</label>
      <input type="text" class="form-control" id="nama_hero" name="nama_hero" required>
    </div>

    <div class="mb-3">
      <label for="level10" class="form-label">Level 10</label>
      <input type="text" class="form-control" id="level10" name="level10" required>
    </div>

    <div class="mb-3">
      <label for="level15" class="form-label">Level 15</label>
      <input type="text" class="form-control" id="level15" name="level15" required>
    </div>

    <div class="mb-3">
      <label for="level20" class="form-label">Level 20</label>
      <input type="text" class="form-control" id="level20" name="level20" required>
    </div>

    <div class="mb-3">
      <label for="level25" class="form-label">Level 25</label>
      <input type="text" class="form-control" id="level25" name="level25" required>
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label>
      <input class="form-control" type="file" id="gambar" name="gambar" required>
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary me-2">Submit</button>
      <a href="telents.php" class="btn btn-danger">Batal</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
