<?php echo CHtml::link(
    CHtml::encode($data->name),
    array('search', 'Organization[type_id]' => $data->id)
); ?>

<br>
<br>
