<?php
/* @var $this ServiceMediasController */
/* @var $model ServiceMedias */
/* @var $form CActiveForm */
?>

<div class="form-horizontal">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-medias-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
            <?php echo $form->labelEx($model,'classify',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->dropDownList($model,'classify',  Tags::getClassifyTags('mediaClassify'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'classify'); ?>
                <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'mediaClassify'));?></p>
            </div>                
	</div>

	<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="row">
                    <div class="col-xs-6 col-sm-6">
                        <?php echo $form->labelEx($model,'isSource'); ?>
                        <?php echo $form->dropDownList($model,'isSource',  ServiceMedias::isSource('admin'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                        <?php echo $form->error($model,'isSource'); ?>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                        <?php echo $form->labelEx($model,'hasLink'); ?>
                        <?php echo $form->dropDownList($model,'hasLink',ServiceMedias::hasLink('admin'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                        <?php echo $form->error($model,'hasLink'); ?>
                    </div>
                </div>	
            </div>            	
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'title',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'url',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'url'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'price',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'price'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'postscript',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->textArea($model,'postscript',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'postscript'); ?>
            </div>		
	</div>

	<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
            </div>		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->