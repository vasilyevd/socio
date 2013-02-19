<h1>Inforequest #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'description',
        'type',
        'create_time',
        'send_date',
        'receive_date',
        'finished_status',
        'user_id',
        'sender_id',
        'sender_type',
        'receiver_id',
    ),
)); ?>
