<?php /** @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/socio.css" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico">
</head>
<body>
	<div id="main-header" class="container">
		<div id="user-menu-block" style="height: 50px;">
			<div id="user-top" class="user-top">
				<?php
				$this->widget('bootstrap.widgets.TbMenu', array(
						'htmlOptions'=>array('class'=>'pull-right'),
						'items'=>array(

	array(
		'label'=>Yii::app()->user->isGuest ? 'Войти' : Yii::app()->user->name,
		'linkOptions'=>array('class'=>'username'),
		'url'=>'#',
		'items'=> array(
				Yii::app()->user->isGuest ? array('template'=>'
                            <div class="row-fluid">
                            <form method="post" action="/person/auth" id="login-form" style="padding: 0 5px; margin: 0;">
                            <input type="text" id="PersonUser_email" name="PersonUser[email]" placeholder="Логин" maxlength="255" class="input-medium span">
                            <input type="password" id="PersonUser_password" name="PersonUser[password]" maxlength="255" placeholder="Пароль" class="input-medium span" >
                             <button type="submit" class="btn btn-small btn-block" style="margin-top: 0;">Вход</button>
                            <label class="checkbox" style="color: black;"><input type="checkbox" value="1" id="PersonUser_rememberMe" name="PersonUser[rememberMe]"> Запомнить
                            </label>
                            </form></div>', 'url'=>'#') : array(),

				array(
					'label'=>'Профиль',
					'url'=>array('/user/view', 'id'=>Yii::app()->user->id),
					'visible'=>!Yii::app()->user->isGuest),
				array(
					'label'=>'Пользователи',
					'url'=>array('/user/admin'),
					'visible'=>Yii::app()->user->checkAccess('admin')),
				'---',
				array(
					'label'=>'Регистрация',
					'url'=>array('/person/auth/register'),
					'visible'=>Yii::app()->user->isGuest),
				array(
					'label'=>'Выход',
					'url'=>array('/site/logout'),
					'visible'=>!Yii::app()->user->isGuest),
		),
	),
	),
				));

				?>
			</div>
			<!-- Меню быстрого доступа пользователя -->
		</div>
		<div id="main-menu" style="height: 25px; margin: 10px 0;">
			<!-- MAIN MENU -->
			<?php
			$this->widget('bootstrap.widgets.TbMenu', array(
							'htmlOptions'=>array('class'=>'nav-pills'),
							'items'=>array(
								array('label'=>'Организации',
									'url'=>array('/organization/index'),
									'active'=>$this->sectionMain == 'org'
								),
								array('label'=>'Доступность',
									'url'=>array('/object/main'),
									'active'=>$this->sectionMain == 'obj'
								),
								array('label'=>'Инфраструктура',
									'url'=>array('/object/index'),
									'active'=>$this->sectionMain == 'inf'
								),
								'',
								array('label'=>'Справка',
									'url'=>array('/site/page', 'view'=>'faq'),
								),
								array('label'=>'О проекте',
									'url'=>array('/site/about', 'page'=>'comanda'),
									'active'=>$this->sectionMain == 'about'
								),
							),
				));

			?>
		</div>
	</div>

	<div id="section-header" style="background: none repeat scroll 0 0 #CECECE; height: 110px; margin-bottom: 10px;">
		<div class="container">
			<div class="mainlogo" style="">
				<?=CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/logo.png', 'logo', array('style'=>'padding: 13px;')), '/', array('style'=>'outline:none;')); ?>
			</div>
		</div>
	</div>

	<div class="content container">
		<?php echo $content; ?>
	</div>

	<div id="footer" class="footer text-mini">
		<div class="container"><div class="row">

			<div class="span3 copyright">
				<? echo CHtml::image('/images/logow.png', 'logo', array('class'=>'logo')); ?>
				<p>Copyright &copy; <?php echo date('Y'), ". All Right Reserved" ?></p>
				<p><em>Условия</em> и <em>Политика конфиденциальности</em> в соответствии с которыми наши услуги предоставляются для Вас</p>
			</div>

			<div class="span7">
				<div class="text-block">
				<p class="topic-pre">Что такое SOCIO?</p>
				<p class="topic">Социальная платформа для общения, самовыражения и самореализации</p>
				<p class="em">Вырази себя в широком спектре общественной жизни - люди, семьи, публичные личности, эксперты, сообщества, фото, видео, музыка, газеты, публикации, оффициальные страницы организаций и общественных объединений, государственная и общественная инфраструктура и многое другое...</p>
				</div>
				<div class="text-block">
					<p class="topic-pre">Раскажи о нас</p>
					<p>Иконки других социальных сетей </p>
				</div>
				<div class="link-menu tar">
				<?=CHtml::link('Карта сайта', '#'); ?>
				<?=CHtml::link('Отзывы и предложения', '#'); ?>
				<?=CHtml::link('Связаться с нами', '#'); ?>
				</div>
			</div>

			<div class="span2">
				<?=CHtml::image('/images/other/coalition128.png'); ?>
				<?=CHtml::image('/images/other/prometei128.png'); ?>
			</div>


			</div></div>
	</div>

</body>
</html>
