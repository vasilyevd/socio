<?php

Yii::import('application.components.behaviors.ListBehavior');

class OrganizationActionAreaBehavior extends ListBehavior
{
    const NATION = 1;
    const REGION = 2;
    const DISTRICT = 3;
    const CITY = 4;
    const COUNTRY = 5;

    public function data()
    {
        return array(
            self::NATION => 'Национальная',
            self::REGION => 'Региональная',
            self::DISTRICT => 'Районная',
            self::CITY => 'Городская',
            self::COUNTRY => 'Всеукраинская',
        );
    }
}
