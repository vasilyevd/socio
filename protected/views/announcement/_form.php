<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'announcement-form',
    'enableAjaxValidation'=>true,
    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->dropDownListRow($model,'category',Lookup::items('AnnouncementCategory'),array('prompt'=>'')); ?>

    <?php echo $form->dropDownListRow($model,'status',Lookup::items('AnnouncementStatus'),array('prompt'=>'')); ?>

    <?php echo $form->labelEx($model,'content'); ?>
    <?php $this->widget('bootstrap.widgets.TbRedactorJs', array(
        'model' => $model,
        'attribute' => 'content',
        'lang' => 'ru',
        'editorOptions' => array(
            // Add image upload.
            // 'imageUpload' => null,
            // Add image gallery.
            'imageGetJson' => Yii::app()->createAbsoluteUrl('site/dynamicImageGetJson', array('org' => $model->organization_id)),
            // Add file upload.
            // 'fileUpload' => null,
        ),
    )); ?>
    <?php echo $form->error($model,'content'); ?>

    <?php echo $form->labelEx($model,'publication_time'); ?>
    <div class="input-append">
        <?php $this->widget('ext.EJuiDateTimePicker.EJuiDateTimePicker',array(
            'model' => $model,
            'attribute' => 'publication_time',
            'language' => 'ru',//default Yii::app()->language
            'mode' => 'datetime',//'datetime' or 'time' ('datetime' default)
            'options' => array(
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
                'showSecond' => true,
            ), // jquery plugin options
        )); ?>
        <span class="add-on"><i class="icon-calendar"></i></span>
    </div>
    <?php echo $form->error($model,'publication_time'); ?>

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
            <?php foreach($model->files as $i => $u): ?>
                <li id="item_uploaded_<?php echo $i; ?>">
                    <?php echo CHtml::ajaxLink(
                        'x',
                        array('dynamicDeleteUpload'),
                        array(
                            'type' => 'POST',
                            'replace' => '#item_uploaded_' . $i,
                            'data' => array(
                                'id' => $model->id,
                                'attribute' => 'files',
                                'filename' => $u,
                            ),
                        ),
                        array(
                            'confirm' => 'Вы уверены, что хотите удалить данный элемент?',
                        )
                    ); ?>
                    <?php echo CHtml::link(CHtml::encode($u), $model->getUploadUrl('files', $u)); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
