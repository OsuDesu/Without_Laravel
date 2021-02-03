<?php
	if(!isset($_POST['upload'])){
		include(PAGE.'404.php');
		die();
	}

	// Подключаем API
	include(ROOT.'/vendor/autoload.php');
	
	// Достаем ключ доступа из файла
	$googlekey = ROOT.'/library/task-2-295819-0a1f57432c70.json';
	putenv('GOOGLE_APPLICATION_CREDENTIALS=' . $googlekey);
	
	// Создаем клиент
	$client = new Google_Client();
	$client->useApplicationDefaultCredentials();
	$client->addScope('https://www.googleapis.com/auth/spreadsheets');
	
	$service = new Google_Service_Sheets($client);
	$spreadsheetId = '1lnniy3IRpOi2v0E1HQo1JTVn5oZS478DwVHROLOqPpY';
	
	// Заглавные поля в таблицах
	$values = [
		["Name", "Surname", "Age"],
	];
	
	$res = $db->query('SELECT * FROM peoples WHERE age > 18');
	$i = 1;
	while ($row = mysqli_fetch_array($res)) {
		$values[$i++] = [$row['name'], $row['surname'], $row['age']];
	}
	
	$db->close();

	if(!isset($values[1]))
		return die(json_encode(array('В базе нет людей старше 18 лет, для выгрузки их в Google Docs')));

	$valuerange = new Google_Service_Sheets_ValueRange(['values' => $values]);
	
	$service->spreadsheets_values->update($spreadsheetId, 'List', $valuerange, ['valueInputOption' => 'USER_ENTERED']);
	
	return die(json_encode(array('Информация была добавлена в Google Docs')));
?>