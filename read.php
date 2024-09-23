
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="read.css">
    <title>Document</title>
</head>
<body>
    <?php

        include "db.php";
        $db = connect();

        if(!$db){
            echo "Error connecting";
        }

        if($db){

            $querybook = $db->query("SELECT * FROM books");
            $query = $querybook->fetchAll(PDO::FETCH_ASSOC);

            

            if($query){

                echo "<table border='2'>";
                echo "<th>Id</th><th>Title</th><th>Author</th><th>Prodaction Date</th><th>Genre</th><th>Price</th>";
                
                foreach($query as $op){
                    
                    echo"<tr>";
                    echo "<td>" . $op['id'] . "</td>";
                    echo "<td>" . $op['title'] . "</td>";
                    echo "<td>" .$op['author'] . "</td>";
                    echo "<td>" .$op['published_date'] . "</td>";
                    echo "<td>" .$op['genre'] . "</td>";
                    echo "<td>" .$op['price'] . "</td>";
                    echo "<td><a href='update.php?id=" . $op['id']. "'>Edit</a></td>";
                    echo "<td><a href='delete.php?id=". $op['id'] ."'>Delete</a></td>"; 
                    echo"</tr>";
                }
                echo "</table>";
            }else{
                echo "No record Found";
            }
        }else{
            echo "Datad=base connection failed";
        }

            

    ?> 
    <form action="create.php">
        <button>Create</button>
    </form>
</body>
</html>


