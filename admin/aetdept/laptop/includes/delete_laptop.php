<?php
    session_start();


    include('../../../connection/connect.php');

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM aetlaptops WHERE id = ?";

        $stmt = $conn->prepare($sql);

        if($stmt) {

            $stmt->bind_param("i", $id);
            if($stmt->execute()) {
                header("Location: ../pages/adminview.php");
                exit;
            } else {
                echo "Error executing delete statement: " . $stmt->error;
            }
        } else {
            echo "Error preparing delete statement: " . $conn->error;
        }
        $stmt->close();
    } else {
        header("Location: ../pages/adminview.php");
        exit;
    }

    $conn->close();
?>
