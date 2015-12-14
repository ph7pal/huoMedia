<?php
$_url = zmf::config('domain') . Yii::app()->createUrl('redirect/to', array('code' => $model->code));
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array('label'=>$model->getAttributeLabel('code'),'value'=>$_url),
        'url',
        'web',
        'ios',
        'android',
        'mobile',
        'web_uv',
        'mobile_uv',
        'ios_uv',
        'android_uv',
        array('label'=>$model->getAttributeLabel('cTime'),'value'=>tools::formatTime($model->cTime)),
    ),
    'itemCssClass' => '',
    'itemTemplate' => '<tr><td style="width:15%" class="text-right"><b>{label}</b></td><td>{value}</td></tr>',
    'htmlOptions' => array('class' => 'table table-hover table-striped')
));