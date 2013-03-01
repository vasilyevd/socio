<?php

Yii::import('application.components.behaviors.ListBehavior');

class InforequestFinishedStatusBehavior extends ListBehavior
{
    const ARRIVED = 1;
    const NOT_ARRIVED = 2;
    const UNKNOWN = 3;

    public function data()
    {
        return array(
            self::ARRIVED => 'Пришел',
            self::NOT_ARRIVED => 'Не пришел',
            self::UNKNOWN => 'Неизвестно',
        );
    }
}
