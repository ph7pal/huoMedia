<?php
/* @var $this AreaController */
/* @var $model Area */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
    
        <div class="form-group">
            <?php echo $form->labelEx($model,'belongid'); ?>
            <?php $this->widget('CAutoComplete',
                array(
                   'name'=>'suggest_area',
                   'url'=>array('ajax/area'),
                   'max'=>10, //specifies the max number of items to display
                   'minChars'=>2,
                   'delay'=>500, //number of milliseconds before lookup occurs
                   'matchCase'=>false, //match case when performing a lookup?
                   'value'=>$model->belongInfo->title,
                   'htmlOptions'=>array('class'=>'form-control'),
                   'methodChain'=>".result(function(event,item){ $('#Area_belongid').val(item[1]);})",
                   ));
            ?>
            <?php echo $form->hiddenField($model,'belongid'); ?>
            <?php echo $form->error($model,'belongid'); ?>
	</div>	

	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>32,'maxlength'=>32,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title_en'); ?>
		<?php echo $form->textArea($model,'title_en',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title_en'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'title_local'); ?>
		<?php echo $form->textArea($model,'title_local',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title_local'); ?>
	</div>
        <div class="form-group">
		<?php echo $form->labelEx($model,'woeid'); ?>
		<?php echo $form->textField($model,'woeid',array('class'=>'form-control')); ?>
                <p class="help-block">访问http://sugg.us.search.yahoo.net/gossip-gl-location/?appid=weather&output=xml&command=地名 获取</p>
		<?php echo $form->error($model,'woeid'); ?>
	</div>
        <div class="form-group">
		<?php echo $form->labelEx($model,'units'); ?>
		<?php echo $form->dropDownList($model,'units',  tools::getUnits(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'units'); ?>
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model, 'nickname'); ?>            
                    <?php
                        if (!empty($model->nickname)) {
                            foreach ($model->nickname as $nick) {
                                $_id=  uniqid();
                                echo '<div class="input-group" id="nickid_'.$_id.'">';
                                echo $form->textField($model, 'nickname', array('value' => $nick, 'name' => 'nickname[]', 'class'=>'form-control'));
                                echo '<span class="input-group-addon">'.CHtml::link('－', 'javascript:', array('onclick' => "clearDiv('nickid_" . $_id . "')", 'class' => 'addcut_btn')) . '</span></div>';
                            }
                        }
                        echo '<div class="input-group">';
                        echo $form->textField($model, 'nickname', array('name' => 'nickname[]', 'value' => '','class'=>'form-control'));
                        echo '<span class="input-group-addon">'.CHtml::link('＋', 'javascript:', array('onclick' => 'nickName()', 'class' => 'addcut_btn')).'</span></div>';
                    ?>
                <div id="nicknameHolder"></div>
                <p class="help-block"><?php echo $form->error($model,'nickname'); ?></p>            
        </div>
        <?php $this->renderPartial('//map/addinfo', array('lat' => $model->lat, 'lng' => $model->long,'zoom'=>$model->mapZoom,'model'=>$model));?>
	<div class="clearfix"></div>
        <div class="form-group">
            <div class="col-xs-3 col-sm-3 row">
                <?php echo $form->labelEx($model,'long'); ?>
		<?php echo $form->textField($model,'long',array('size'=>25,'maxlength'=>25,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'long'); ?>
            </div>
            <div class="col-xs-3 col-sm-3 row">
                <?php echo $form->labelEx($model,'lat'); ?>
		<?php echo $form->textField($model,'lat',array('size'=>25,'maxlength'=>25,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'lat'); ?>
            </div>
            <div class="col-xs-3 col-sm-3 row">
                <?php echo $form->labelEx($model,'mapZoom'); ?>
		<?php echo $form->textField($model,'mapZoom',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'mapZoom'); ?>
            </div>
            <div class="clearfix"></div>
	</div>
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->