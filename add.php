<?php
//add.php

include('database_connection.php');

$response = file_get_contents('http://localhost:8080/userId');
$JSONO=json_decode($response);


$reb= $JSONO[0]->userId;

$response1 = file_get_contents('http://localhost:8080/repoId');
$JSON1=json_decode($response1);


//$reb1= $JSON1[0]->pid;

// for userId
$res=(int)$reb;
// for repoId
//$res1=(int)$reb1;


 $name  => $_POST['name'],
 $pid => $_POST['pid'],
 $type => $_POST['type'],
 $fileC => $_POST['fileC']

	
$RID1=$_POST['pid'];
echo $RID1;

	$query = "
 INSERT INTO fileStructure (name, pid,type,fileC,userId,repoId) VALUES ('$name','$pid','$type', '$fileC','$res','$RID1')
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
 echo 'Category Added';
}



?>
