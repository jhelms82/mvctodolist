<?php

require_once('database.php');

//Errors
$errors = "";



//connect to the DB
$db = mysqli_connect('localhost', 'root', 'sesame', 'todolist');


//Submit Task to DB
if(isset($_POST['submit'])){
    $todoitem = $_POST['Title'];
    $description = $_POST['Description'];
    if (empty($todoitem)) {
        $errors = "You must fill in fields";
    }else { 
        mysqli_query($db, "INSERT INTO todoitems (Title, Description) VALUES ('$todoitem', '$description')");
        header('location: index.php');
    }
}



//Delete Todo
if(isset($_GET['del_task'])) {
    $ItemNum = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM todoitems WHERE ItemNum=$ItemNum");
    header('location: index.php');
}

$todoitems = mysqli_query($db, "SELECT * FROM todoitems")

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="heading">
        <h2>Todo List</h2>
    </div>



    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ToDo</th>
                <th>Description</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
   
        <!-- Display Todo onto page after submit -->
        <?php
            $num = 1;
                if($num) {
                $message = 'No Todos items posted yet';
                 }
                while($row = mysqli_fetch_array($todoitems)) { ?>
            <tr>
                <td><?php echo $num; ?></td>
                <td><?php echo $row['Title']; ?></td>
                <td class="task"><?php echo $row['Description']; ?></td>
                <td class="delete">
                   <button class="delete_btn"> <a href="index.php?del_task=<?php echo $row['ItemNum']; ?>">Delete</a></button>
                </td>

            </tr>
          <?php  $num++; } ?>
            

        </tbody>
    </table>
        <form method=POST action="index.php">
        <h1 class="form-heading"> <b>Enter Your ToDos:</b></h1><br>
    <?php if (isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
    <?php }
    ?>
        <input type="text" name="Title" class="task_input" placeholder="Enter Your Task"><br><br>
        <input type="text" name="Description" class="task_input" placeholder="Task Description">
        <button type="submit" class="add_btn" name="submit">Add ToDo</button>


    </form>
</body>

</html>