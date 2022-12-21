<?php
//initiates score and the different values from the html file
$q_score = $_POST['quality'];
$feedback_txt = $_POST['suggestion'];
$conn = mysqli_connect("localhost", "root","", "practice");
$query ="insert into feedback(quality_score, feedback)values($q_score, '$feedback_txt')"; //queries the database for the values of score and the input of feedback_txt
$result = mysqli_query($conn, $query); 
if($result)//echoes text for result approved or unable to follow through
  echo 'Thank you for your feedback.';
else
die("Something terrible happened. Please try again. ");

?>
