<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'urls-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <?php echo $form->errorSummary($model); ?>    
    <div class="input-group">
        <?php echo $form->textField($model, 'url', array('class' => 'form-control', 'maxlength' => 2550)); ?>
        <span class="input-group-btn">
          <?php echo CHtml::submitButton($model->isNewRecord ? '查找' : '更新',array('class'=>'btn btn-primary')); ?>
        </span>        
    </div>
    <p class="help-block">输入有效链接，不存在则新增，已存在则返回短链接</p>  
<?php $this->endWidget(); ?>
</div>