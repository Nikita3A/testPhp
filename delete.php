<?php 
    $pdo = new PDO('mysql:host=localhost;port=3307;dbname=birthdays', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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