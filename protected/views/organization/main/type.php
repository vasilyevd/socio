<?php echo CHtml::link(
    CHtml::encode($data->name),
    array('search', 'Organization[type]' => $data->id)
); ?>

<br>
<br>
