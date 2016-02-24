<?php
/* @var $this ServiceWebsitesController */
/* @var $model ServiceWebsites */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-websites-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
            <?php echo $form->labelEx($model,'classify'); ?>            
            <?php echo $form->dropDownList($model,'classify',  Tags::getClassifyTags('websiteClassify'),array('class'=>'form-control','empty'=>'--请选择--')); ?>                
            <?php echo $form->error($model,'classify'); ?>
            <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'websiteClassify'));?></p>            		
	</div>

	<div class="form-group">            
            <div class="row">
                <div class="col-xs-6 col-sm-6">
                    <?php echo $form->labelEx($model,'nickname'); ?>
                    <?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'nickname'); ?>
                </div>
                <div class="col-xs-6 col-sm-6">
                    <?php echo $form->labelEx($model,'sex'); ?>
                    <?php echo $form->dropDownList($model,'sex',  Users::userSex('admin'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                    <?php echo $form->error($model,'sex'); ?>
                </div>
            </div>            	
	</div>
    
        <div class="form-group">            
            <div class="row">
                <div class="col-xs-3 col-sm-3">
                    <?php echo $form->labelEx($model,'area'); ?><br/>
                    <?php $this->renderPartial('/content/_area',array('model'=>$model,'extraCss'=>'btn-block'));?>
                    <?php echo $form->hiddenField($model,'area',array('class'=>'form-control')); ?>
                    <?php echo $form->error($model,'area'); ?>
                </div>                    
                <div class="col-xs-3 col-sm-3">
                    <?php echo $form->labelEx($model,'favors'); ?>
                    <div class="input-group">
                        <?php echo $form->textField($model,'favors',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                        <span class="input-group-addon">万</span>
                    </div>
                    <?php echo $form->error($model,'favors'); ?>
                </div>                        
                <div class="col-xs-3 col-sm-3">
                    <?php echo $form->labelEx($model,'vipInfo'); ?>
                    <?php echo $form->textField($model,'vipInfo',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <?php echo $form->error($model,'vipInfo'); ?>
                </div>                    
                <div class="col-xs-3 col-sm-3">
                    <?php echo $form->labelEx($model,'price'); ?>
                    <div class="input-group">
                        <?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                        <span class="input-group-addon">元</span>
                    </div>
                    <?php echo $form->error($model,'price'); ?>
                </div>                    
            </div>            	
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'url'); ?>            
            <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'url'); ?>            	
	</div> 

	<div class="form-group">
            <?php echo $form->labelEx($model,'postscript'); ?>            
            <?php echo $form->textArea($model,'postscript',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'postscript'); ?>            		
	</div>

	<div class="form-group">
            <?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>            		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->