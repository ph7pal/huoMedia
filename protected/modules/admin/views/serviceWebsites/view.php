<?php

$this->renderPartial('/content/_nav');
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'classify',
        'nickname',
        'sex',
        'area',
        'url',
        'favors',
        'vipInfo',
        'price',
        'postscript',
    ),
));
