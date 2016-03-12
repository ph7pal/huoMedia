<?php
/**
 * @filename ServiceWeixinController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:11 */
?>

<div class="wide form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
    <div class="form-group">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'uid'); ?>
        <?php echo $form->textField($model,'uid',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'classify'); ?>
        <?php echo $form->textField($model,'classify',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'nickname'); ?>
        <?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'account'); ?>
        <?php echo $form->textField($model,'account',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'favors'); ?>
        <?php echo $form->textField($model,'favors',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'danTuwen'); ?>
        <?php echo $form->textField($model,'danTuwen',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'duoTuwen'); ?>
        <?php echo $form->textField($model,'duoTuwen',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'renzhen'); ?>
        <?php echo $form->textField($model,'renzhen',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'cTime'); ?>
        <?php echo $form->textField($model,'cTime',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->textField($model,'status'); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton('搜索',array('class'=>'btn btn-primary')); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- search-form -->