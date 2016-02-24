<?php 
$this->renderPartial('/tags/_nav');
echo '<h4>新增【'.$classifyLabel.'】分类</h4><hr/>';
$this->renderPartial('_form', array('model'=>$model)); 
?>