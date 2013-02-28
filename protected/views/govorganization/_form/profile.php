<?php $this->widget('ext.widgets.RelationAjaxSelect2Row.RelationAjaxSelect2Row', array(
    'model' => $model,
    'attribute' => 'parent',
    'relationAttributeText' => 'name',
    'form' => $form,
    'url' => $this->createUrl('select/govorganizationSelectSearch'),
)); ?>
