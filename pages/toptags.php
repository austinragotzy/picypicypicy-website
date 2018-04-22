<?php
  include 'connect.php';

  try {
    $sql = 'SELECT * FROM (SELECT t.TagID AS TID, Tag, count(Tag) as num FROM ImageTags as i join Tags as t on i.TagId = t.TagID GROUP BY Tag) AS temp ORDER BY num DESC';
    $tags = $pdo->prepare($sql);
    $tags->execute();
  } catch (PDOException $e) {
    $e->getMessage();
  }
  for($i=0; $i<3; $i++){
    $topTags[] = $tags->fetch();
  }

?>
