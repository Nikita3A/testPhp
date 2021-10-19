<?php
    require_once 'ConnectToDatabase.php';

    $id = $_GET['id'] ?? null;
    if (!$id)
    {
        header('Location: second.php');
        exit;
    }

    $statement = $pdo->prepare("SELECT * FROM birthdays WHERE id = :id");
    $statement->bindValue(':id', $id);
    $statement->execute();
    $birthday = $statement->fetch(PDO::FETCH_ASSOC);

    $errors = [];

    $name = $birthday['name'];
    $date = $birthday['date'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $name = $_POST['name'];
        $date = $_POST['date'];
        
        #Validation
        if (!$name)
        {
            $errors[] = 'Enter name!';
        }

        if (!$date)
        {
            $errors[] = 'Enter date!';
        }

        if (empty($errors))
        {
            $statement = $pdo->prepare("UPDATE birthdays SET name = :name, date = :date WHERE id = :id");
            $statement->bindValue(':name', $name);
            $statement->bindValue(':date', $date);
            $statement->bindValue(':id', $id);
            $statement->execute();
            header('Location: second.php');
        }
    }
?>

<?php include_once "views/partials/header.php"?>
  <h1>Change data of <?php echo $birthday['name']?> with birthday date <?php echo $birthday['date']?></h1>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error):?>
                <div> <?php echo $error ?> </div>
            <?php endforeach;?>    
        </div>
    <?php endif; ?>    
    <form action = "" method = "post">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name = "name" class="form-control" value="<?=$name?>">
        </div>

        <div class="mb-3">
            <label>Date </label>
            <input type="date" name = "date" id="birthdayDate" value="<?=$date?>">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </body>
</html>