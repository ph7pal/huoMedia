<?php if($from=='upload'){?>
<label>为【<?php echo $model->title;?>】地区上传封面图</label>
<?php $this->renderPartial('//common/_noModelUpload',array('type'=>'topArea','classify'=>'area','uploadurl'=>Yii::app()->createUrl('attachments/simpleUpload',array('type'=>'topArea','fileholder'=>'noModelUpload_holder','fileName'=>$model->name.'.jpg'))));?>
<div class="clearfix"></div>
<p class="help-block">用于显示在首页热门目的地，最好为155*219px</p>
<?php }elseif($from=='logo'){?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-form',
)); ?>
<div class="form-group">
    <label>为【<?php echo $model->title;?>】上传国旗或标识</label>
    <?php $this->renderPartial('//common/_noModelUpload',array('type'=>'area','uploadurl'=>Yii::app()->createUrl('attachments/simpleUpload',array('type'=>'area','fileholder'=>'noModelUpload_holder','fileName'=>$model->id.'.jpg')),'imgurl'=>$model->logo));?>
    <div class="clearfix"></div>
    <p class="help-block">建议为正方形，大小200*200px</p>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="overwrite" id="overwrite"> 是否更新本地区及下级地区的标识
    </label>
</div>
<div class="form-group">
    <?php echo CHtml::submitButton('保存',array('class'=>'btn btn-primary','name'=>'save-btn')); ?>
</div>
<?php $this->endWidget(); ?>
<?php }else{?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-form',
	'enableAjaxValidation'=>false,
)); ?>
    <div class="form-group">
        <label>添加热门地区</label>
        <?php $this->widget('CAutoComplete',
            array(
               'name'=>'suggest_area',
               'url'=>array('ajax/area'),
               'max'=>10, //specifies the max number of items to display
               'minChars'=>2,
               'delay'=>500, //number of milliseconds before lookup occurs
               'matchCase'=>false, //match case when performing a lookup?
               'htmlOptions'=>array('class'=>'form-control','placeholder'=>'输入需要添加的热门地区名称'),
               'methodChain'=>".result(function(event,item){ addTopArea(item[1]);})",
               ));
        ?>
        <p class="help-block">点击联想出来的条目即可设置为热门地区</p>
    </div>
<?php $this->endWidget(); ?>
<label>已添加的热门地区</label>
<table class="table table-hover">
    <tr>
    <td>置顶地区</td>
    <td style="width: 20%">操作</td>
    </tr>
    <?php foreach($areas as $area){?>
    <tr>
        <td><?php echo $area['title'];?></td>
        <td>
            <?php echo CHtml::link('封面图',array('upload','id'=>$area['id']));?>
            <?php echo CHtml::ajaxLink(
         '取消置顶',
         Yii::app()->createUrl("admin/area/manage"),
         array(
             'type'=>'POST',
             'success' => "function( data ){"
             . "data = eval('('+data+')');"
             . "if(data['status']){ "
             //. "$('#item".$keyid."').fadeOut();"
             . "alert(data['msg']);"
             . "}else{"
             . "alert(data['msg']);}}",
             'data'=>array(
                 'keyid'=>$area['id'],
                 'type'=>'cancelTop',
                 'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken)),
         array('href' => Yii::app()->createUrl( "admin/area/manage")));?>
        </td>
    </tr>
    <?php }?>
</table>
<?php }?>