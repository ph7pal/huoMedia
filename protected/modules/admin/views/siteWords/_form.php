<?php
/* @var $this SiteWordsController */
/* @var $model SiteWords */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'site-words-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'classify'); ?>
		<?php echo $form->dropDownList($model,'classify',  SiteWords::exClassify('admin'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'classify'); ?>
	</div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-success')); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->