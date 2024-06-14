<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id_hero = $_GET['id'];
    $sql = "SELECT * FROM hero WHERE id_hero = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_hero);
    $stmt->execute();
    $result = $stmt->get_result();
    $hero = $result->fetch_assoc();

    if (!$hero) {
        echo "Hero not found!";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_hero = $_POST['nama_hero'];
        $atribut = $_POST['atribut'];
        $role = $_POST['role'];
        $bio = $_POST['bio'];
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["gambar"]["name"]);

        if (!empty($gambar)) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $sql = "UPDATE hero SET gambar = ?, nama_hero = ?, atribut = ?, roles = ?, bio = ? WHERE id_hero = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssi", $gambar, $nama_hero, $atribut, $role, $bio, $id_hero);
            } else {
                echo "File upload failed!";
                exit();
            }
        } else {
            $sql = "UPDATE hero SET nama_hero = ?, atribut = ?, roles = ?, bio = ? WHERE id_hero = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $nama_hero, $atribut, $role, $bio, $id_hero);
        }

        if ($stmt->execute()) {
            header("Location: hero.php");
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
  <title>Edit Hero</title>
  <link rel="icon" href="asset/img/icon.png">
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
  <h2 class="mb-4" style="color: #A20800; font-weight: bold;">Edit Hero</h2>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="nama_hero" class="form-label">Nama Hero</label>
      <input type="text" class="form-control" id="nama_hero" name="nama_hero" value="<?php echo htmlspecialchars($hero['nama_hero']); ?>" required>
    </div>

    <div class="mb-3">
      <label for="atribut" class="form-label">Atribut</label>
      <textarea class="form-control" id="atribut" name="atribut" rows="3" required><?php echo htmlspecialchars($hero['atribut']); ?></textarea>
    </div>

    <div class="mb-3">
      <label for="role" class="form-label">Role</label>
      <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlspecialchars($hero['roles']); ?>" required>
    </div>

    <div class="mb-3">
      <label for="bio" class="form-label">Bio</label>
      <textarea class="form-control" id="bio" name="bio" rows="3" required><?php echo htmlspecialchars($hero['bio']); ?></textarea>
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar</label><br>
      <?php if ($hero['gambar']): ?>
        <img src="uploads/<?php echo $hero['gambar']; ?>" width="100" class="img-thumbnail mt-2">
      <?php endif; ?>
      <input class="form-control" type="file" id="gambar" name="gambar">
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary me-2" style="font-weight: bold;">Update</button>
      <a href="hero.php" class="btn btn-danger">Batal</a>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
