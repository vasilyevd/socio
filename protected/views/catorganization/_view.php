<div class="well">
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

    <b><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></b>

    <?php if (!empty($data->action_area)): ?>
        <div class="pull-right">
            <?php $this->widget('bootstrap.widgets.TbBadge', array(
                'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
                'label' => CHtml::encode(Lookup::item('OrganizationActionArea',$data->action_area)),
            )); ?>
        </div>
    <?php endif; ?>
</div>
