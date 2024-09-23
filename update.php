<?php

    include "db.php";

    $db = connect();

    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $queryfetch = $db->prepare('SELECT * FROM books WHERE id= :id');
        $queryfetch->execute(["id"=>$id]);
        $query = $queryfetch->fetch(PDO::FETCH_ASSOC);

        if(!$query){
            echo "No id provided";
            exit;
        }
    }else{
        echo "Database error";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $title = $_POST["title"];
        $author = $_POST["author"];
        $published_date = $_POST["published_date"];
        $genre = $_POST["genre"];
        $price = $_POST["price"];

        if(!empty($title) && !empty($author) && !empty($published_date) && !empty($genre) && !empty($price)){
            $updatebook = $db->prepare('UPDATE books SET title = :title, author= :author, published_date= :published_date, genre= :genre, price= :price WHERE id = :id');
            $update = $updatebook->execute([
                "title"=>$title,
                "author"=>$author,
                "published_date"=>$published_date,
                "genre"=>$genre,
                "price"=>$price,
                "id"=>$id
            ]);

            if($update){
                header('Location: read.php');
            }else{
                echo "rppr";
            }

        }else{
            echo "Update the informations";
        }
    }else{
        echo "Error in the database";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update.css">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <h1>Update the informations</h1>
        <h4>Update the title</h4>
        <input type="text" name="title" value="<?php echo $query['title'] ?>">
        <h4>Update the name of the author</h4>
        <input type="text" name="author" value="<?php echo $query['author'] ?>">
        <h4>Update the date od publication</h4>
        <input type="date" name="published_date" value="<?php echo $query['published_date'] ?>">
        <h4>Update the genre of the book</h4>
        <input type="text" name="genre" value="<?php echo $query["genre"] ?>">
        <h4>Update the price</h4>
        <input type="text" name="price" value="<?php echo $query["price"] ?>">
        <input type="submit" value="Update">
    </form>
</body>
</html>