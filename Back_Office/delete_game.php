<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['game_id']);

    // $conn = new mysqli('localhost', 'root', 'root', 'GameShift');
     require_once __DIR__ . '/db_connect.php';


    $query = "DELETE FROM games WHERE game_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        header("Location: products.php");
    } else {
        echo "Erreur : " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}
?>
