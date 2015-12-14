<?php
$cookieAreaName=zmf::getCookie('addPoiSuggestArea');
$cookieAreaid=zmf::getCookie('addPoiAreaid');
$areaName=$areaId='';
if($model->areaInfo->title){
    $areaName=$model->areaInfo->title;
    $areaId=$model->areaid;
}elseif(isset($cookieAreaName) && isset($cookieAreaid)){
    $areaName=$cookieAreaName;
    $model->areaid=$cookieAreaid;
}
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'position-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
    
        <div class="form-group">
            <?php echo $form->labelEx($model,'areaid'); ?>
            <?php $this->widget('CAutoComplete',
                array(
                   'name'=>'suggest_area',
                   'url'=>array('ajax/area'),
                   'max'=>10, //specifies the max number of items to display
                   'minChars'=>2,
                   'delay'=>500, //number of milliseconds before lookup occurs
                   'matchCase'=>false, //match case when performing a lookup?
                   'value'=>$areaName,
                   'htmlOptions'=>array('class'=>'form-control'),
                   'methodChain'=>".result(function(event,item){ $('#Position_areaid').val(item[1]);})",
                   ));
            ?>
            <?php echo $form->hiddenField($model,'areaid',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'areaid'); ?>
	</div>    
    
	<div class="form-group">
		<?php echo $form->labelEx($model,'title_cn'); ?>
		<?php echo $form->textArea($model,'title_cn',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title_cn'); ?>
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

	<div class="form-group">
		<?php echo $form->labelEx($model,'traffic'); ?>
		<?php echo $form->textArea($model,'traffic',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'traffic'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('size'=>60,'maxlength'=>255,'rows'=>8,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
        
        <div class="form-group">
		<?php echo $form->labelEx($model,'address_cn'); ?>
		<?php echo $form->textArea($model,'address_cn',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'address_cn'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'address_en'); ?>
		<?php echo $form->textArea($model,'address_en',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'address_en'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'address_local'); ?>
		<?php echo $form->textArea($model,'address_local',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'address_local'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textArea($model,'phone',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
        
        <div class="form-group">
		<?php echo $form->labelEx($model,'classify'); ?>
		<?php echo $form->dropDownList($model,'classify',  Position::exClassify(),array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'classify'); ?>
	</div>
        
        <div class="form-group">
		<?php echo $form->labelEx($model,'units'); ?>
		<?php echo $form->dropDownList($model,'units',tools::getUnits(),array('maxlength'=>6,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'units'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'star'); ?>
		<?php echo $form->dropDownList($model,'star',tools::getHotelStar(),array('maxlength'=>6,'class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'star'); ?>
	</div>
        
        <div class="form-group">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textArea($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>
    
        <style>
            .buylink-item{
                margin-bottom:10px;
            }
        </style>
        <div class="form-group">
            <label>购买地址</label>
            <div id="buylink-container" class="row">
            <?php if(!empty($model->buylinks)){?>
            <?php foreach($model->buylinks as $k=>$val){?>
            <?php $this->renderPartial('/buylink/forpoi',array('data'=>$val,'close'=>true));?>
            <?php }?>
            <?php }else{?>
            <?php $this->renderPartial('/buylink/forpoi',array('data'=>array(),'close'=>false));?>
            <?php }?>
            </div>
            <div style="margin-top:10px;">
                <button class="btn btn-default" type="button" onclick="addBuylink()">再添加一个</button>
            </div>
            <p class="help-block">可以购买门票的链接，一般由合作伙伴提供</p>
        </div>
        <script>
           function addBuylink(){
               var html='<?php echo $this->renderPartial('/buylink/forpoi',array('data'=>array(),'close'=>true),true);?>';
               $('#buylink-container').append('<div class="buylink-item">'+html+'</div>');
           } 
        </script>

	<div class="form-group">
		<?php echo $form->labelEx($model,'openTime'); ?>
		<?php echo $form->textArea($model,'openTime',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'openTime'); ?>
	</div>
    
        <div class="form-group">
		<?php echo $form->labelEx($model,'ticket'); ?>
		<?php echo $form->textArea($model,'ticket',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'ticket'); ?>
	</div>
    
        <div class="form-group">
		<?php echo $form->labelEx($model,'playtime'); ?>
		<?php echo $form->textArea($model,'playtime',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'playtime'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sourceurl'); ?>
		<?php echo $form->textArea($model,'sourceurl',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'sourceurl'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'sourceinfo'); ?>
		<?php echo $form->textArea($model,'sourceinfo',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'sourceinfo'); ?>
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
	</div>
        <div class="clearfix"></div>
        <div class="form-group" style="margin-top: 15px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-success')); ?>
            <?php if($nextPost){echo CHtml::link('下一篇',array('create','type'=>'post','postid'=>$nextPost),array('class'=>'btn btn-default'));}?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->