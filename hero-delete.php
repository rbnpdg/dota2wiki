<?php
include 'conn.php';

if (isset($_GET['id'])) {
    $id_hero = $_GET['id'];

    // Prepare a statement to prevent SQL injection
    $sql = "DELETE FROM hero WHERE id_hero = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_hero);

    if ($stmt->execute()) {
        // Redirect to the hero list page after deletion
        header("Location: hero.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request!";
}

$conn->close();
?>
