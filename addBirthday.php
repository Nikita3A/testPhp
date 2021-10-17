<?php
    $pdo = new PDO('mysql:host=localhost;port=3307;dbname=birthdays', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    #echo $_SERVER['REQUEST_METHOD'].'<br>';
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        echo 'Post';
        $name = $_POST['name'];
        $date = $_POST['date'];
        #$date = date('Y:m:d');
        
        #Validation
        if (!$name)
        {
            $errors[] = 'Enter name!';
        }

        if (!$date)
        {
            $errors[] = 'Enter date!';
        }

        #echo var_dump($date);
        if (empty($errors))
        {
            $statement = $pdo->prepare("INSERT INTO birthdays (name, date) VALUES (:name, :date)");
            $statement->bindValue(':name', $name);
            $statement->bindValue(':date', $date);
            $statement->execute();
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Css -->
    <link rel="stylesheet" href="app.css">
    <!-- Bootstrap CDN Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
    <title>Birthdays</title>
  </head>
  <body>
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