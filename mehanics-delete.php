<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id_mechanics = $_GET['id'];

    // Ambil nama gambar dari database berdasarkan id_mechanics
    $sql = "SELECT gambar FROM mechanics WHERE id_mechanics = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_mechanics);
    $stmt->execute();
    $stmt->bind_result($img);
    $stmt->fetch();
    $stmt->close();

    if ($img) {
        // Hapus row pada database
        $sql = "DELETE FROM mechanics WHERE id_mechanics = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_mechanics);

        if ($stmt->execute()) {
            // Hapus foto dari folder "uploads"
            $image_path = "uploads/" . $img;
            if (file_exists($image_path)) {
                if (unlink($image_path)) {
                    echo "File " . $image_path . " telah dihapus.";
                } else {
                    echo "Gagal menghapus " . $image_path . ".";
                }
            } else {
                echo "File " . $image_path . " tidak ditemukan.";
            }

            // Redirect ke halaman daftar mechanics setelah penghapusan
            header("Location: mechanics.php");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Gambar tidak ditemukan untuk id_mechanics: " . $id_mechanics;
    }
} else {
    echo "Invalid request!";
}

$conn->close();
?>
