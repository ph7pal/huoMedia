<?php
/* @var $this KeywordIndexerController */
/* @var $data KeywordIndexer */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logid')); ?>:</b>
	<?php echo CHtml::encode($data->logid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('origin')); ?>:</b>
	<?php echo CHtml::encode($data->origin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('len')); ?>:</b>
	<?php echo CHtml::encode($data->len); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('classify')); ?>:</b>
	<?php echo CHtml::encode($data->classify); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('columnid')); ?>:</b>
	<?php echo CHtml::encode($data->columnid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('times')); ?>:</b>
	<?php echo CHtml::encode($data->times); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hash')); ?>:</b>
	<?php echo CHtml::encode($data->hash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	*/ ?>

</div>