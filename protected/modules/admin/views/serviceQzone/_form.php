<?php
/**
 * @filename ServiceQzoneController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:52:47 */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-qzone-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'nickname'); ?>
        <?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'nickname'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'url'); ?>
        <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'url'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'favors'); ?>
        <div class="input-group">
            <?php echo $form->textField($model,'favors',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon">人</span>
        </div>
        <?php echo $form->error($model,'favors'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'shuoshuo'); ?>
        <div class="input-group">
            <?php echo $form->textField($model,'shuoshuo',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon">元</span>
        </div>
        <?php echo $form->error($model,'shuoshuo'); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->