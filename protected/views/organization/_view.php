<div class="well well-small">
    <div class="row">
        <div class="item-header">
            <div class="span1">
                <?php echo CHtml::link(
                    CHtml::image(
                        $data->getUploadUrl('logo'),
                        'Organization logo'
                    ),
                    array('view', 'id' => $data->id),
                    array(
                        'class' => 'thumbnail',
                        'rel' => 'tooltip',
                        'data-title' => CHtml::encode($data->name),
                    )
                ); ?>
            </div>

            <div class="span5">
                <b><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></b>
            </div>

            <div class="pull-right">
                <?php $this->widget('bootstrap.widgets.TbBadge', array(
                    'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
                    'label' => CHtml::encode($data->type->name),
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbBadge', array(
                    'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
                    'label' => CHtml::encode(Lookup::item('OrganizationActionArea',$data->action_area)),
                )); ?>
            </div>
        </div>

        <?php if (!empty($data->description)): ?>
            <div class="span11">
                <br />
                <?php echo mb_substr(CHtml::encode(strip_tags($data->description)), 0, 300, 'UTF-8'), '...'; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
