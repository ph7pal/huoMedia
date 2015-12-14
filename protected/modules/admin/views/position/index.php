<table class="table table-hover">
    <tr>
        <th style="width: 80%;">标题</th>
        <th>操作</th>
    </tr>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('_view',array('data'=>$row));?>
 <?php endforeach;?>
</table>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>