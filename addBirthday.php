<?php
    require_once 'ConnectToDatabase.php';

    $errors = [];
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
            $statement = $pdo->prepare("INSERT INTO birthdays (name, date) VALUES (:name, :date)");
            $statement->bindValue(':name', $name);
            $statement->bindValue(':date', $date);
            $statement->execute();
            header('Location: second.php');
        }
    }
?>

<?php include_once "views/partials/header.php"?>
    <h1>Add Birthday</h1>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error):?>
                <div> <?php echo $error ?> </div>
            <?php endforeach;?>    
        </div>
    <?php endif; ?>    
    <form action = "addBirthday.php" method = "post">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name = "name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Date </label>
            <input type="date" name = "date" id="birthdayDate">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </body>
</html>