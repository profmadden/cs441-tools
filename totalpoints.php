<?php
include 'db.php';
include 'projnum.php';

$sql = "select id, entry from submissions where project=$projnum";
echo $sql . "\n";
$submissions = mysqli_query($cid, $sql);

while ($submission = mysqli_fetch_array($submissions, MYSQLI_ASSOC))
{
  $id = $submission["id"];
  $entry = $submission["entry"];

  $sql = "select * from users where id=$id";
  $userinfo = mysqli_query($cid, $sql);
  $user = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

  $fn = $user["fn"];
  $ln = $user["ln"];

  $sql = "select * from points where entry=$entry";
  $pq = mysqli_query($cid, $sql);
  $points = mysqli_fetch_array($pq, MYSQLI_ASSOC);

  $total = $points["readme"] + $points["screenshots"] + $points["gitlog"] + $points["commits"] + $points["voted"] + $points["classpoints"] + $points["presentation"];

  echo "$total points for $fn $ln (id $id, entry $entry)\n";
  $sql = "update points set total=$total where entry=$entry";
  mysqli_query($cid, $sql);
}

?>

