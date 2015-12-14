<table class="table table-hover">
	<tr>
		<th>名称</th>
		<th>所属地区</th>
                <th style="width: 50%">操作</th>
  </tr>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_view',array('data'=>$row));?>
 <?php endforeach;?>
</table>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>