<?php

    include "db.php";

    $db = connect();

    if(!$db){
        echo "Error";
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $deletequery = $db->prepare('DELETE FROM books WHERE id= :id');
        $delete = $deletequery->execute(["id"=>$id]);

        if($delete){
            header('Location: read.php');
            echo "Delete";
        }else{
            echo "Error";
        }
    }else{
        echo "Database failed";
    }

?>