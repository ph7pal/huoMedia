<div class="row">
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_view',array('data'=>$row));?>
<?php endforeach;?>
</div>
<div class="clearfix"></div>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>