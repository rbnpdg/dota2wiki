<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_hero = $_POST['nama_hero'];
    $atribut = $_POST['atribut'];
    $role = $_POST['role'];
    $bio = $_POST['bio'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        // Use a prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO hero (gambar, nama_hero, atribut, roles, bio) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $gambar, $nama_hero, $atribut, $role, $bio);

        if ($stmt->execute()) {
            header("Location: hero.php");
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
  <h2 class="mb-4">Tambah Item Baru</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama_hero" class="form-label">Nama Hero</label>
      <input type="text" class="form-control" id="nama_hero" name="nama_hero" required>
    </div>

    <div class="mb-3">
      <label for="atribut" class="form-label">Atribut</label>
      <textarea class="form-control" id="atribut" name="atribut" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <input type="text" class="form-control" id="role" name="role" required>
    </div>

    <div class="mb-3">
      <label for="bio" class="form-label">Bio</label>
      <textarea class="form-control" id="bio" name="bio" rows="3" required></textarea>
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label>
      <input class="form-control" type="file" id="gambar" name="gambar" required>
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary me-2">Submit</button>
      <a href="hero.php" class="btn btn-danger">Batal</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
