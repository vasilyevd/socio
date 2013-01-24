<?php
$this->breadcrumbs=array(
    'Catorganizations'=>array('index'),
    $model->name,
);
?>

<p>ТУТ кнопки: [Update] [Delete]<p>
<p>ТУТ кнопки: [Update] [Delete]<p>
<p>ТУТ кнопки: [Update] [Delete]<p>

<h1><?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'name',
        'registration_date',
        'address',
        'address_id',
        'city_id',
        'region_id',
        'chief_fio',
        'registration_num',
        'phone',
        'website',
        'email',
        'organization_id',
        'is_legal',
        'action_area',
        'directions_more',
        'logo',
        'is_branch',
        'branch_master',
        'is_verified',
    ),
)); ?>
