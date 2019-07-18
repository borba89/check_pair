<?php $this->widget('booster.widgets.TbGridView',array(
    'id'=>'editable_wrapper',
    'itemsCssClass' => 'items table table-striped table-bordered table-condensed',
    'type' => 'striped bordered condensed',
    'dataProvider'=>$model->invitedEvents(),
    'columns'=>array(
        array(
            'name' => 'event_id',
            'type' => 'event',
        ),
        array(
            'name' => 'paid',
            'type' => 'boolean',
        ),
        array(
            'name' => 'invitation_date',
            'type' => 'date',
        ),
    ),
)); ?>