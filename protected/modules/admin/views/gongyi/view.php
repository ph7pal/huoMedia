<div class="pull-left main">
  <h1><?php echo $model->title; ?></h1>
  <blockquote>
    <?php echo $model->description; ?><br/>
    <?php if($model->source!='' && $model->sourceurl!=''){echo '来源：'.CHtml::link($model->source,$model->sourceurl);} ?>
  </blockquote>
  <p>
  <?php 
  if($model->classify=='video'){
    $attachinfo=  Videos::model()->findByPk($model->attachid);
    //echo CHtml::image($attachinfo['faceimg'], '',array('class'=>'img-responsive'));?>
<embed   
  width="580"  
  height="435"  
  allowscriptaccess="never"  
  style="visibility: visible;"  
  pluginspage="http://get.adobe.com/cn/flashplayer/"  
  flashvars="playMovie=true&auto=1"  
  allowfullscreen="true"  
  quality="high"  
  src="<?php echo $attachinfo['url'];?>"  
  type="application/x-shockwave-flash"  
  wmode="transparent">  
</embed>  
    
 <?php    
  }elseif($model->classify=='image'){
    $attachinfo=Attachments::model()->findByPk($model->attachid);
    echo CHtml::image(zmf::uploadDirs(0, 'site', $attachinfo['classify'], 'origin') . '/' . $attachinfo['filePath'],$model->title,array('class'=>'img-responsive'));
  }?>
  </p>
  <p><?php echo $model->content; ?></p>
</div>
<div class="pull-right aside">
  <?php $this->renderPartial('//common/aside');?>
</div>