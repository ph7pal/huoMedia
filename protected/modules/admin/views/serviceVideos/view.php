<?php

$this->renderPartial('/content/_nav');
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'type',
        'classify',
        'position',
        'url',
        'stayTime',
        'price',
    ),
));
