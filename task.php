<?php

class taskList{
     private $servername = "localhost";
     private $username = "root";
     private $password = "";
     private $database = "archi";
     private $conn;
 
 
     public function __construct(){
             $this->conn = new mysqli($this->servername,$this->username,$this->password,$this->database);
             if($this->conn->connect_error){
                 echo "Unable to Connect";
             }else{
                 return $this->conn;
             }
         
     }

     public function insertRecord($post){
          $task = $post['task'];
          $sql = "INSERT INTO todo (task) VALUES ('$task')";
          $result = $this->conn->query($sql);
          if($result){
               header('location:functions.php?msg=ins');
          }else{
               echo "Error ".$sql."<br>".$this->conn->error;
          }
     }

     public function insertTrashRecord($post){
          $id = $_GET['deleteid'];
          $task = $post['trash_task'];
          $sql = "INSERT INTO trash (trash_task) SELECT task from todo WHERE id = $id ";
          $result = $this->conn->query($sql);
          if($result){
               header('location:functions.php?msg=ins');
          }else{
               echo "Error ".$sql."<br>".$this->conn->error;
          }
     }
   
     public function updateRecord($post){
          $task = $post['task'];
          $editid = $post['hid'];
          $sql = "UPDATE todo SET task='$task' WHERE id='$editid'";
          $result = $this->conn->query($sql);
          if($result){
               header('location:functions.php?msg=ups');
          }else{
               echo "Error ".$sql."<br>".$this->conn->error;
          }
     }
     
     public function displayRecord(){
          $sql = "SELECT * FROM todo";
          $result = $this->conn->query($sql);
          if($result->num_rows>0){
               while($row = $result->fetch_assoc()){
                    $data[] = $row;
               }
               return $data;
          }
     }

     public function displayTrashRecord(){
          $sql = "SELECT * FROM trash";
          $result = $this->conn->query($sql);
          if($result->num_rows>0){
               while($row = $result->fetch_assoc()){
                    $data[] = $row;
               }
               return $data;
          }
     }

     public function displayRecordById($editid){
          $sql = "SELECT * FROM todo WHERE id ='$editid'";
          $result = $this->conn->query($sql);
          if($result->num_rows==1){
               $row = $result->fetch_assoc();
               return $row;
          }
     }

     public function deleteRecord($delid){
          $sql = "DELETE FROM todo WHERE id='$delid'";
          $result = $this->conn->query($sql);
          if ($result){
               header('location:functions.php?msg=del');
          }else{
               echo "Error ".$sql."<br>".$this->conn->error;
          }
     }

     public function deleteTrash($del_id){
          $sql = "DELETE FROM trash WHERE trash_id='$del_id'";
          $result = $this->conn->query($sql);
          if ($result){
               header('location:trash.php?msg=del');
          }else{
               echo "Error ".$sql."<br>".$this->conn->error;
          }
     }

    public function restoreRecord($trash_id){
          $sql = "INSERT INTO todo (task) SELECT trash_task from trash WHERE trash_id = $trash_id ";
          $result = $this->conn->query($sql);
          if($result){
               header('location:functions.php?msg=ins');
          }else{
               echo "Error ".$sql."<br>".$this->conn->error;
          }

    }

    public function deleteTrashRecord($trash_id){
     $sql = "DELETE FROM trash WHERE trash_id='$trash_id'";
     $result = $this->conn->query($sql);
     if ($result){
          header('location:functions.php?msg=del');
     }else{
          echo "Error ".$sql."<br>".$this->conn->error;
     }
}
}
?>