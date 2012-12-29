<?php echo $form->labelEx($model,'files'); ?>
<?php $this->widget('CMultiFileUpload', array(
    // Upload handler.
    'model' => $model,
    'attribute' => 'files',
    // 'accept' => 'jpeg|jpg|gif|png',
    // 'denied' => 'Неверный тип файла загрузки.',
    'duplicate' => 'Дубликат файла загрузки.',
)); ?>
<?php echo $form->error($model,'files'); ?>
<?php if(!empty($model->files)): ?>
    <ul class="unstyled">
        <?php foreach($model->files as $i => $m): ?>
            <li id="item_uploaded_<?php echo $i; ?>">
                <?php echo CHtml::ajaxLink(
                    'x',
                    array(
                        'dynamicDeleteFile',
                        'id' => $m->id,
                    ),
                    array(
                        'type' => 'POST',
                        'replace' => '#item_uploaded_' . $i,
                    ),
                    array(
                        'confirm' => 'Вы уверены, что хотите удалить данный элемент?',
                    )
                ); ?>
                <?php echo CHtml::link(CHtml::encode($m->name), $m->getUploadUrl('name'), array('target' => '_blank')); ?>
                <?php echo $form->error($m,'name'); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php echo $form->textAreaRow($model,'verification_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
