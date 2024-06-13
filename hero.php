<?php
include 'conn.php';
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$sql = "SELECT * FROM hero";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Hero</title>
    <link rel="icon" href="img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .btn-group .btn {
            border-radius: .25rem   ;
        }

        .navbar {
            background-color: #fff;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .nav-tabs {
            border-bottom: none;
        }

        .nav-tabs .nav-link {
            border: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            margin: 0 10px 0 40px;
            padding: 1rem 0.5rem;
            color: #a10900;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-tabs .nav-link.active {
            background-color: transparent;
            border-color: transparent;
            color: #a10900;
        }
        .nav-tabs .nav-link.active:after {
            width: 100%;
            left: 0;
        }

        .nav-tabs .nav-link::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 4px;
            background-color: #a10900;
            transition: width 0.3s ease, left 0.3s ease;
        }

        .nav-tabs .nav-link:hover::after {
            width: 100%;
            left: 0;
        }

        .nav-tabs .nav-link:focus,
        .nav-tabs .nav-link:hover {
            color: #a10900;
        }
    </style>
</head>
<body>

    <!-- Navbar start -->
    <nav class="navbar navbar-expand-lg py-3 ">
        <div class="pe-lg-0 ps-lg-5 container-fluid justify-content-between">
            <a class="navbar-brand" href="#">
                <img src="img/logo.png" height="50" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <p style="color: #a10900; font-family: montserrat; font-size: 20px; margin-top: 1%; margin-left: 25%;">Admin Version</p>
            <div class="collapse navbar-collapse justify-content-end me-5" id="navbarSupportedContent">
                <nav>
                    <div class="nav d-block d-lg-flex nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link" id="item-tab" href="item.php" role="tab" aria-controls="item" aria-selected="false">Item</a>
                        <a class="nav-link active" id="hero-tab" href="hero.php" role="tab" aria-controls="hero" aria-selected="true">Hero</a>
                        <a class="nav-link" id="creep-tab" href="creep.php" role="tab" aria-controls="creep" aria-selected="true">Creep</a>    
                        <a class="nav-link" href="cart.php">Cart</a>
                        <a class="nav-link" id="logout-tab" href="logout.php" role="tab" aria-controls="contact" aria-selected="true">Logout</a>    
                    </div>
                </nav>
            </div>
        </div>
    </nav>
    <!-- End navbar-->

<div class="container my-4">
    <h2 class="mb-4 text-center">Daftar Hero</h2>
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
