<?php
session_start();

include 'connect.php';
$connect = getDBConnection("Lab9");

$score = $_POST['score'];

//Adding new score to database
$sql = "INSERT INTO scores (username, score) VALUES (:username, :score)";

$stmt = $connect->prepare($sql);
$stmt->bindParam(":username", $_SESSION['username']);
$stmt->bindParam(":score", $score);
$stmt->execute();

//Retrieving total times quiz has been submitted and average score for this user
$sql = "SELECT count(1) times, avg(score) average FROM scores WHERE username = :username";

$stmt = $connect->prepare($sql);
$stmt->bindParam(":username",$_SESSION['username']);
$stmt->execute();
$result = $stmt->fetch();

//Encoding data using JSO
echo json_encode($result);

?>