<?php
session_start();

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an image.";
        header('Location: upload.php?error=FileNotImg');
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    header('Location: upload.php?error=FileAlreadyExists');
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    header('Location: upload.php?error=FileIsToBig');
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    header('Location: upload.php?error=FileWrongFormat');
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";

// if everything is ok, try to upload file
} else {
  
    include 'connect.php';
    try{

        $pdo->beginTransaction();
        $sql = "INSERT INTO Image (UID,Path,Title,Description,Likes,Dislikes,ViewCount,Privacy,Date) VALUES
        (?,?,?,?,?,?,?,?,?)";
        $st = $pdo->prepare($sql);
        $st->bindValue(1,$_SESSION["UID"]);
        $st->bindValue(2,$_FILES["fileToUpload"]["name"]);
        $st->bindValue(3,$_POST["imageName"]);
        $st->bindValue(4,$_POST["imageDesc"]);
        $st->bindValue(5,0);
        $st->bindValue(6,0);
        $st->bindValue(7,0);
        $st->bindValue(8,0);
        $st->bindValue(9,date("Y-m-d H:i:s"));

        try
        {
            $st->execute();
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
            {
                $pdo->commit();

                $sql = "SELECT ImageID from Image where Path = ?";
                $st = $pdo->prepare($sql);
                $st->bindValue(1,$_FILES["fileToUpload"]["name"]);
                
                $st->execute();

                $id = $st->fetch();
                echo "SQL: ".$sql;
                echo "The path is: ".$_FILES["fileToUpload"]["name"];
                echo "The ID is: ".$id["ImageID"];
                header('Location: image.php?img='.$id["ImageID"]);
            }
            else
            {
                $pdo->rollback();
            }
        }catch(exception $e){

            $pdo->rollback();
            
        }

        //header('Location: upload.php?img=pdoException');
    }
    catch(PDOException $e)
    {
        header('Location: upload.php?error=Exception');
        echo "Sorry, there was an error uploading your file.";
    }
    
} 

?>