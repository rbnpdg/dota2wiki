<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id_item = $_GET['id'];

    // Pertama, ambil nama file gambar yang terkait dengan item
    $sql = "SELECT gambar FROM item WHERE id_item = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_item);
    $stmt->execute();
    $stmt->bind_result($gambar);
    $stmt->fetch();
    $stmt->close();

    if ($gambar) {
        // Hapus item dari database
        $sql_delete = "DELETE FROM item WHERE id_item = ?";
        $stmt = $conn->prepare($sql_delete);
        $stmt->bind_param("i", $id_item);

        if ($stmt->execute()) {
            echo "Data berhasil dihapus";

            // Hapus file gambar dari server
            $file_path = 'uploads/' . $gambar;
            if (file_exists($file_path)) {
                if (unlink($file_path)) {
                    echo " dan file gambar telah dihapus.";
                } else {
                    echo " namun file gambar gagal dihapus.";
                }
            } else {
                echo " namun file gambar tidak ditemukan.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Item tidak ditemukan atau tidak memiliki gambar.";
    }

    $conn->close();
    header("Location: item.php");
    exit();
} else {
    echo "Invalid request!";
}
?>
