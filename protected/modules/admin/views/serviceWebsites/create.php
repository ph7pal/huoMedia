<?php $this->renderPartial('/content/_nav');?>
<h4>新增【<?php echo $typeLabel;?>】主页</h4>
<hr/>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>