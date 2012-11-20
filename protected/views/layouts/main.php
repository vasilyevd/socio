<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" rel="stylesheet">

        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-57-precomposed.png">
    </head>

    <body>
        <?php $this->widget('bootstrap.widgets.TbNavbar', array(
            // 'type'=>'inverse', // null or 'inverse'
            'brand'=>CHtml::encode(Yii::app()->name),
            'brandUrl'=>array('/site/index'),
            // 'fixed'=>false, // 'top', 'bottom' or false
            'collapse'=>false, // requires bootstrap-responsive.css
            'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'htmlOptions'=>array('class'=>'pull-right'),
                    'items'=>array(
                        array('label'=>Yii::app()->user->isGuest ? 'Пользователь' : Yii::app()->user->name, 'icon'=>'user', 'url'=>'#', 'items'=> array(

                            Yii::app()->user->isGuest ? array('template'=>'
                            <div class="row-fluid">
                            <form method="post" action="/person/auth" id="login-form" style="padding: 0 5px; margin: 0;">

                            <input type="text" id="PersonUser_email" name="PersonUser[email]" placeholder="Логин" maxlength="255" class="input-medium span">
                            <input type="password" id="PersonUser_password" name="PersonUser[password]" maxlength="255" placeholder="Пароль" class="input-medium span" >

                             <button type="submit" class="btn btn-small btn-block" style="margin-top: 0;">Вход</button>
                            <label class="checkbox" style="color: black;"><input type="checkbox" value="1" id="PersonUser_rememberMe" name="PersonUser[rememberMe]"> Запомнить
                            </label>


                            </form></div>', 'url'=>'#') : array(),

                            array('label'=>'Профиль', 'url'=>array('/user/view', 'id'=>Yii::app()->user->id), 'visible'=>!Yii::app()->user->isGuest),

                            array('label'=>'Пользователи', 'url'=>array('/user/admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                            '---',
                            array('label'=>'Регистрация', 'url'=>array('/person/auth/register'), 'visible'=>Yii::app()->user->isGuest),
                            array('label'=>'Выход', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                        ),
                        ),
                    ),
                ),
                    array(
                        'class'=>'bootstrap.widgets.TbMenu',
                        'htmlOptions'=>array('class'=>'pull-right'),
                        'items'=>array(
                            array('label'=>'Организации', 'icon'=>'globe', 'url'=>array('/organization/index')),
                            array('label'=>'Доступность', 'icon'=>'list-alt', 'url'=>'http://sddf.ru', 'items'=>array(
                                array('label'=>'Карта', 'url'=>'#'),
                                array('label'=>'Инфраструктура', 'url'=>'#'),
                            )),
                            array('label'=>'Справка', 'url'=>array('/site/page', 'view'=>'faq')),
                            array('label'=>'О проекте', 'icon'=>'star', 'url'=>array('/site/about', 'page'=>'comanda')),
                        ),
                    ),

            ),
        ));

        // item hidden
        /*
         '<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Поиск"></form>',
         */
        ?>

        <?php if(!empty($this->breadcrumbs)): ?>
            <div class="breadcrumbs-wrap">
                <div class="container">
                    <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                        'links'=>$this->breadcrumbs,
                        'separator'=>'>',
                    )); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="container content">
            <?php echo $content; ?>
        </div>

        <div class="footer">
            <div class="container">
                <p>&copy; <?php echo date('Y'), " ", CHtml::encode(Yii::app()->name); ?></p>
                <p>Все права защищены</br><?=sprintf('%0.5f',Yii::getLogger()->getExecutionTime())?> с. <? echo round(memory_get_peak_usage()/(1024*1024),2)."MB - "?>
                    <?php $ardb=Yii::app()->db->getStats(); echo $ardb[0]." - ".$ardb[1]; ?>
                </p>

                <ul>
                    <li><a href="http://example.com">Главная</a></li>
                    <li><a href="http://example.com">Обратная связь</a></li>
                    <li class="pull-right"><a href="#">Наверх</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>
