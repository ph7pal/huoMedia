<table class="table table-hover">
    <tr>
        <th>名称</th>
        <th style="width: 25%">操作</th>
    </tr>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_group',array('data'=>$row));?>
 <?php endforeach;?>
</table>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>