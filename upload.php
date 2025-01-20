<?php

include('dbconnection.php');
$uploadOk = 1;
if (isset($_POST['submit'])){
    $file_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    $path = 'images/'.$file_name;

    $check = getimagesize($temp_name);

    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        } else {
        echo "File is not an image.";
        $uploadOk = 0;
        }
    
    if($uploadOk){
        $query = mysqli_query($con,"insert into images (file) values ('$file_name')");

        if (move_uploaded_file($temp_name, $path)){
            echo '<h2>File uploaded successfully</h2>';
        }
        else{
            echo '<h2>Error with upload</h2>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" action="">
    <input type="file" name="image" id="">
    <br>
    <button type="submit" name="submit">Submit</button>
    </form>
    <div>
        <?php
            $res = mysqli_query($con, "select * from images");
            while ($row = mysqli_fetch_assoc($res)) :
        ?>
        <img src="images/<?= $row['file'] ?>" alt="">
        <?php endwhile ?>
    </div>
</body>
</html>