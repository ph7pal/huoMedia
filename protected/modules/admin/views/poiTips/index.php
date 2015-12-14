<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_view',array('data'=>$row));?>
 <?php endforeach;?>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>