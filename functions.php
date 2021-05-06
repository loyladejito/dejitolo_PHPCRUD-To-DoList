<?php
include 'task.php';

$obj = new taskList();

if (isset($_POST['submit'])) {
    $obj->insertRecord($_POST);
}

if (isset($_POST['update'])) {
    $obj->updateRecord($_POST);
}

if (isset($_GET['deleteid'])) {
    $delid = $_GET['deleteid'];
    $obj->insertTrashRecord($delid);
    $obj->deleteRecord($delid);
}

if(isset($_GET['trash_id'])){
     $trash_id = $_GET['trash_id'];
     $obj->insertTrashRecord($trash_id);
     $obj->restoreRecord($trash_id);
     $obj->deleteTrashRecord($trash_id);
     $obj->deleteTrash($trash_id);
}

if (isset($_GET['del_id'])) {
     $id = $_GET['del_id'];
     $obj->deleteTrash($id);
}

?>

<!Doctype html>
<html lang="en">
     <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
          <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"></head>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
          <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
          <title>To-Do List</title>
     </head>
     <style>
          .card{
               background-color: black;
          }
          a:link, a:visited {
          padding: 10px 20px;
          text-decoration: none;
          }

          a:hover, a:active {
          background-color: none;
          color: white;
          }
     </style>
     <body>
          <div class="container">
          <!-- alert messages -->
               <?php
               if (isset($_GET['msg']) AND $_GET['msg'] == 'ins') {
               echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Task has been added!!</div>';
               }
               if (isset($_GET['msg']) AND $_GET['msg'] == 'ups') {
               echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Task has been updated!!</div>';
               }
               if (isset($_GET['msg']) AND $_GET['msg'] == 'del') {
               echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>Task has been deleted!!</div>';
               }
               ?>
               <!-- end of alert messages -->
          </div>
          <div class="container d-flex justify-content-center mt-4 text-center">
               <div class="card text-white border-dark" style="width:70rem">
                    <div class="card-header border-warning">
                         <h1 class="card-title">TO-DO-LIST</h1>
                         <a href="trash.php" class="fas fa-trash" style="margin-left:-86%;color:red;font-size:23px"></a>Trash Bin
                    </div>
                    <div class="card-body">
                         <p class="card-text">
                              <?php
                                   if (isset($_GET['editid'])) {
                                   $editid = $_GET['editid'];
                                   $myrecord = $obj->displayRecordById($editid);
                              ?>

                              <!-- FORM -->  
                              <form action="functions.php" class="mb-4" method="post">
                                   <div class="form-group">
                                        <div class="input-group-prepend" style="display:flex;justify-content:center;align-items:center;">
                                             <input type="hidden" name="hid" value="<?php echo $myrecord['id']; ?>">
                                             <button type="submit" name="update" class="btn btn-info mr-4 fa fa-check"></button>
                                             <input name="task" class="form-control" value="<?php echo $myrecord['task']; ?>" style="width:17rem; border-radius:5px;height:6vh;font-size:large;" type="text" placeholder="Edit task"/>
                                        </div>
                                   </div>
                              </form>
                              <!-- END FORM -->

                              <?php
                              } else {
                              ?>

                              <form action="functions.php" class="mb-4" method="post">
                                   <div class="form-group">
                                        <div class="input-group-prepend" style="display:flex;justify-content:center;align-items:center;">
                                             <button type="submit" name="submit" class="btn btn-primary mr-4 fa fa-plus"></button>
                                             <input name="task" class="task" style="width:17rem; border-radius:5px;height:6vh;font-size:large;" type="text" placeholder="Enter task"/>
                                        </div>
                                   </div>
                              </form>
                
                              <?php }   ?>
                              <div class="d-flex justify-content-center">
                                   <hr style="margin-top:1%;width:70%;border-top:2px solid #4d004d;">
                              </div>
                              <div class="d-flex justify-content-center">
                                   <hr style="margin-top:-1%;width:60%;border-top:3px dashed #ffffcc; ">
                                   </div>
                              <div class="d-flex justify-content-center">
                                   <hr style="margin-top:-1%;width:70%;border-top:2px solid #4d004d; ;">
                              </div>
                         </p>

                         <table class="table table-sm table-striped mt-4 text-center text-white border border-whites">
                              <thead style="font-size:20px">
                                   <tr>
                                        <th>Task Checker</th>
                                        <th>Task</th>
                                        <th colspan="2">Action</th>
                                   </tr>
                              </thead>
                              <tbody class="text-white mt-3">
                                   <?php
                                   $data = $obj->displayRecord();
                                   foreach ($data as $value) {
                                   ?>
                                   <tr>
                                        <td><input type="checkbox" class="checkbox"></td>
                                        <td><?php echo $value['task']; ?></td>
                                        <td>
                                             <a href="functions.php?editid=<?php echo $value['id'];?>" class="fas fa-edit" style="color:yellow;font-size:20px"></a>
                                        </td>
                                        <td>
                                             <a href="functions.php?deleteid=<?php echo $value['id']; ?>"><i class='far fa-trash-alt' style='font-size:25px;color:red'></i></a>
                                        </td>
                                   </tr>
                                   <?php
                                   }
                                   ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="crossorigin="anonymous"></script>
  </body>
  <script>
$('.checkbox').change(function(){
  if (this.checked){
    $(this).parent().parent().css("text-decoration","line-through");

  }else{
    $(this).parent().parent().css("text-decoration","none");
  }
})
</script>

<style>
body{
     background: rgb(23,24,56);
     background: linear-gradient(90deg, rgba(23,24,56,1) 4%, rgba(73,73,88,0.7679446778711485) 22%, rgba(33,179,99,1) 64%, rgba(0,212,255,0.7147233893557423) 100%);
      background-size: cover;
      background-position:center;
      background-repeat: no-repeat;
      background-attachment:fixed;
}
</style>
  </html>
