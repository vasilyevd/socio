<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

<?php echo $form->dropDownListRow($model,'type',Lookup::items('OrganizationType'),array('prompt'=>'')); ?>

<?php echo $form->dropDownListRow($model,'action_area',Lookup::items('OrganizationActionArea'),array('prompt'=>'')); ?>

<?php echo $form->dropDownListRow($model,'direction',Lookup::items('OrganizationDirection'),array('multiple'=>true)); ?>

<?php echo $form->dropDownListRow($model,'problem',CHtml::listData(Lookup::itemsListReplace('ProblemGroup', Problem::model()->findAll(), 'group'), 'id', 'name', 'group'),array('multiple'=>true)); ?>
