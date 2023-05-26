<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/bootstrap.min.css">

<?php
include('connection.php');
date_default_timezone_set('Asia/Manila');
?>

<?php
if(isset($_POST['add'])){
    $task = $_POST['task'];
    $conn->query("INSERT INTO todo_list (task,status) 
    VALUES('$task','undone')");
    ?>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'success',
                title: 'Task Added',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php";
                }else{
                    window.location.href = "index.php";
                    }
                })
                
                })
        
        </script>
<?php
}

if(isset($_POST['submit_edit'])){
    $id = $_POST['id'];
    $task = $_POST['task'];
    $conn->query("UPDATE todo_list SET task = '$task' WHERE id = '$id'") or die($conn->error);

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Swal.fire({
                icon: 'success',
                title: 'Task Edited',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php";
                }else{
                    window.location.href = "index.php";
                    }
                })
                
                })
        
        </script>
<?php
}
if(isset($_POST['submit_delete'])){
    $id = $_POST['id'];
    $conn->query("DELETE FROM todo_list WHERE id ='$id'");
?>
<script>window.location.href = "index.php";</script>
<?php
}
?>

<?php
if(isset($_POST['submit_done'])){
    $id = $_POST['submit_done'];
    $conn->query("UPDATE todo_list SET status = 'done' WHERE id = '$id'") or die($conn->error);
?>
<script>window.location.href = "index.php";</script>
<?php
}
?>