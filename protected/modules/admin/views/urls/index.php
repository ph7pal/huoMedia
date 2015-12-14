<table class="table table-hover">
    <tr>
        <th>内容</th>
        <th style="width: 10%">操作</th>
    </tr>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_view',array('data'=>$row));?>
 <?php endforeach;?>
</table>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>