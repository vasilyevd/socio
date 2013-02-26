<?php
/**
 * The following variables are available in this template:
 * - $this: the BootCrudCode object
 */
?>
<h1>Создать <?php echo $this->modelClass; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model' => \$model)); ?>"; ?>
