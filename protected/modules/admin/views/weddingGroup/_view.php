<?php
/* @var $this WeddingGroupController */
/* @var $data WeddingGroup */
?>

<div class="view">
    <div class="text-center">
        <p><?php echo CHtml::image(Users::getAvatar($data->avatar),'',array('class'=>'img-circle')); ?></p>
        <p><?php echo CHtml::encode($data->title); ?></p>
        <p><?php echo CHtml::link('编辑',array('update','id'=>$data->id));?></p>
    </div>
        
    
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::link($data->authorInfo->truename,array('users/view','id'=>$data->uid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slogan')); ?>:</b>
	<?php echo CHtml::encode($data->slogan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tagids')); ?>:</b>
	<?php echo CHtml::encode($data->tagids); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('createAt')); ?>:</b>
	<?php echo CHtml::encode($data->createAt); ?>
	<br />	

	<b><?php echo CHtml::encode($data->getAttributeLabel('areaid')); ?>:</b>
	<?php echo CHtml::encode($data->areaInfo->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('contact')); ?>:</b>
	<?php echo CHtml::encode($data->contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('openTime')); ?>:</b>
	<?php echo CHtml::encode($data->openTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weibo')); ?>:</b>
	<?php echo CHtml::encode($data->weibo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qq')); ?>:</b>
	<?php echo CHtml::encode($data->qq); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weixin')); ?>:</b>
	<?php echo CHtml::encode($data->weixin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('website')); ?>:</b>
	<?php echo CHtml::encode($data->website); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('cTime')); ?>:</b>
	<?php echo zmf::time($data->cTime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creditStatus')); ?>:</b>
	<?php echo CHtml::encode($data->creditStatus); ?>
	<br />

</div>