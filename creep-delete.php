<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id_creep = $_GET['id'];

    // Ambil nama gambar dari database berdasarkan id_creep
    $sql = "SELECT gambar FROM creep WHERE id_creep = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_creep);
    $stmt->execute();
    $stmt->bind_result($img);
    $stmt->fetch();
    $stmt->close();

    if ($img) {
        // Hapus row pada database
        $sql = "DELETE FROM creep WHERE id_creep = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_creep);

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

            // Redirect to the creep list page after deletion
            header("Location: creep.php");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Gambar tidak ditemukan untuk id_creep: " . $id_creep;
    }
} else {
    echo "Invalid request!";
}

$conn->close();
?>
