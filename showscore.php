<?php

include 'db.php';
include 'projnum.php';

echo "CLASS ZERO\n";
$class = 0;
$sql = "select * from ranking where project=$projnum and classnumber=$class order by points desc limit 10";
$rs = mysqli_query($cid, $sql);

while ($ranked = mysqli_fetch_array($rs, MYSQLI_ASSOC))
{
  echo $ranked["points"] . " points for " . $ranked["authorname"] . " " . $ranked["title"] . " id " . $ranked["authorid"] . " entry " . $ranked["entry"] . "\n";
  $id = $ranked["authorid"];
  $sql = "select email from users where id=$id";
  $rs2 = mysqli_query($cid, $sql);
  $em = mysqli_fetch_array($rs2, MYSQLI_ASSOC);
  echo "Email " . $em["email"] . "\n";
  $ent = $ranked["entry"];
  
  echo "insert into bonus (groupnum, entry, id) values (X, $ent, $id);\n";
}


echo "CLASS ONE\n";
$class = 1;
$sql = "select * from ranking where project=$projnum and classnumber=$class order by points desc limit 10";
$rs = mysqli_query($cid, $sql);

while ($ranked = mysqli_fetch_array($rs, MYSQLI_ASSOC))
{
  echo $ranked["points"] . " points for " . $ranked["authorname"] . " " . $ranked["title"] . " id " . $ranked["authorid"] . " entry " . $ranked["entry"] . "\n";
  $id = $ranked["authorid"];
  $sql = "select email from users where id=$id";
  $rs2 = mysqli_query($cid, $sql);
  $em = mysqli_fetch_array($rs2, MYSQLI_ASSOC);
  echo "Email " . $em["email"] . "\n";

  $ent = $ranked["entry"];
  
  echo "insert into bonus (groupnum, entry, id) values (X, $ent, $id);\n";
}

?>
