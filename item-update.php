<?php
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_item'])) {
    $id_item = $_POST['id_item'];
    $nama_item = $_POST['nama_item'];
    $harga = $_POST['harga'];
    $atribut = $_POST['atribut'];
    $efek = $_POST['efek'];
    $gambar = $_FILES['gambar']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    
    if ($gambar) {
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
        $sql = "UPDATE item SET gambar='$gambar', nama_item='$nama_item', harga=$harga, atribut='$atribut', efek='$efek' WHERE id_item=$id_item";
    } else {
        $sql = "UPDATE item SET nama_item='$nama_item', harga=$harga, atribut='$atribut', efek='$efek' WHERE id_item=$id_item";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: item.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_item = $_GET['id'];
    $sql = "SELECT * FROM item WHERE id_item=$id_item";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
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
    <h2 class="mb-4" style="color: #A20800; font-weight: bold;">Edit Item</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_item" value="<?php echo $row['id_item']; ?>">
        
        <div class="mb-3">
            <label for="nama_item" class="form-label">Nama Item</label>
            <input type="text" class="form-control" id="nama_item" name="nama_item" value="<?php echo $row['nama_item']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label for="atribut" class="form-label">Atribut</label>
            <textarea class="form-control" id="atribut" name="atribut" rows="3" required><?php echo $row['atribut']; ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="efek" class="form-label">Efek</label>
            <textarea class="form-control" id="efek" name="efek" rows="3" required><?php echo $row['efek']; ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Item</label>
            <input class="form-control" type="file" id="gambar" name="gambar">
        </div>
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-primary me-2" style="font-weight: bold;">Simpan</button>
          <a href="item.php" class="btn btn-danger">Batal</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
