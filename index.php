<?php 
  include('connection.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&amp;display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"

    />
    <!-- MDB -->
    <link rel="stylesheet" href="css/mdb.min.css" />
    <title>TO Do List</title>
</head>
<body>
    <div class="container m-5 p-2 rounded mx-auto bg-light shadow">
        <!-- App title section -->
        <div class="row m-1 p-4">
            <div class="col">
                <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
                    <i class="fa fa-check-square-o bg-primary text-white rounded p-2"></i>
                    <u>Simple To Do List</u>
                    <h6>Github Repository:<a href="" target = "_blank"></a></h6>
                </div>
            </div>
        </div>
        <!-- Create todo section -->
        <div class="row m-1 p-3">
            <div class="col col-11 mx-auto">
                <div class="row bg-white rounded shadow-sm p-2 add-todo-wrapper align-items-center justify-content-center">

                    <form action="functions.php" method="post">
                        <div class="row">
                            <input class="form-control form-control-lg border-0 add-todo-input bg-transparent rounded" name="task" type="text" placeholder="Add new ..">
                            <button type="submit" name="add" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="p-2 mx-4 border-black-25 border-bottom"></div>
        <!-- Todo list section -->
        <div class="row mx-1 px-5 pb-3 w-80">
        
                <table class="table">
                    <thead>
                      <tr>
                        
                        <th colspan="2">Task</th>
                        <th colspan="3">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                          $query = "SELECT * FROM todo_list";
                          $result = mysqli_query($conn, $query);
                          while ($row = mysqli_fetch_array($result)) {
                            if ($row['status'] == 'undone') {
                        ?>
                            <tr>
                                <td colspan="2"><?php echo $row['task']?></td>
                                <td colspan="3">
                                    <button type="button" class="btn btn-warning" data-mdb-toggle="modal" data-mdb-target="#edit<?php echo $row['id']?>"><i class="fa fa-pencil"></i> Edit</button>
                                    <button type="submit" class="btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#delete<?php echo $row['id']?>"><i class="fa fa-trash-o "></i> Delete</button>
                                    <button type="submit" name="submit_done" value="<?php echo $row['id']?>" form="done" class="btn btn-success"><i class="fa fa-check "></i>Done</button>
                                    <form id="done" method="post" action="functions.php"> 
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }
                            else {
                        ?>
                            <tr style="background-color:rgba(215,251,196,0.8);">
                                <td colspan="2"><?php echo $row['task']?></td>
                                <td colspan="2">
                                <button type="submit" class="btn btn-danger" data-mdb-toggle="modal" data-mdb-target="#delete<?php echo $row['id']?>"><i class="fa fa-trash-o "></i> Delete</button>

                                </td>
                            </tr>
                        <?php
                            }
                            ?>


                            <!-- Modal  edit-->
                            <div class="modal fade" id="edit<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Task <?php echo $row['task']?></h5>
                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="edit" action="functions.php" method="post">
                                <div class="modal-body">
                                    <div class="form-outline">
                                        
                                        <input type="hidden" name="id" value="<?php echo $row['id']?>">
                                        <input type="text" id="form12" class="form-control" name="task" value="<?php echo $row['task']?>">
                                        
                                        
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                    <button type="submit" name="submit_edit" class="btn btn-warning">Save changes</button>
                                </div>
                                </form>
                                </div>
                            </div>
                            </div>


                            <!-- Modal  delete-->
                            <div class="modal fade" id="delete<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Task <?php echo $row['task']?></h5>

                                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form id="edit" action="functions.php" method="post">
                                <div class="modal-body">
                                    <div class="form-outline">
                                        <h6>Are you sure? This action is irreversible!!</h6>
                                        <input type="hidden" name="id" value="<?php echo $row['id']?>"> 
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Cancel</button>
                                    <button type="submit" name="submit_delete" class="btn btn-danger">Yes, Delete Task</button>
                                </div>
                                </form>
                                </div>
                            </div>
                            </div>

                        <?php
                          }
                        ?>
                    </tbody>
                  </table>
            
    </div>








</body>
<script type="text/javascript" src="js/mdb.min.js"></script>
</html>