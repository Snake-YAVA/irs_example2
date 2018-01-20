<?php
	session_start();
?>

			<img class="logo" src="http://ирсиб.рф/images/2.png">
			<ul class="main-menu">
				<li><a href="/">Главная</a></li>
				<li><a href="?page=about">Обо мне</a></li>
				<li>
					<a href="?page=portfolio">Портфолио</a>
					<ul>
						<li>
							<a href="">Разработка сайтов</a>
							<ul>
								<li><a href="">Лэндинги</a></li>
								<li><a href="">Корпоративные сайты</a></li>
								<li><a href="">Интернет-магазины</a></li>
								<li><a href="">Порталы</a></li>		
							</ul>
						</li>
						<li><a href="">Дизайн</a></li>
						<li><a href="">SEO-продвижение</a></li>
						<li>
							<a href="">SMM</a>
							<ul>
								<li><a href="">Таргетированная реклама</a></li>
								<li><a href="">Боты</a></li>
							</ul>							
						</li>
					</ul>
				</li>
				<li><a href="?page=blog">Блог</a></li>
				<li><a href="?page=contacts">Контакты</a></li>
				
				<?php if (isset($_SESSION['is_logged'])): ?>
					<li><a href="?page=logout">Выйти</a></li>
				<?php else: ?>
					<li><a href="?page=login">Войти</a></li>
				<?php endif; ?>

			</ul>
			 	