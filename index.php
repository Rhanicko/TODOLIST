<?php
include("db.php");


if (isset($_POST["Undo"])) {
    $undo = $_POST['taskid'];
    $taskpending = $_POST['pending'];
    $uncomplete = mysqli_query($conn, "UPDATE `tasklist` SET `status`='$taskpending' WHERE id=$undo");

    // header("location: index.php"); 
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To Do List</title>

        <style>
            /* General Styling */
            body {
                font-family: Arial, sans-serif;
                background-color:white;
                text-align: center;

            }
            h1{
                font-style: italic;
                font-size: 210%;
            }

            /* Table Styling */
            table {
                width: 60%;
                margin: 20px auto;
                border-collapse: collapse;
                background: white;
            }

            th,
            td {
                padding: 12px;
                border: 12;
                border-color: gray;
            }

            th {
                background-color:blue;
                color: white;
                text-transform: uppercase;
            }

            /* Align Task Text to the Left */
            td.alignleft {
                text-align: left;
                padding-left: 18px;
            }
            td.addtask{
                align-items: center;
                padding-left: 18px;
                /* border-color: black; */
            }
            input:hover{
                transition: 0.6s ease-in-out;
                border-color: black;
                opacity: 0.8;
                transform:scale(1.02);

            }



            /* Form Styling */
            form {
                display: inline;
            }

            /* Buttons styles*/
            input[type="submit"] {
                background-color:green;
                color: white;
                border: 0;
                padding: 10px 15px;
                cursor: pointer;
                border-radius: 5px;
                margin: 3px;
            }

            input[type="submit"][value="Delete"] {
                background-color:red;
            }

            input[type="submit"][value="Undo"] {
                background-color:orange;
                color: black;
            }

         
            /* -------------------------------- */

            /* Input */
            input[type="text"] {
                width: 90%;
                padding: 10px;
                border: 5;
                border-radius: 6px;
            }

            /* Add Button */
            input[type="submit"][value="ADD"] {
                transition: 0.6s ease-in-out;
                background-color: #28a745;
                color: white;
                border: none;
                padding: 12px 25px;
                font-size: 18px;
                font-weight: bold;
                width: 40%;
                display: block;
                margin: 0 auto;
                text-align: center;
            }
            /* Add table Animation */
            input[type="submit"][value="ADD"]:hover {
                background-color: #218838;
                transform: scale(1.07);
            }
            /* Add table color */
            table.addclass{
                border-color:black;
            }

            /* Status Column (both complete and pending) */
            td.status {
                font-weight: bold;
                padding: 5px;
                border-radius: 5px;
                text-align: center;
            }

            /* Completed Status  */
            td.status.COMPLETED {
                background-color:green;
                color: white;
            }

            /* Pending Status  */
            td.status.PENDING {
                background-color:yellow;
                color: black;
            }
        </style>

    </head>

    <title>To Do List</title>
</head>

<body>

   

    <!-- table of task list -->
    <table border="2" width="50%" align="center" cellpadding="5" cellspacing="2">
    <tr><h1>TO DO LIST</h1></tr>
        <tr>
            <th>List of Tasks</th>
            <th>Actions</th>
            <th>Status</th>
        </tr>

        <!-- ////////////////////////////////////////////////////////// -->
        <?php

        $list = mysqli_query($conn, "SELECT * FROM tasklist");

        while ($row = mysqli_fetch_object($list)) {
        ?>
            <tr>

                <td class="alignleft">• <?= $row->task ?></td>

                <td>
                    <!-- complete task button -->
                    <form action="complete_task.php" method="POST">
                        <input type="hidden" name="taskid" value="<?= $row->id ?>">
                        <input type="hidden" name="complete" value="COMPLETED">
                        <input type="submit" value="Complete">
                    </form>

                    <!-- Undo button -->
                    <form action="" method="POST">
                        <input type="hidden" name="taskid" value="<?= $row->id ?>">
                        <input type="hidden" name="pending" value="PENDING">
                        <input type="submit" name="Undo" value="Undo">
                    </form>

                    <!-- delete button -->
                    <form action="delete_task.php" method="POST">
                        <input type="hidden" name="taskid" value="<?= $row->id ?>">
                        <input type="submit" value="Delete">
                    </form>

                </td>
                
                <td class="status <?=$row->status?>"> <?=$row->status?></td>





            </tr>

        <?php
        }
        ?><!-- ////////////////////////////////////////////////////////// -->

    </table>




    <!-- add task  -->
    <form action="add_task.php" method="POST">
        <table class="addclass" border="2" align="center" cellpadding="5" cellspacing="2">
            <tr>
                <td class="addtask"><input type="text" name="addtask" placeholder="Add Task" required></td>
                <input type="hidden" name="pending" value="PENDING">
            </tr>
            <tr>
                <td><input type="submit" name="addtaskbtn" value="ADD"></td>
            </tr>
        </table>


    </form>

</body>

</html>