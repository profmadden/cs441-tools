<?php
include 'db.php';
include 'projnum.php';

$sql = "delete from points where project=$projnum";
$rs = mysqli_query($cid, $sql);

$sql = "select entry, project, classnumber, id, title, data1, markdown, gitlog from submissions where project=$projnum";
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
  $name = $user["ln"] . " " . $user["fn"];

  while ($reviews = mysqli_fetch_array($rs2, MYSQLI_ASSOC))
  {
    # echo "Review of " . $reviews["score"] . "<br>\n";
    $count = $count + $reviews["score"];
  }
  #echo "Submission $entry  $name\n";
  echo "$name : Entry $entry : $count \n";

  $count = substr_count($submission["gitlog"], "Date:");
  echo "$count check-ins<br>\n";
  # Patterns like Date: Wed Jan 30
  $gla = preg_split('/$\R?^/m', $submission["gitlog"]);
  $glines = count($gla);
  # echo "GIT log has $glines lines<br>\n";
  $i = 0;
  $prevdate = "";
  $uniq = 0;
  foreach ($gla as $line)
  {
    $n = sscanf($line, "Date: %s %s %d", $day, $month, $date);
    # echo "Line $line<br>\nDates $dates<br>\n";
    if ($n == 3)
    {
      # echo "Saw date $day $month $date<br>\n";
      if (strcmp($prevdate, $date) != 0)
      {
        $uniq = $uniq + 1;
        # echo "Unique<br>\n";
      }
      $prevdate = $date;
    }
  }

  echo "$uniq different days of coding.\n\n";

  $sql = "select score from review where reviewid=$id and project=$projnum and score>0";
  $votes = mysqli_query($cid, $sql);
  if (mysqli_num_rows($votes) > 0)
     $voted = 10;
  else
     $voted = 0;
  $voted = 10;

  if (strlen($submission["markdown"]) > 10)
    $readme = 10;
  else
    $readme = 0;
  if (strlen($submission["data1"]) > 5)
    $screenshots = 10;
  else
    $screenshots = 0;
  if ($uniq > 0)
    $gitlog = 10;
  else
    $gitlog = 0;
  if ($uniq > 2)
    $commits = 40;
  else
    $commits = 30;

  $classpoints = 10;
  $presentation = 0;
  
  echo "readme $readme screen $screenshots gitlot $gitlog commits $commits voted $voted classpoints $classpoints\n";

  $total = $readme + $screenshots + $gitlog + $commits + $voted + $classpoints + $presentation;


  $sql = "insert into points(id, entry, project, readme, screenshots, gitlog, commits, voted, classpoints, presentation, total) values ($id, $entry, $projnum, $readme, $screenshots, $gitlog, $commits, $voted, $classpoints, 0, $total)";
  echo $sql;
  $tmp = mysqli_query($cid, $sql);
  
}

?>

