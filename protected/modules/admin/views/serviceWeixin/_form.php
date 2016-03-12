<?php
/**
 * @filename ServiceWeixinController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:11 */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-weixin-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'classify'); ?>
        <?php echo $form->dropDownList($model,'classify',  Tags::getClassifyTags('weixinClassify'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
        <?php echo $form->error($model,'classify'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'nickname'); ?>
        <?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'nickname'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'account'); ?>
        <?php echo $form->textField($model,'account',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'account'); ?>
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
        <?php echo $form->labelEx($model,'danTuwen'); ?>
        <div class="input-group">
            <?php echo $form->textField($model,'danTuwen',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon">元</span>
        </div>
        <?php echo $form->error($model,'danTuwen'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'duoTuwen'); ?>
        <div class="input-group">
            <?php echo $form->textField($model,'duoTuwen',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon">元</span>
        </div>
        <?php echo $form->error($model,'duoTuwen'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'renzhen'); ?>
        <?php echo $form->textField($model,'renzhen',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'renzhen'); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->