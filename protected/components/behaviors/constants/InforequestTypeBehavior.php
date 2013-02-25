<?php

Yii::import('application.components.behaviors.ListBehavior');

class InforequestTypeBehavior extends ListBehavior
{
    const ACTIVE = 1;
    const INACTIVE = 2;
    const MODERATION = 3;

    public function data()
    {
        return array(
            self::ACTIVE => 'Активна',
            self::INACTIVE => 'Неактивна',
            self::MODERATION => 'Модерируется',
        );
    }
}
