<?php
/* @var $this UserPowerController */
/* @var $model UserPower */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addPost'); ?>
		<?php echo $form->textField($model,'addPost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'postNum'); ?>
		<?php echo $form->textField($model,'postNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addQuestion'); ?>
		<?php echo $form->textField($model,'addQuestion'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'questionNum'); ?>
		<?php echo $form->textField($model,'questionNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addAnswer'); ?>
		<?php echo $form->textField($model,'addAnswer'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'answerNum'); ?>
		<?php echo $form->textField($model,'answerNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addPoiPost'); ?>
		<?php echo $form->textField($model,'addPoiPost'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'poiPostNum'); ?>
		<?php echo $form->textField($model,'poiPostNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addPoiTips'); ?>
		<?php echo $form->textField($model,'addPoiTips'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'poiTipsNum'); ?>
		<?php echo $form->textField($model,'poiTipsNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addImage'); ?>
		<?php echo $form->textField($model,'addImage'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'imageNum'); ?>
		<?php echo $form->textField($model,'imageNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addComment'); ?>
		<?php echo $form->textField($model,'addComment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'commentNum'); ?>
		<?php echo $form->textField($model,'commentNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'addPlan'); ?>
		<?php echo $form->textField($model,'addPlan'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'planNum'); ?>
		<?php echo $form->textField($model,'planNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'yueban'); ?>
		<?php echo $form->textField($model,'yueban'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'yuebanNum'); ?>
		<?php echo $form->textField($model,'yuebanNum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'favor'); ?>
		<?php echo $form->textField($model,'favor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'favorite'); ?>
		<?php echo $form->textField($model,'favorite'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cTime'); ?>
		<?php echo $form->textField($model,'cTime',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->