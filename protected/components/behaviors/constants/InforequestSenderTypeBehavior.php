<?php

Yii::import('application.components.behaviors.ListBehavior');

class InforequestSenderTypeBehavior extends ListBehavior
{
    const USER = 1;
    const ORGANIZATION = 2;
    const BIZORGANIZATION = 3;

    public function data()
    {
        return array(
            self::USER => 'Обращение Граждан',
            self::ORGANIZATION => 'Обращение Общественных Организаций',
            self::BIZORGANIZATION => 'Обращение Коммерческих Организаций',
        );
    }
}
