<?php
// Include file koneksi ke database
include 'conn.php';

// Pastikan id_telents disediakan melalui parameter GET
if (isset($_GET['id'])) {
    $id_telents = $_GET['id'];

    // Ambil nama gambar dari database berdasarkan id_telents
    $sql = "SELECT gambar FROM telents WHERE id_telents = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_telents);
    $stmt->execute();
    $stmt->bind_result($img);
    $stmt->fetch();
    $stmt->close();

    // Jika gambar ditemukan, lanjutkan dengan proses penghapusan
    if ($img) {
        // Hapus row pada database
        $sql = "DELETE FROM telents WHERE id_telents = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_telents);

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

            // Redirect ke halaman daftar telents setelah penghapusan
            header("Location: telents.php");
            exit();
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Gambar tidak ditemukan untuk id_telents: " . $id_telents;
    }
} else {
    echo "Invalid request!";
}

// Tutup koneksi ke database
$conn->close();
?>
