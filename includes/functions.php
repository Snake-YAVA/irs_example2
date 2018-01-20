<?php
/*
	Функции для работы с шаблонами	
*/

	/*
	Эта функция передаёт массив переменных в файл шаблона,
	возвращает в результате строку из html-тегов с "подставленными" переменными
	*/
	function template($templateName, $variablesArray = array()) {
		extract($variablesArray);
		ob_start();	
		include(__DIR__.'/../views/' . $templateName . '.tpl.php');
		$contents = ob_get_contents(); // данные сейчас здесь
		ob_end_clean();
		return $contents;
	}



?>