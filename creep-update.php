<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id_creep = $_GET['id'];
    $sql = "SELECT * FROM creep WHERE id_creep = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_creep);
    $stmt->execute();
    $result = $stmt->get_result();
    $creep = $result->fetch_assoc();

    if (!$creep) {
        echo "Creep not found!";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_creep = $_POST['nama_creep'];
        $tipe = $_POST['tipe'];
        $health = $_POST['health'];
        $damage = $_POST['damage'];
        $bounty = $_POST['bounty'];
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

        if (!empty($gambar)) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $sql = "UPDATE creep SET gambar = ?, nama_creep = ?, tipe = ?, health = ?, damage = ?, bounty = ? WHERE id_creep = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssiiii", $gambar, $nama_creep, $tipe, $health, $damage, $bounty, $id_creep);
            } else {
                echo "File upload failed!";
                exit();
            }
        } else {
            $sql = "UPDATE creep SET nama_creep = ?, tipe = ?, health = ?, damage = ?, bounty = ? WHERE id_creep = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiiii", $nama_creep, $tipe, $health, $damage, $bounty, $id_creep);
        }

        if ($stmt->execute()) {
            header("Location: creep.php");
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
  <title>Edit Creep</title>
  <link rel="icon" href="asset/img/icon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<div class="container my-4">
  <h2 class="mb-4">Edit Creep</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama_creep" class="form-label">Nama Creep</label>
      <input type="text" class="form-control" id="nama_creep" name="nama_creep" value="<?php echo htmlspecialchars($creep['nama_creep']); ?>" required>
    </div>

    <div class="mb-3">
      <label for="tipe" class="form-label">Tipe</label>
      <input type="text" class="form-control" id="tipe" name="tipe" value="<?php echo htmlspecialchars($creep['tipe']); ?>" required>
    </div>

    <div class="mb-3">
      <label for="health" class="form-label">Health</label>
      <input type="number" class="form-control" id="health" name="health" value="<?php echo htmlspecialchars($creep['health']); ?>" required>
    </div>

    <div class="mb-3">
      <label for="damage" class="form-label">Damage</label>
      <input type="number" class="form-control" id="damage" name="damage" value="<?php echo htmlspecialchars($creep['damage']); ?>" required>
    </div>

    <div class="mb-3">
      <label for="bounty" class="form-label">Bounty</label>
      <input type="number" class="form-control" id="bounty" name="bounty" value="<?php echo htmlspecialchars($creep['bounty']); ?>" required>
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label><br>
      <?php if ($creep['gambar']): ?>
        <img src="uploads/<?php echo $creep['gambar']; ?>" width="100" class="img-thumbnail mt-2">
      <?php endif; ?>
      <input class="form-control" type="file" id="gambar" name="gambar">
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary me-2">Update</button>
      <a href="creep.php" class="btn btn-danger">Batal</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
