<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Images'=>array('index'),
    $model->id=>array('view','id'=>$model->id),
    'Update',
);
?>

<h1>Update Image <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
