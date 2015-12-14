<table class="table table-hover">
    <tr>
        <th style="width: 70%;">标题</th>
        <th style="width: 10%;">位置</th>
        <th>操作</th>
    </tr>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_view',array('data'=>$row));?>
 <?php endforeach;?>
</table>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>