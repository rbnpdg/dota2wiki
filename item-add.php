<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_item = $_POST['nama_item'];
    $harga = $_POST['harga'];
    $atribut = $_POST['atribut'];
    $efek = $_POST['efek'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO item (gambar, nama_item, harga, atribut, efek) VALUES ('$gambar', '$nama_item', $harga, '$atribut', '$efek')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: item.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
      <label for="nama_item" class="form-label">Nama Item</label>
      <input type="text" class="form-control" id="nama_item" name="nama_item" required>
    </div>

    <div class="mb-3">
      <label for="harga" class="form-label">Harga</label>
      <input type="number" class="form-control" id="harga" name="harga" required>
    </div>

    <div class="mb-3">
      <label for="atribut" class="form-label">Atribut</label>
      <textarea class="form-control" id="atribut" name="atribut" rows="3" required></textarea>
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
      <button type="submit" class="btn btn-primary me-2">Submit</button>
      <a href="item.php" class="btn btn-danger">Batal</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
