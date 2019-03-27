<?php
include 'db.php';

$project = 4;
$sql = "delete from ranking where project=$project";
$rs = mysqli_query($cid, $sql);

$sql = "select entry, project, classnumber, id, title from submissions where project=$project";
$submissions = mysqli_query($cid, $sql);

while ($submission = mysqli_fetch_array($submissions, MYSQLI_ASSOC))
{
  $id = $submission["id"];
  $sql = "select fn, ln, email from users where id=$id";
  $userinfo = mysqli_query($cid, $sql);
  $user = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

  $entry = $submission["entry"];
  $total = 0;
  $sql = "select * from review where entry=$entry";
  $rs2 = mysqli_query($cid, $sql);
  $count = 0;
  $name = $user["fn"] . $user["ln"];
  echo "Submission $entry from $name\n";
  $nz = 0;
  while ($reviews = mysqli_fetch_array($rs2, MYSQLI_ASSOC))
  {
    echo "Review of " . $reviews["score"] . "<br>\n";
    $count = $count + $reviews["score"];
    if ($reviews["score"] > 0)
      $nz = $nz + 1;
  }
  echo "Total number of thumbs-up: " . $count . "<br>\n";
  echo "Number of non-zero: $nz\n";

  if ($nz > 0)
    $count = intval(($count * 100)/$nz);
  echo "Final score: $count\n";
  $project = $submission["project"];
  $classnumber = $submission["classnumber"];
  $title = $submission["title"];

  $sql = "insert into ranking(entry, authorid, authorname, title, project, classnumber, points) values ($entry, $id, '$name', '$title', $project, $classnumber, $count)";
  $tmp = mysqli_query($cid, $sql);
}

?>
