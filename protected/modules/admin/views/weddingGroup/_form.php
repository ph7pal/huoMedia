<?php
/* @var $this WeddingGroupController */
/* @var $model WeddingGroup */
/* @var $form CActiveForm */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'wedding-group-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'avatar'); ?>
		<?php echo $form->textField($model,'avatar',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'avatar'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'slogan'); ?>
		<?php echo $form->textField($model,'slogan',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'slogan'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tagids'); ?>
		<?php echo $form->textField($model,'tagids',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'tagids'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'createAt'); ?>
		<?php echo $form->textField($model,'createAt',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'createAt'); ?>
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'areaid'); ?>                      
            <?php $this->widget('CAutoComplete',
                array(
                   'name'=>'suggest_area',
                   'url'=>array('/ajax/suggestarea'),
                   'max'=>10, //specifies the max number of items to display
                   'minChars'=>2,
                   'delay'=>500, //number of milliseconds before lookup occurs
                   'matchCase'=>false, //match case when performing a lookup?
                   'value'=>$info['areaName'],
                   'htmlOptions'=>array('class'=>'form-control','placeholder'=>'请输入地区名称'),
                   'methodChain'=>".result(function(event,item){ $('#".CHtml::activeId($model, 'areaid')."').val(item[1]);})",
                   ));
            ?>
            <?php echo $form->hiddenField($model,'areaid'); ?>
        </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'contact'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'openTime'); ?>
		<?php echo $form->textField($model,'openTime',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'openTime'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'weibo'); ?>
		<?php echo $form->textField($model,'weibo',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'weibo'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'weixin'); ?>
		<?php echo $form->textField($model,'weixin',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'weixin'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>
    
        <div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',  Posts::exStatus('admin'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'creditStatus'); ?>
		<?php echo $form->dropDownList($model,'creditStatus',  WeddingGroup::exCreditStatus('admin'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'creditStatus'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->