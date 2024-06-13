<?php
include 'conn.php';

$sql = "SELECT * FROM hero";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Item</title>
    <link rel="icon" href="asset/img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .btn-group .btn {
            border-radius: .25rem   ;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand ms-5" href="index.php">Dota 2 Wiki</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-5">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="item.php">Item</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="hero.php">Hero</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mechanics</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    <h2 class="mb-4">Daftar Item</h2>
    <div class="d-flex justify-content-end mb-3">
        <a href="hero-add.php" class="btn btn-primary">Tambah Data</a>
    </div>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Hero</th>
                <th>Atribut</th>
                <th>Role</th>
                <th>Bio</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1; // Initialize the counter variable
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>"; // Use the counter variable for numbering
                    echo "<td><img src='uploads/" . $row["gambar"]. "' width='100' class='img-thumbnail'></td>";
                    echo "<td>" . $row["nama_hero"]. "</td>";
                    echo "<td>" . $row["atribut"]. "</td>";
                    echo "<td>" . $row["roles"]. "</td>";
                    echo "<td>" . $row["bio"]. "</td>";
                    echo "<td>
                          <div class='btn-group'>
                              <a href='hero-update.php?id=".$row["id_hero"]."' class='btn btn-warning btn-sm me-2'>Edit</a>
                              <a href='hero-delete.php?id=".$row["id_hero"]."' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin akan menghapus item ini??\")'>Delete</a>
                          </div>
                          </td>";
                    echo "</tr>";
                    $no++; // Increment the counter variable
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>0 results</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
