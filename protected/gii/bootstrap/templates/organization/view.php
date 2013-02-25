<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<h1><?php echo $this->modelClass." #<?php echo \$model->{$this->tableSchema->primaryKey}; ?>"; ?></h1>

<?php echo "<?php"; ?> $this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
<?php
foreach($this->tableSchema->columns as $column)
    echo "        '".$column->name."',\n";
?>
    ),
)); ?>
