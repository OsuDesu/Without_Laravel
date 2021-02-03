<?php
	if(!isset($_POST['save'])){
		include(PAGE.'404.php');
		die();
	}

	$name = mysqli_real_escape_string($db, $_POST['save'][0]);
	$surname = mysqli_real_escape_string($db, $_POST['save'][1]);
	$age = mysqli_real_escape_string($db, $_POST['save'][2]);
	
	$insert = $db->query("INSERT INTO peoples SET name='$name', surname='$surname', age='$age'");
	
	if($insert) return die(json_encode(array('y' => 'Информация добавлена в базу')));
	else return die(json_encode(array('n' => $db->error)));
?>