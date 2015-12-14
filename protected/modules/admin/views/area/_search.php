<?php
/* @var $this AreaController */
/* @var $model Area */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'belongid'); ?>
		<?php echo $form->textField($model,'belongid',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>32,'maxlength'=>32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pinyin'); ?>
		<?php echo $form->textField($model,'pinyin',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title_en'); ?>
		<?php echo $form->textField($model,'title_en',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title_local'); ?>
		<?php echo $form->textField($model,'title_local',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nickname'); ?>
		<?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hot'); ?>
		<?php echo $form->textField($model,'hot'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bold'); ?>
		<?php echo $form->textField($model,'bold'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'queue'); ?>
		<?php echo $form->textField($model,'queue'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'theorder'); ?>
		<?php echo $form->textField($model,'theorder'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'long'); ?>
		<?php echo $form->textField($model,'long',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lat'); ?>
		<?php echo $form->textField($model,'lat',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'mapZoom'); ?>
		<?php echo $form->textField($model,'mapZoom',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'maptype'); ?>
		<?php echo $form->textField($model,'maptype',array('size'=>16,'maxlength'=>16)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->