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
$uploadurl=Yii::app()->createUrl('attachments/upload',array('type'=>'goods','imgsize'=>600));
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'goods-form',
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
                   'methodChain'=>".result(function(event,item){ $('#Goods_areaid').val(item[1]);})",
                   ));
            ?>
            <?php echo $form->hiddenField($model,'areaid',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
            <?php echo $form->error($model,'areaid'); ?>
	</div>
        <div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'classify'); ?>
                <?php echo $form->dropDownList($model,'classify',Column::allCols(1, 0, 1, Posts::CLASSIFY_GOODS),array('class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'classify'); ?>
	</div>
        <div class="form-group">
            <label>相关商家</label>
            <?php $this->widget('CAutoComplete',
                array(
                   'name'=>'suggest_poi',
                   'url'=>array('ajax/position'),
                   'max'=>10, //specifies the max number of items to display
                   'minChars'=>2,
                   'delay'=>500, //number of milliseconds before lookup occurs
                   'matchCase'=>false, //match case when performing a lookup?
                   'htmlOptions'=>array('class'=>'form-control'),
                   'methodChain'=>".result(function(event,item){ var html='<div class=\"alert alert-success alert-dismissible\" role=\"alert\">'+item[0]+'<input type=\"hidden\" name=\"goods_poiid[]\" value=\"'+item[1]+'\"/><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>';$('#goods-relation-poi').append(html);$('#suggest_poi').val('');})",
                   ));
            ?>
            <div id="goods-relation-poi">
                <?php if(!empty($model->relations)){?>
                <?php foreach($model->relations as $rel){$relPoiInfo=$rel->poiInfo;$_title = '';if ($relPoiInfo['title_cn'] != '') {$_title = $relPoiInfo['title_cn'];} elseif ($relPoiInfo['title_en'] != '') {$_title = $relPoiInfo['title_en'];} else {$_title = $relPoiInfo['title_local'];}?>
                <div class="alert alert-success alert-dismissible" role="alert"><input type="hidden" name="goods_poiid[]" value="<?php echo $relPoiInfo['id'];?>"/><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $_title;?></div>
                <?php }?>
                <?php }?>
            </div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
                <?php $this->renderPartial('//common/editor_bd', array('model' => $model,'content' => $model->content,'uploadurl'=>$uploadurl)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>  
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-success')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->