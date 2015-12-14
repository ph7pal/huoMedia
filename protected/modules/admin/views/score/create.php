<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'score-form',
	'enableAjaxValidation'=>false,
    )); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>16,'maxlength'=>16,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textField($model,'content',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'limit'); ?>
		<?php echo $form->textField($model,'limit',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'limit'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'times'); ?>
		<?php echo $form->textField($model,'times',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'times'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'expired_time'); ?>
		<?php echo $form->textField($model,'expired_time',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'expired_time'); ?>
	</div>
	<div class="form-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->