<?php

Yii::import('application.components.behaviors.ListBehavior');

class OrtypeGroupBehavior extends ListBehavior
{
    const NONPROFIT = 1;
    const INFORMAL = 2;

    public function data()
    {
        return array(
            self::NONPROFIT => 'Объединения граждан',
            self::INFORMAL => 'Неформальные объединения',
        );
    }
}
