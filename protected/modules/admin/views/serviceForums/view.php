<?php

$this->renderPartial('/content/_nav');
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'classify',
        'forum',
        'type',
        'url',
        'forDigest',
        'forDay',
        'forWeek',
        'forTwoWeek',
        'forMonth',
        'forQuarter',
        'forHalfYear',
        'forYear',
    ),
));
