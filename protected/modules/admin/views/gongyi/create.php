<div class="pull-left main">
  <?php $this->renderPartial('//gongyi/_form', array('model'=>$model,'type'=>$type)); ?>
</div>
<div class="pull-right aside">
  <ul class="nav nav-pills nav-stacked" role="tablist">
    <li role="presentation" class="<?php echo $type=='image'? 'active' : '';?>"><?php echo CHtml::link('<span class="icon-picture"></span> 图片',array('gy/create','type'=>'image'));?></li>
    <li role="presentation" class="<?php echo $type=='video'? 'active' : '';?>"><?php echo CHtml::link('<span class="icon-facetime-video"></span> 视频',array('gy/create','type'=>'video'));?></li>
  </ul>
</div>