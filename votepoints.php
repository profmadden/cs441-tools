<?php
include 'db.php';
include 'projnum.php';

function compute_average($cid, $entry)
{
      $sql = "SELECT * from review where entry=$entry";
      $rs2 = mysqli_query($cid, $sql);
      $count = 0;
      $rated = 0;
      while ($reviews = mysqli_fetch_array($rs2, MYSQLI_ASSOC))
      {
        # echo "Review of " . $reviews["score"] . "<br>\n";
	$count = $count + $reviews["score"];
        if ($reviews["score"] > 0)
          $rated = $rated + 1;
      }
      if ($rated > 0)
        $avg = $count / $rated;
      else
        $avg = 0;

      return $avg;
}



$sql = "select id, entry from submissions where project=$projnum";
echo $sql;
$submissions = mysqli_query($cid, $sql);

while ($submission = mysqli_fetch_array($submissions, MYSQLI_ASSOC))
{
  $avg = compute_average($cid, $submission["entry"]);
  $id = $submission["id"];
  $sql = "select fn, ln, email from users where id=$id";
  $userinfo = mysqli_query($cid, $sql);
  $user = mysqli_fetch_array($userinfo, MYSQLI_ASSOC);

  $fn = $user["fn"];
  $ln = $user["ln"];
  $entry = $submission["entry"];

  $cp = intval($avg/5.0 * 10 + 0.5);

  echo "User $fn $ln average $avg for entry $entry\t\t$cp\n";
  $sql = "update points set classpoints=$cp where entry=$entry";
  mysqli_query($cid, $sql);
}

?>

