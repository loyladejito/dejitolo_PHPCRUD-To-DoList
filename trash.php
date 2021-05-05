<?php
include 'task.php';

$obj = new taskList();

if (isset($_GET['deleteid'])) {
    $delid = $_GET['deleteid'];
    $obj->deleteRecord($delid);
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
          <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
          <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
          <div class="container d-flex justify-content-center mt-4 text-center">
               <div class="card text-white border-dark" style="width:70rem">
                    <div class="card-header border-warning">
                         <h1 class="card-title">DELETED To Do-s</h1>
                         <a href="functions.php"><i class="material-icons">arrow_back</i>Go back to the mainpage</a>
                    </div>
                    <div class="card-body">
                         <p class="card-text">  
                              <hr style="width: 23vw; border-top: 2px solid #4d004d">
                              <hr style="width: 25vw; border-top: 3px dashed #ffffcc; margin-top: -13px;">
                              <hr style="width: 23vw; border-top: 2px solid #4d004d; margin-top: -13px;">
                         </p>

                         <table class="table table-striped mt-4 border border-white">
                              <thead class="text-center">
                                   <tr class="text-white" style="font-size:25px">
                                        <th>Task</th>
                                        <th>Action</th>
                                   </tr>
                              </thead>
                              <tbody class="text-white mt-3">
                                   <?php
                                   $data = $obj->displayTrashRecord();
                                   foreach ($data as $value) {
                                   ?>
                                   <tr>
                                        <td><?php echo $value['trash_task']; ?></td>
                                        <td>
                                             <a href="functions.php?trash_id=<?php echo $value['trash_id']; ?>" id="res" style="font-weight:bolder;"><i class='fas fa-trash-restore' style='font-size:23px;color:#90ee90;'></i> Restore</a>
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
  
  </html>
