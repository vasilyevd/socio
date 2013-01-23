<div class="well well-small">
    <div class="row">
        <div class="org-logo-conteiner">
            <div class="span1">
                <?php if (!empty($data->linkOrganization)): ?>
                    <div class="thumbnail">
                        <?php echo CHtml::image(
                            $data->linkOrganization->getUploadUrl('logo'),
                            'Лого организации'
                        ); ?>
                    </div>
                <?php else: ?>
                    <div class="thumbnail">
                        <?php echo CHtml::image(
                            $data->getUploadUrl('logo'),
                            'Лого организации'
                        ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="span5">
                <strong><?php echo CHtml::link(CHtml::encode($data->link),array('view','id'=>$data->id)); ?></strong>
                <?php echo CHtml::encode($data->email); ?>
            </div>

            <div class="pull-right">
                <?php $this->widget('bootstrap.widgets.TbBadge', array(
                    'type' => $data->verified ? 'success' : 'warning', // 'success', 'warning', 'important', 'info' or 'inverse'
                    'label' => $data->verified ? 'Проверенно' : 'Не проверенно',
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbBadge', array(
                    'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
                    'label' => CHtml::encode(Lookup::item('PartnershipSource',$data->source)),
                )); ?>
                <?php $this->widget('bootstrap.widgets.TbBadge', array(
                    'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
                    'label' => CHtml::encode(Lookup::item('PartnershipType',$data->type)),
                )); ?>
            </div>
        </div>

        <div class="span8">
            <br />
            <?php echo CHtml::encode($data->description); ?>
        </div>
    </div>
</div>
