<?php
/* @var $this AdsController */
/* @var $model Ads */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ads-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'attachid'); ?>
                <?php $this->renderPartial('//common/_singleUpload',array('id'=>$model->attachid,'type'=>'flash','model'=>$model,'fieldName'=>'attachid'));?>
                <?php echo $form->hiddenField($model,'attachid'); ?>
		<?php echo $form->error($model,'attachid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'width'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height',array('size'=>10,'maxlength'=>10,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>


	<div class="form-group">
		<?php echo $form->labelEx($model,'start_time'); ?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            	'model'=>$model,
            	'attribute'=>'start_time',
            	'language'=>'zh-cn',
            	'value'=>date('Y/m/d',$model->start_time),			    
			    'options'=>array(
			        'showAnim'=>'fadeIn',
			    ),	
			    'htmlOptions'=>array(
        			'readonly'=>'readonly',
                                'class'=>'form-control',
                                'value'=>date('Y/m/d',($model->start_time) ? $model->start_time :time())
    			),		    
			));
            	?>
		<?php echo $form->error($model,'start_time'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'expired_time'); ?>
                <?php 
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            	'model'=>$model,
            	'attribute'=>'expired_time',
            	'language'=>'zh-cn',
            	'value'=>date('Y/m/d',$model->expired_time),
			    'options'=>array(
			        'showAnim'=>'fadeIn',
			    ),	
			    'htmlOptions'=>array(
        			'readonly'=>'readonly',
                                'class'=>'form-control',
                                'value'=>date('Y/m/d',($model->expired_time) ? $model->expired_time :time())
    			),		    
			));
            	?>
		<?php echo $form->error($model,'expired_time'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'position'); ?>
                <?php echo $form->dropDownList($model,'position',Ads::colPositions(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'classify'); ?>
                <?php echo $form->dropDownList($model,'classify',Ads::adsStyles(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'classify'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'system'); ?>
                <?php echo $form->dropDownList($model,'system',  tools::allowOrNot(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'system'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'code'); ?>
		<?php echo $form->textArea($model,'code',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->