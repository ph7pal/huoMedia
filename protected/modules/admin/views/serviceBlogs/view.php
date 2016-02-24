<?php

$this->renderPartial('/content/_nav');
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'type',
        'classify',
        'level',
        'area',
        'url',
        'hits',
        'price',
    ),
));
