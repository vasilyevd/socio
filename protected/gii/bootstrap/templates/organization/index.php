<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<h1><?php echo $this->pluralize($this->class2name($this->modelClass)); ?></h1>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
