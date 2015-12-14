<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
        <div class="form-group">
		<?php echo $form->labelEx($model,'truename'); ?>
		<?php echo $form->textField($model,'truename',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'truename'); ?>
	</div>

        <div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
    
	<div class="form-group">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'groupid'); ?>
		<?php echo $form->dropDownList($model,'groupid',UserGroup::getGroups(true),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'groupid'); ?>
	</div>
    
	<div class="form-group">
		<?php echo $form->labelEx($model,'sex'); ?>
		<?php echo $form->dropDownList($model,'sex',  Users::userSex('admin'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'sex'); ?>
	</div>
    
        <div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'content'); ?>
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
		<?php echo $form->labelEx($model,'classify'); ?>
		<?php echo $form->dropDownList($model,'classify',  Users::exUserClassify('admin'),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'classify'); ?>
	</div>
    
        <div class="form-group">
		<?php echo $form->labelEx($model,'creditStatus'); ?>
		<?php echo $form->dropDownList($model,'creditStatus', zmf::isSystem(),array('class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'creditStatus'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '保存',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->