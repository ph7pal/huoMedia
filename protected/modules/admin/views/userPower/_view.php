<?php
/* @var $this UserPowerController */
/* @var $data UserPower */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<?php echo CHtml::encode($data->groupInfo->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addPost')); ?>:</b>
	<?php echo CHtml::encode($data->addPost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postNum')); ?>:</b>
	<?php echo CHtml::encode($data->postNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addQuestion')); ?>:</b>
	<?php echo CHtml::encode($data->addQuestion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('questionNum')); ?>:</b>
	<?php echo CHtml::encode($data->questionNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addAnswer')); ?>:</b>
	<?php echo CHtml::encode($data->addAnswer); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('answerNum')); ?>:</b>
	<?php echo CHtml::encode($data->answerNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addPoiPost')); ?>:</b>
	<?php echo CHtml::encode($data->addPoiPost); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('poiPostNum')); ?>:</b>
	<?php echo CHtml::encode($data->poiPostNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addPoiTips')); ?>:</b>
	<?php echo CHtml::encode($data->addPoiTips); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('poiTipsNum')); ?>:</b>
	<?php echo CHtml::encode($data->poiTipsNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addImage')); ?>:</b>
	<?php echo CHtml::encode($data->addImage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imageNum')); ?>:</b>
	<?php echo CHtml::encode($data->imageNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addComment')); ?>:</b>
	<?php echo CHtml::encode($data->addComment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('commentNum')); ?>:</b>
	<?php echo CHtml::encode($data->commentNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('addPlan')); ?>:</b>
	<?php echo CHtml::encode($data->addPlan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('planNum')); ?>:</b>
	<?php echo CHtml::encode($data->planNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('yueban')); ?>:</b>
	<?php echo CHtml::encode($data->yueban); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('yuebanNum')); ?>:</b>
	<?php echo CHtml::encode($data->yuebanNum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('favor')); ?>:</b>
	<?php echo CHtml::encode($data->favor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('favorite')); ?>:</b>
	<?php echo CHtml::encode($data->favorite); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cTime')); ?>:</b>
	<?php echo CHtml::encode($data->cTime); ?>
	<br />

	*/ ?>

</div>