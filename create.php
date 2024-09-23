<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h1>Welcome !</h1>
        <h4>Enter the title of the Book</h4>
        <input type="text" name="title">
        <h4>Enter the name of the author</h4>
        <input type="text" name="author">
        <h4>Enter the date when the book was published</h4>
        <input type="date" name="published_date">
        <h4>Enter the genre of the Book</h4>
        <input type="text" name="genre">
        <h4>Enter the price of the Book</h4>
        <input type="decimal" name="price"><br><br>
        <button type="submit">Create</button>
    </form>
</body>
</html>

<?php

    include "db.php";

    $db = connect();

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $title = $_POST['title'];
        $author = $_POST['author'];
        $published_date= $_POST['published_date'];
        $genre= $_POST['genre'];
        $price = $_POST['price'];

        if(!empty($title) && !empty($author) && !empty($published_date) && !empty($genre) && !empty($price)){

            $querybook = $db->prepare("INSERT INTO books (title, author, published_date, genre, price) VALUES(:title, :author, :published_date, :genre, :price)");

            if($querybook->execute([
                ":title"=>$title,
                ":author"=>$author,
                ":published_date"=>$published_date,
                ":genre"=>$genre,
                ":price"=>$price
            ])){
                header('Location: read.php');
                echo "Added successsfully";
            }else{
                echo "Error on the database ";
            }
        }else{
            echo "Enter all the informations";
        }  
    }else{
        echo "Error in the database";
    }

?>