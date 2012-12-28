<div class="well well-small">
    <div class="row">
        <div class="org-logo-conteiner">
            <div class="span1">
                <div class="thumbnail">
                    <?php echo CHtml::image(
                        $data->donor->getUploadUrl('logo'),
                        'Лого донора'
                    ); ?>
                </div>
            </div>

            <div class="span5">
                <strong><?php echo CHtml::link(CHtml::encode($data->donor->name),array('view','id'=>$data->id)); ?></strong>
            </div>

            <div class="pull-right">
                <?php $this->widget('bootstrap.widgets.TbBadge', array(
                    'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
                    'label' => CHtml::encode(Lookup::item('CooperationSource',$data->source)),
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbBadge', array(
                    'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
                    'label' => CHtml::encode(Lookup::item('CooperationSource',$data->type)),
                )); ?>
            </div>
        </div>

        <div class="span8">
            <br />
            <?php echo CHtml::encode($data->description); ?>
        </div>
    </div>
</div>
