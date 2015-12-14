<?php
/* @var $this KeywordIndexerController */
/* @var $model KeywordIndexer */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'keyword-indexer-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'logid'); ?>
		<?php echo $form->textField($model,'logid'); ?>
		<?php echo $form->error($model,'logid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'origin'); ?>
		<?php echo $form->textField($model,'origin',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'origin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'len'); ?>
		<?php echo $form->textField($model,'len'); ?>
		<?php echo $form->error($model,'len'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'classify'); ?>
		<?php echo $form->textField($model,'classify',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'classify'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'columnid'); ?>
		<?php echo $form->textField($model,'columnid'); ?>
		<?php echo $form->error($model,'columnid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'times'); ?>
		<?php echo $form->textField($model,'times'); ?>
		<?php echo $form->error($model,'times'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hash'); ?>
		<?php echo $form->textField($model,'hash',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'hash'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->