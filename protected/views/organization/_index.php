<?php $this->widget('bootstrap.widgets.TbListView',array(
    'id'=>'organization-listview',
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
    'sortableAttributes'=>array(
        'name',
        'type',
        'action_area',
        'foundation_year',
    ),
)); ?>
