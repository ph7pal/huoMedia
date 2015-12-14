<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
		'content',
		'score',
		'limit',
		'times',
		'expired_time',
	),
)); ?>
