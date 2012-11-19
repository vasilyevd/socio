<?php echo $form->fileFieldRow($model,'logo'); ?>

<?php echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>128,'append'=>'<i class="icon-globe"></i>')); ?>

<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128,'append'=>'<i class="icon-envelope"></i>')); ?>
