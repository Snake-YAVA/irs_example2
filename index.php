<?php
	session_start();					//включаем сессии

	require 'includes/functions.php';	//здесь будет хранить различные функции, например, для работы с шаблонами
	$pageData = array();				//создаём массив


	$link = mysql_connect('localhost','gp8st10_db', '123456');	//Создаём подключение к Mysql
	mysql_select_db('gp8st10_db');		//Выбираем базу данных
	if (!$link) {						//Если не удалось соединиться с БД
	    die('Ошибка соединения: ' . mysql_error());	//Завершаем выполнение скрипта
	}

	switch ($_GET['page']) {			//смотрим какую страницу запросил пользователь в GET-запросе
		case 'about': //Обо мне
			$pageData['title'] = 'Обо мне';
			$pageData['content'] = template('about');
			break;
		case 'blog': //Блог
			$pageData['title'] = 'Блог';
			$result = mysql_query("SELECT * FROM articles LIMIT 50;"); 
			
			while($row = mysql_fetch_array($result)) {
				$pageData['content'] .= '<h2>' .$row['title'] .'</h2>' . $row['body'];	
			}

			if (isset($_SESSION['is_logged']))	//показываем форму, только авторизованым
				$pageData['content'] .= template('form-articles');



			break;
		case 'portfolio': //Портфолио
			$pageData['title'] = 'Портфолио';
			$pageData['content'] = template('portfolio');
			break;
		case 'contacts': //Контакты
			$pageData['title'] = 'Контакты';
			$pageData['content'] = template('contacts');
			break;
		case 'login': //Контакты
			$pageData['title'] = 'Войти на сайт';
			$pageData['content'] = template('login');
			break;	
		case 'logout':					//Нажал на кнопку Выход
			session_destroy();			//удаляем сессию пользователя
			 header("Location: /");
			break;		
		default:
			$pageData['title'] = 'Главная страница';
			$pageData['content'] = 'Содержимое главной страницы';
			break;
	}

	if (isset($_POST['login']) && isset($_POST['password'])) {
		if ($_POST['login'] == 'vitaliy' && $_POST['password'] == '123456') {	//сравниваем, с правильным паролем и логином
			$_SESSION['is_logged'] = true;						//сохраняем TRUE, если успешно авторизовался	
			$pageData['title'] = 'Войти на сайт';
			$pageData['content'] = 'Вы успешно авторизовались';					
		} else {
			$pageData['title'] = 'Войти на сайт';
			$pageData['content'] = 'Доступ запрещён';			
		}

	}

	if (isset($_POST['title']) && isset($_POST['body']) && isset($_POST['action'])) {
		if ($_POST['action'] == 'add-article') {
			$title = $_POST['title'];
			$body = $_POST['body'];
			$result = mysql_query("INSERT INTO articles (title, body) VALUES ('$title', '$body');");

			if (!$result) {						//Если не удалось соединиться с БД
			    die('Ошибка: ' . mysql_error());	//Завершаем выполнение скрипта
			}

			header('Location: /?page=blog');// Обновить страницу
		}
	}
	


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Мой блог</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript">

		</script>
	</head>
	<body>
		<div class="header">
			<?php echo template('header'); ?>
		</div>
		<div class="middle">
			<div class="left-block">
				<?php					
					$leftBlockData = array(
						'header' => 'Разделы блога',
						'items' => array('Спорт', 'Фильмы', 'Путешествия', 'Музыка', 'Ещё один')
					); 
					$leftBlockData2 = array(
						'header' => 'Мои фильмы',
						'items' => array('Фильм 1', 'Фильм 2')
					); 

					echo template('left-block', $leftBlockData);  // функция возвращает строку в виде: <h2>Заголовок</h2><ul>dfsd</ul>
					echo template('left-block', $leftBlockData2);			
				?>
			</div>

			<div class="content">
				<?php echo template('content', $pageData); ?>
			</div>
		</div>
		<div class="footer">
			Разработка сайта: <a href="https://vk.com/snake_yava">Ямасыпов Виталий</a>
		</div>
	</body>
</html>