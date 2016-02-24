<?php

$this->renderPartial('/content/_nav');
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'classify',
        'isSource',
        'hasLink',
        'title',
        'url',
        'price',
        'postscript',
    ),
));
