<?php 
    require_once 'ConnectToDatabase.php';

    $id = $_POST['id'] ?? null;
    if (!$id)
    {
        header('Location: second.php');
        exit;
    }

    $statement = $pdo->prepare('DELETE FROM birthdays WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    header('Location: second.php');
    
?>