<?php
include 'conn.php';

$sql = "SELECT * FROM item";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dota 2 Wiki</title>
    <link rel="icon" href="asset/img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .btn-group .btn {
            border-radius: .25rem !important;
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
            <div class="collapse navbar-collapse justify-content-end me-5" id="navbarSupportedContent">
                <nav>
                    <div class="nav d-block d-lg-flex nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active" id="home-tab" href="index.php" role="tab" aria-controls="home" aria-selected="false">Home</a>
                        <a class="nav-link" id="item-tab" href="user-item.php" role="tab" aria-controls="item" aria-selected="false">Item</a>
                        <a class="nav-link" id="hero-tab" href="user-hero.php" role="tab" aria-controls="hero" aria-selected="true">Hero</a>
                        <a class="nav-link" id="creep-tab" href="user-creep.php" role="tab" aria-controls="creep" aria-selected="true">Creep</a>
                        <a class="nav-link" id="talents-tab" href="user-talents.php" role="tab" aria-controls="talents" aria-selected="true">Talents</a>
                        <a class="nav-link" id="mechanics-tab" href="user-mechanics.php" role="tab" aria-controls="mechanics" aria-selected="true">Mechanics</a>
                    </div>
                </nav>
            </div>
        </div>
    </nav>
    <!-- End navbar-->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
