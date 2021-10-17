<?php
    $pdo = new PDO('mysql:host=localhost;port=3307;dbname=birthdays', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $thisMonth = $_GET['thisMonth'] ?? "";
    
    //var_dump($thisMonth);
    if ($thisMonth)
    {
        $statement = $pdo->prepare('SELECT * FROM birthdays WHERE MONTH(date) = :thisMonth;');
        $statement->bindValue(':thisMonth', $thisMonth);
        $statement->execute();
        $birthdays = $statement->fetchAll(PDO::FETCH_ASSOC);
    }    
    else
    {
        $statement = $pdo->prepare('Select * from birthdays');
        $statement->execute();
        $birthdays = $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /*$statement = $pdo->prepare('Select * from birthdays');
    $statement->execute();
    $birthdays = $statement->fetchAll(PDO::FETCH_ASSOC);*/

    /*echo '<pre>';
    var_dump($birthdays);
    echo '<pre>';*/
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
    <h1>Birthdays</h1>
    <div style="display: inline-block;"> <a href="addBirthday.php" class="btn btn-success" > AddBirthday </a> </div>

    <form style="display: inline-block;"> 
        <input type="hidden" name="thisMonth" value="<?php echo date('m')?>">   
        <button type="submit" class="btn btn-success">This month</button> 
    </form>

    <table class="table">
        <thead>
            <tr> 
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Date</th>
                <th scope="col">CreateDate</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($birthdays as $i => $birthday) { ?>
            <tr>
                <th scope="row"><?php echo $i+1?></th>
                <td> <?php echo $birthday['name']?> </td>
                <td> <?php echo $birthday['date']?> </td>
                <td>
                    <button type="button" class="btn btn-outline-success">Add</button>
                    <form style="display: inline-block" method="post" action="delete.php"> 
                        <input type="hidden" name="id" value="<?php echo $birthday['id']?>">   
                        <button type="submit" class="btn btn-outline-danger">Delete</button> 
                    </form>
                </td>
            </tr>
        <?php } ?>
            
        </tbody>
    </table>


    
  </body>
</html>