<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id_mechanics = $_GET['id'];
    $sql = "SELECT * FROM mechanics WHERE id_mechanics = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_mechanics);
    $stmt->execute();
    $result = $stmt->get_result();
    $mechanics = $result->fetch_assoc();

    if (!$mechanics) {
        echo "Mechanics not found!";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_mechanics = $_POST['nama_mechanics'];
        $deskripsi = $_POST['deskripsi'];
        $efek = $_POST['efek'];
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

        if (!empty($gambar)) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $sql = "UPDATE mechanics SET gambar = ?, nama_mechanics = ?, deskripsi = ?, efek = ? WHERE id_mechanics = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssi", $gambar, $nama_mechanics, $deskripsi, $efek, $id_mechanics);
            } else {
                echo "File upload failed!";
                exit();
            }
        } else {
            $sql = "UPDATE mechanics SET nama_mechanics = ?, deskripsi = ?, efek = ? WHERE id_mechanics = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $nama_mechanics, $deskripsi, $efek, $id_mechanics);
        }

        if ($stmt->execute()) {
            header("Location: mechanics.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
} else {
    echo "Invalid request!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Mechanics</title>
  <link rel="icon" href="asset/img/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container my-4">
  <h2 class="mb-4">Edit Mechanics</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama_mechanics" class="form-label">Nama Mechanics</label>
      <input type="text" class="form-control" id="nama_mechanics" name="nama_mechanics" value="<?php echo htmlspecialchars($mechanics['nama_mechanics']); ?>" required>
    </div>

    <div class="mb-3">
      <label for="deskripsi" class="form-label">Deskripsi</label>
      <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo htmlspecialchars($mechanics['deskripsi']); ?></textarea>
    </div>

    <div class="mb-3">
      <label for="efek" class="form-label">Efek</label>
      <textarea class="form-control" id="efek" name="efek" rows="3" required><?php echo htmlspecialchars($mechanics['efek']); ?></textarea>
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label><br>
      <?php if ($mechanics['gambar']): ?>
        <img src="uploads/<?php echo $mechanics['gambar']; ?>" width="100" class="img-thumbnail mt-2">
      <?php endif; ?>
      <input class="form-control" type="file" id="gambar" name="gambar">
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary me-2">Update</button>
      <a href="mechanics.php" class="btn btn-danger">Batal</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
