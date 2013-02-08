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
			$menu = $this->beginWidget('zii.widgets.TbMenu', array(
					'type'=>'pills',
					//'htmlOptions'=>array('class'=>'nav-pills'),
					'items'=>array(
						array('label'=>'Люди',
						    'url'=>'',
						),
						array('label'=>'Общение',
						    'url'=>'',
						),
						array('label'=>'Общество',
							'url'=>array('/organization/index'),
							'active'=>$this->sectionMain == 'org',
							'items'=>array(
								array('label'=>'Главная', 'url'=>array('/organization/index'), 'active'=>$this->sectionMainSub=='main'),
								array('label'=>'Организации', 'url'=>array('/organization/search'), 'active'=>$this->sectionMainSub=='org',
									'items'=>array(
										array('label'=>'На сайте',
										    'url'=>array('/organization/search'),
										),
										array('label'=>'Каталог',
										    'url'=>'',
										),
									)
								),
								array('label'=>'Власть', 'url'=>'', 'active'=>$this->sectionMainSub=='gov'),
								array('label'=>'Бизнес', 'url'=>'', 'active'=>$this->sectionMainSub=='commerce'),
								array('label'=>'СМИ', 'url'=>'', 'active'=>$this->sectionMainSub=='smi'),
								array('label'=>'Открытость', 'url'=>array('#'), 'active'=>$this->sectionMainSub=='open'),
							)
						),
						array('label'=>'Медиа',
						    'url'=>'',
						),
						array('label'=>'Инфраструктура',
							'url'=>'',
							'active'=>$this->sectionMain == 'inf'
						),
						'',
						array('label'=>'Доступность',
							'url'=>array('/object/main'),
							'active'=>$this->sectionMain == 'obj',
							'items'=>array(
								array('label'=>'Главная', 'url'=>array('/object/main'), 'active'=>$this->sectionMainSub=='main'),
								array('label'=>'Карта', 'url'=>array('/map/index'), 'active'=>$this->sectionMainSub=='map'),
								array('label'=>'Инфраструктура', 'url'=>'', 'active'=>$this->sectionMainSub=='infrastructure'),
								array('label'=>'Территории', 'url'=>'', 'active'=>$this->sectionMainSub=='teritory'),
								array('label'=>'Информация', 'url'=>array('/info'), 'active'=>$this->sectionMainSub=='info',
									'items'=>array(
										array('label'=>'Законы',
										    'url'=>'',
										),
										array('label'=>'О доступности',
										    'url'=>array('/info/index'),
										),
										array('label'=>'Практика',
										    'url'=>'',
										),
										array('label'=>'Коммитеты',
										    'url'=>'',
										),
									)
								),
								array('label'=>'Статистика', 'url'=>'', 'active'=>$this->sectionMainSub=='stat',
									'items'=>array(
										array('label'=>'Статистика',
										    'url'=>'',
										),
										array('label'=>'Динамика',
										    'url'=>'',
										),
									)
								),
							)
						),
						array('label'=>'Инваменю',
						    'url'=>'',
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

			foreach ($menu->items as $key=>$item) {
				if ($item['active'] && !empty($item['items'])) {
					$this->_subMenu = $item['items'];
				}
				unset($menu->items[$key]['items']);
			}

			$this->endWidget();
			?>
		</div>
	</div>

	<div id="section-header" style="background: none repeat scroll 0 0 #CECECE; height: 110px; margin-bottom: 10px;">
		<div class="container" style="position: relative;">
			<div class="mainlogo" style="float: left;">
				<?=CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/logo.png', 'logo', array('style'=>'padding: 16px;')), '/', array('style'=>'outline:none;')); ?>
			</div>

			<div id="collapse_submenu" class="" style="bottom: 0; left: 200px; padding-left: 20px; position: absolute;">
			<?php
			if (isset($this->_subMenu)) {
				$menu_sub = $this->beginWidget('zii.widgets.TbMenu', array(
						'type'=>'pills',
						'items' => $this->_subMenu,
					));

				foreach ($menu_sub->items as $key=>$item) {
					if ($item['active'] && !empty($item['items'])) {
						$this->_subsubMenu = $item['items'];
					}
					unset($menu_sub->items[$key]['items']);
				}

				$this->endWidget();
			}
			?>
			</div>

		</div>
	</div>


	<div class="content container <?php echo $this->contentClass; ?>">
		<div id="subsubmenu">
			<?php
			if (isset($this->_subsubMenu)) {
				$this->widget('zii.widgets.TbMenu', array(
						'type'=>'tabs',
						'items' => $this->_subsubMenu,
					));
			}
			?>
		</div>
		<?php echo $content; ?>
	</div>

	<div id="footer" class="footer text-mini">
		<div class="container"><div class="row">

			<div class="span3 copyright">
				<?php echo CHtml::image($this->createUrl('images/logow.png'), 'Logo', array('class'=>'logo')); ?>
				<p>Copyright &copy; <?php echo date('Y'), ". All Right Reserved" ?></p>
				<p><em>Условия</em> и <em>Политика конфиденциальности</em> в соответствии с которыми наши услуги предоставляются для Вас</p>
			</div>

			<div class="span6">
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

			<div class="span3 tac">
				<?=CHtml::image($this->createUrl('images/other/coalition128.png'), 'Logo', array('style'=>'width: 110px;')); ?>
				<?=CHtml::image($this->createUrl('images/other/aemb128.gif'), 'Logo', array('style'=>'width: 110px;')); ?>
				<?=CHtml::image($this->createUrl('images/other/irf.jpg'), 'Logo'); ?>
				<?=CHtml::image($this->createUrl('images/other/prometei.png'), 'Logo'); ?>

			</div>

			<div class="span12 tac">
			</div>
			</div></div>
	</div>
<div>
	T: <?=sprintf('%0.5f',Yii::getLogger()->getExecutionTime())?> с.,
	M: <? echo round(memory_get_peak_usage()/(1024*1024),2)."MB"?>,
	DB: <?php print_r(Yii::app()->db->getStats()); ?>
</div>

</body>
</html>
