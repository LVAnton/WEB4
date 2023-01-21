<?php 
	$file = simplexml_load_file("basa.xml");
	$id = $_GET['id'];
	foreach($file as $card){
		if ($id == $card->id){
			$name = $card->name;
			$cost = $card->cost;
			$info = $card->info;
			break;
		}
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST['registr'])){
		echo($id);
		$id = $_GET['id'];
		$name = $_POST["name"];
		$cost = $_POST["cost"];
		$info = $_POST["info"];
		$errors = 0;
		if(empty($_POST["name"])){
			echo("Как клиенты о вашем товаре без названия узнают!? <br>");
			$errors += 1;
		}else{
			foreach($file as $card){
				if($name == $card->name){
					echo("Такой товар так-то уже есть. Поменяйте название!<br>");
					$errors += 1;
					break;
				}
			}
		}
		if(empty($_POST["cost"])){
			echo("А когда нет цены, это бесплатный или бесценный? <br>");
			$errors += 1;
		}
		if(empty($_POST["info"])){
			echo("Ну хоть что-нибудь то расскажите о товаре, ато купят на вайлдберрисе, а не у вас <br>");
			$errors += 1;
		}
if($errors == 0){
		foreach($file as $card){
			if ($id == $card->id) {
				$name = $_POST["name"];
				$cost = $_POST["cost"];
				$info = $_POST["info"];
				$card->name = $name;
            $card->cost = $cost;
            $card->info = $info;
				$file->asXML("basa.xml");
				break;
			}
		}
		header("Location: http://localhost/web/update.php?id=$id");
	}
	$errors = 0;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>


<body>

	<form method="POST" action="update.php?id=<?php echo($id)  ?>">
		<label for="login">Название товара:</label>
      <input type="text" name="name" id='name' value="<?php echo($name) ?>"><br>
		<label for="login">Цена:</label>
      <input type="text" name="cost" id='cost' value="<?php echo($cost) ?>"><br>
		<label for="login">Описание:</label>
      <input type="text" name="info" id='info' value="<?php echo($info) ?>"><br>
		<div class="btn">
         <input type="submit" value="Обновить стратегически важную информацию" name="registr">
      </div>
	</form>

	<a href="http://localhost/web/index.php?id=<?php echo($id) ?>"> Вернуться к товарной карточке на index </a>
</body>
</html>