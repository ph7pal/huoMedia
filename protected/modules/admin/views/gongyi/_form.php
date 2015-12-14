<?php
/* @var $this GongyiController */
/* @var $model Gongyi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gongyi-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
		<?php echo $form->hiddenField($model,'classify',array('value'=>$type)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
  
    <div class="form-group">	
      <?php if($type=='image'){?>
      <?php echo CHtml::label('上传图片',''); ?>
      <?php $this->renderPartial('//common/newUpload',array('model'=>$model,'fieldName'=>'attachid','type'=>'gongyi','attachid'=>$model->attachid));?>
      <?php }elseif($type=='video'){?>
      <div class="col-xs-9 padding-right-15">
        <?php echo CHtml::label('视频标题',''); ?>
        <?php echo CHtml::textField('video_title', '', array('class'=>'form-control'));?>
        <?php echo CHtml::label('视频链接',''); ?>
        <div class="input-group">   
          <?php echo CHtml::textField('video_url', '', array('class'=>'form-control'));?>
          <span class="input-group-btn">
            <button id="myButton" type="button" class="btn btn-primary" data-loading-text="验证中...">验证</button>
          </span>
        </div><!-- /input-group -->
      </div>
      <div class="col-xs-3 no-padding" id="video_validate">
        
      </div>
<script>
  $('#myButton').on('click', function () {
    var $btn = $(this).button('loading');
    var url=$('#video_url').val();
    var title=$('#video_title').val();
    if(title==''){
      alert('链接标题不能为空');
      $btn.button('reset');
      return false;
    }
    if(url==''){
      alert('链接不能为空');
      $btn.button('reset');
      return false;
    }
    $.ajax({
    type: "POST",
    url: "<?php echo Yii::app()->createUrl('gongyi/gy/video');?>",
    timeout: 5000,
    data: "url=" + url + "&title=" + title,
    beforeSend: function() {
      //loading("favor"+logid,2,'');
    },
    success: function(result) {
      result = eval('(' + result + ')');
      if (result['status'] == 1) {
        $('#video_validate').html('<img src="'+result['msg']['imgurl']+'" class="img-responsive"/>');
        $btn.button('reset');
        $('#Gongyi_attachid').val(result['msg']['attachid']);
      } else {
        $btn.button('reset');
      }
    }
  });
    

  })
</script>
      <div class="clearfix"></div>
      <?php }?>
      <?php echo $form->hiddenField($model,'attachid',array('size'=>10,'maxlength'=>10, 'class' => 'form-control')); ?>
      <?php echo $form->error($model,'attachid'); ?>
	</div>	
  <?php if($type=='image'){?>
	<div class="form-group pull-left">
      <div class="col-xs-4 padding-right-15">
        <?php echo $form->labelEx($model,'source'); ?>
		<?php echo $form->textField($model,'source',array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'source'); ?>
      </div>
      <div class="col-xs-8 no-padding">
        <?php echo $form->labelEx($model,'sourceurl'); ?>
		<?php echo $form->urlField($model,'sourceurl',array('size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'sourceurl'); ?>
      </div>
	</div>
  <?php }?>
    <div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>3, 'cols'=>50,'size'=>60,'maxlength'=>255, 'class' => 'form-control')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
    <div class="form-group">
	  <?php echo $form->labelEx($model,'content'); ?>
      <input type="hidden" name="theeditorid" id="theeditorid"/>
      <?php $this->renderPartial('//common/editor', array('model' => $model,'mini'=>'yes')); ?>
      <?php echo $form->error($model,'content'); ?>
	</div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新', array('class' => 'btn btn-success','id'=>'add-sth-btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->