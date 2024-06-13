<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id_item = $_GET['id'];

    // First, retrieve the file name of the photo associated with the item
    $sql = "SELECT gambar FROM item WHERE id_item=$id_item";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $photo_filename = $row['gambar'];
        
        // Delete the item from the database
        $sql_delete = "DELETE FROM item WHERE id_item=$id_item";
        if ($conn->query($sql_delete) === TRUE) {
            echo "Data berhasil dihapus";

            // Delete the photo file from the server
            $file_path = 'uploads/' . $gambar;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Item not found";
    }

    $conn->close();
    header("Location: item.php");
    exit();
}
?>
