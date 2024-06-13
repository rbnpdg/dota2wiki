<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_creep = $_POST['nama_creep'];
    $tipe = $_POST['tipe'];
    $health = $_POST['health'];
    $damage = $_POST['damage'];
    $bounty = $_POST['bounty'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Use a prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO creep (gambar, nama_creep, tipe, health, damage, bounty) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiii", $gambar, $nama_creep, $tipe, $health, $damage, $bounty);

        if ($stmt->execute()) {
            header("Location: creep.php");
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
  <title>Tambah Creep</title>
  <link rel="icon" href="asset/img/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container my-4">
  <h2 class="mb-4">Tambah Creep Baru</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama_creep" class="form-label">Nama Creep</label>
      <input type="text" class="form-control" id="nama_creep" name="nama_creep" required>
    </div>

    <div class="mb-3">
      <label for="tipe" class="form-label">Tipe</label>
      <input type="text" class="form-control" id="tipe" name="tipe" required>
    </div>

    <div class="mb-3">
      <label for="health" class="form-label">Health</label>
      <input type="number" class="form-control" id="health" name="health" required>
    </div>

    <div class="mb-3">
      <label for="damage" class="form-label">Damage</label>
      <input type="number" class="form-control" id="damage" name="damage" required>
    </div>

    <div class="mb-3">
      <label for="bounty" class="form-label">Bounty</label>
      <input type="number" class="form-control" id="bounty" name="bounty" required>
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label>
      <input class="form-control" type="file" id="gambar" name="gambar" required>
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary me-2">Submit</button>
      <a href="creep.php" class="btn btn-danger">Batal</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
