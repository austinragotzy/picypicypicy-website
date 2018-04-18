<?php

include 'connect.php';

try
{
    $sql = "SELECT * FROM image";
    $st = $pdo->prepare($sql);
    $st->execute();

    while($row = $st->fetch())
    {
        $images[] = $row;
    }

    
}
catch (PDOException $e)
{   

}

?>