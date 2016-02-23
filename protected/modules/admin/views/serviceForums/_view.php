<?php
/* @var $this ServiceForumsController */
/* @var $data ServiceForums */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('classify')); ?>:</b>
	<?php echo CHtml::encode($data->classify); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forum')); ?>:</b>
	<?php echo CHtml::encode($data->forum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forDigest')); ?>:</b>
	<?php echo CHtml::encode($data->forDigest); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('forDay')); ?>:</b>
	<?php echo CHtml::encode($data->forDay); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forWeek')); ?>:</b>
	<?php echo CHtml::encode($data->forWeek); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forTwoWeek')); ?>:</b>
	<?php echo CHtml::encode($data->forTwoWeek); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forMonth')); ?>:</b>
	<?php echo CHtml::encode($data->forMonth); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forQuarter')); ?>:</b>
	<?php echo CHtml::encode($data->forQuarter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forHalfYear')); ?>:</b>
	<?php echo CHtml::encode($data->forHalfYear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forYear')); ?>:</b>
	<?php echo CHtml::encode($data->forYear); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cTime')); ?>:</b>
	<?php echo CHtml::encode($data->cTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>